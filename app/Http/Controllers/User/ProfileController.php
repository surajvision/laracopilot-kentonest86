<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function showStep1()
    {
        if (!session('user_logged_in')) {
            return redirect()->route('user.login');
        }

        return view('user.profile.step1');
    }

    public function storeStep1(Request $request)
    {
        if (!session('user_logged_in')) {
            return redirect()->route('user.login');
        }

        $validated = $request->validate([
            'skills' => 'required|string',
            'languages' => 'required|string',
            'availability' => 'required|string'
        ]);

        session(['profile_step1' => $validated]);

        return redirect()->route('user.profile.step2');
    }

    public function showStep2()
    {
        if (!session('user_logged_in') || !session('profile_step1')) {
            return redirect()->route('user.profile.step1');
        }

        return view('user.profile.step2');
    }

    public function storeStep2(Request $request)
    {
        if (!session('user_logged_in') || !session('profile_step1')) {
            return redirect()->route('user.profile.step1');
        }

        $validated = $request->validate([
            'emergency_contact_name' => 'required|string|max:255',
            'emergency_contact_phone' => 'required|string|max:20',
            'emergency_contact_relation' => 'required|string|max:100'
        ]);

        session(['profile_step2' => $validated]);

        return redirect()->route('user.profile.step3');
    }

    public function showStep3()
    {
        if (!session('user_logged_in') || !session('profile_step1') || !session('profile_step2')) {
            return redirect()->route('user.profile.step1');
        }

        return view('user.profile.step3');
    }

    public function storeStep3(Request $request)
    {
        if (!session('user_logged_in') || !session('profile_step1') || !session('profile_step2')) {
            return redirect()->route('user.profile.step1');
        }

        $validated = $request->validate([
            'bank_name' => 'required|string|max:255',
            'account_number' => 'required|string|max:50',
            'bank_code' => 'required|string|max:20',
            'account_holder_name' => 'required|string|max:255'
        ]);

        $step1 = session('profile_step1');
        $step2 = session('profile_step2');

        $user = User::find(session('user_id'));
        $user->update(array_merge(
            $step1,
            $step2,
            $validated,
            ['profile_completed' => true]
        ));

        session()->forget(['profile_step1', 'profile_step2']);

        return redirect()->route('user.dashboard')->with('success', 'Profile completed! Please complete KYC verification.');
    }
}