<?php

namespace App\Http\Controllers;

use App\Models\Kyc;
use Illuminate\Http\Request;

class KycController extends Controller
{
    public function showUpload()
    {
        if (!session('user_logged_in')) {
            return redirect()->route('home');
        }

        $userId = session('user_id');
        $kyc = Kyc::where('user_id', $userId)->first();

        return view('kyc.upload', compact('kyc'));
    }

    public function store(Request $request)
    {
        if (!session('user_logged_in')) {
            return redirect()->route('home');
        }

        $request->validate([
            'document_type' => 'required|in:passport,drivers_license,national_id',
            'document_number' => 'required|string|max:255',
            'document_front' => 'required|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'document_back' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'selfie' => 'required|file|mimes:jpg,jpeg,png|max:5120',
        ]);

        $userId = session('user_id');

        // Store files
        $documentFrontPath = $request->file('document_front')->store('kyc/documents', 'public');
        $selfiePath = $request->file('selfie')->store('kyc/selfies', 'public');
        $documentBackPath = null;

        if ($request->hasFile('document_back')) {
            $documentBackPath = $request->file('document_back')->store('kyc/documents', 'public');
        }

        // Create or update KYC record
        Kyc::updateOrCreate(
            ['user_id' => $userId],
            [
                'document_type' => $request->document_type,
                'document_number' => $request->document_number,
                'document_front_path' => $documentFrontPath,
                'document_back_path' => $documentBackPath,
                'selfie_path' => $selfiePath,
                'verification_status' => 'pending',
            ]
        );

        return redirect()->route('kyc.upload')
            ->with('success', 'KYC documents submitted successfully! We will review them shortly.');
    }
}