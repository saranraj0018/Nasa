<?php

namespace App\Http\Controllers\student;

use App\Helpers\ActivityLog;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Razorpay\Api\Api;
use App\Models\Event;
use App\Models\EventPayment;
use App\Models\StudentEventRegistration;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RazorpayController extends Controller
{
    public function createOrder(Request $request)
    {
        $studentId = Auth::id();
        $event = Event::findOrFail($request->event_id);

        $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));

        try {
            $order = $api->order->create([
                'amount' => $event->price * 100, // in paise
                'currency' => 'INR',
                'receipt' => 'event_' . $event->id . '_user_' . $studentId . '_' . time(),
                'payment_capture' => 1,
            ]);

            // Save order in DB
            $event_payment = new EventPayment();
            $event_payment->student_id = $studentId;
            $event_payment->event_id = $event->id;
            $event_payment->order_id = $order['id'];
            $event_payment->amount = $event->price;
            $event_payment->status = 'created';
            $event_payment->save();

            return response()->json($order);
        } catch (\Exception $e) {
            Log::error('Razorpay Order Creation Failed: ' . $e->getMessage());
            return response()->json(['error' => 'Unable to create order. Try again later.'], 500);
        }
    }

    public function paymentSuccess(Request $request)
    {
        $studentId = Auth::id();
        $event = Event::findOrFail($request->event_id);

        $payment = EventPayment::where('order_id', $request->razorpay_order_id)->first();

        if (!$payment) {
            return response()->json(['error' => 'Payment record not found'], 404);
        }

        try {

            $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));
            $attributes = [
                'razorpay_order_id' => $request->razorpay_order_id,
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'razorpay_signature' => $request->razorpay_signature,
            ];

            // Verify payment signature
            $api->utility->verifyPaymentSignature($attributes);

            // Update payment record
            $payment->update([
                'payment_id' => $request->razorpay_payment_id,
                'signature' => $request->razorpay_signature,
                'status' => 'paid',
            ]);

            // Register student

            $register = new StudentEventRegistration();
            $register->student_id   = $studentId;
            $register->event_id     = $event->id;
            $register->status       = 1;
            $register->save();

            // Log activity
            $user = Auth::user();
            ActivityLog::add($user->name . ' - ' . $event->title . ' - Event Registered', $user);

            return response()->json(['message' => 'Payment successful & registration completed']);
        } catch (\Razorpay\Api\Errors\SignatureVerificationError $e) {
            // Update payment as failed
            $payment->update([
                'status' => 'failed',
                'failure_reason' => $e->getMessage(),
            ]);
            Log::error('Razorpay Signature Verification Failed: ' . $e->getMessage());

            return response()->json(['error' => 'Payment verification failed.'], 400);
        } catch (\Exception $e) {
            $payment->update([
                'status' => 'failed',
                'failure_reason' => $e->getMessage(),
            ]);
            Log::error('Razorpay Payment Processing Failed: ' . $e->getMessage());

            return response()->json(['error' => 'Payment failed. Please try again.'], 500);
        }
    }
}
