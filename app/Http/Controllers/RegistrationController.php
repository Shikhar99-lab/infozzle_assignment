<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; // Add this line to import the Validator class
use App\Models\User;

class RegistrationController extends Controller
{
    private function generateOtp()
    {
        return '123456';
    }

    public function verifyOtp(Request $request)
    {
        $enteredOtp = $request->input('otp');
        $generatedOtp = $this->generateOtp(); 
        if ($enteredOtp === $generatedOtp) {
            $user = new User([
                'username' => $request->session()->get('username'), 
                'email' => $request->session()->get('email'),
                'password' => bcrypt($request->session()->get('password')), 
            ]);

            $user->save(); 
            $request->session()->forget(['username', 'email', 'password', 'photo']);

            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'message' => 'Invalid OTP'], 422);
        }
    }

    public function postStep1(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|min:5',
            'email' => 'required|email',
            'password' => 'required|min:8|regex:/^(?=.*[A-Z])(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]+$/',
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048', // Adjust the mime types and size as needed
        ]);

        if ($validator->fails()) {
            return redirect('/register/step1')
                        ->withErrors($validator)
                        ->withInput();
        }

        // Save validated data to session
        $request->session()->put('username', $request->input('username'));
        $request->session()->put('email', $request->input('email'));
        $request->session()->put('password', $request->input('password'));

        // Move to Step 2
        return redirect('/register/step2');
    }
}
