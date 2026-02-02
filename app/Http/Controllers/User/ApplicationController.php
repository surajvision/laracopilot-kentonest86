<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ApplicationController extends Controller
{
    public function showStep1()
    {
        return view('application.step1');
    }

    public function storeStep1(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:applications,email',
            'phone' => 'required|string|max:20',
            'date_of_birth' => 'required|date'
        ]);

        session(['application_step1' => $validated]);

        return redirect()->route('apply.step2');
    }

    public function showStep2()
    {
        if (!session('application_step1')) {
            return redirect()->route('apply.step1');
        }

        return view('application.step2');
    }

    public function storeStep2(Request $request)
    {
        if (!session('application_step1')) {
            return redirect()->route('apply.step1');
        }

        $validated = $request->validate([
            'address' => 'required|string',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'zip_code' => 'required|string|max:10',
            'country' => 'required|string|max:100'
        ]);

        session(['application_step2' => $validated]);

        return redirect()->route('apply.step3');
    }

    public function showStep3()
    {
        if (!session('application_step1') || !session('application_step2')) {
            return redirect()->route('apply.step1');
        }

        return view('application.step3');
    }

    public function storeStep3(Request $request)
    {
        if (!session('application_step1') || !session('application_step2')) {
            return redirect()->route('apply.step1');
        }

        $validated = $request->validate([
            'education' => 'required|string|max:255',
            'occupation' => 'required|string|max:255',
            'experience_years' => 'required|integer|min:0',
            'why_join' => 'required|string'
        ]);

        $step1 = session('application_step1');
        $step2 = session('application_step2');

        $verificationToken = Str::random(32);

        $application = Application::create(array_merge(
            $step1,
            $step2,
            $validated,
            [
                'status' => 'pending',
                'email_verified' => false,
                'email_verification_token' => $verificationToken
            ]
        ));

        session()->forget(['application_step1', 'application_step2']);

        return redirect()->route('apply.success');
    }

    public function success()
    {
        return view('application.success');
    }

    public function verifyEmail($token)
    {
        $application = Application::where('email_verification_token', $token)->first();

        if (!$application) {
            return redirect()->route('home')->with('error', 'Invalid verification link.');
        }

        $application->email_verified = true;
        $application->email_verified_at = now();
        $application->save();

        return view('application.verified');
    }
}