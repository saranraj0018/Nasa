<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

class PolicyController extends Controller
{
    public function privacyPolicy()
    {
        return response()->json([
            'data'    => view('policies.privacy_policy_content')->render(),
            'status'  => 200,
            'message' => 'Privacy Policy Fetched Successfully',
        ]);
    }

    public function termsConditions()
    {
        return response()->json([
            'data'    => view('policies.terms_conditions_content')->render(),
            'status'  => 200,
            'message' => 'Terms & Conditions Fetched Successfully',
        ]);
    }
}
