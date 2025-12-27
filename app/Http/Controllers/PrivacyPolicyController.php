<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PrivacyPolicyController extends Controller
{
   public function index(){
        return view('privacy_policy');
   }

   public function termsConditions(){
        return view('terms_and_conditions');
   }
}
