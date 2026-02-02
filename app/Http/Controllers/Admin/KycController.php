<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kyc;
use Illuminate\Http\Request;

class KycController extends Controller
{
    public function index()
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $kycs = Kyc::with('user')->orderBy('created_at', 'desc')->paginate(15);
        
        return view('admin.kyc.index', compact('kycs'));
    }

    public function show($id)
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $kyc = Kyc::with('user')->findOrFail($id);
        
        return view('admin.kyc.show', compact('kyc'));
    }

    public function approve($id)
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $kyc = Kyc::findOrFail($id);
        $kyc->status = 'approved';
        $kyc->approved_at = now();
        $kyc->save();

        $kyc->user->update(['kyc_verified' => true]);

        return redirect()->route('admin.kyc.index')->with('success', 'KYC approved successfully!');
    }

    public function reject($id)
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $kyc = Kyc::findOrFail($id);
        $kyc->status = 'rejected';
        $kyc->rejected_at = now();
        $kyc->save();

        return redirect()->route('admin.kyc.index')->with('success', 'KYC rejected.');
    }
}