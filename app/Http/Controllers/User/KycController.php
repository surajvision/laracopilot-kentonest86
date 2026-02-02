<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Kyc;
use Illuminate\Http\Request;

class KycController extends Controller
{
    public function index()
    {
        if (!session('user_logged_in')) {
            return redirect()->route('user.login');
        }

        $user = User::find(session('user_id'));
        
        if (!$user->profile_completed) {
            return redirect()->route('user.profile.step1');
        }

        $kyc = Kyc::where('user_id', $user->id)->first();
        
        return view('user.kyc', compact('kyc'));
    }

    public function store(Request $request)
    {
        if (!session('user_logged_in')) {
            return redirect()->route('user.login');
        }

        $validated = $request->validate([
            'id_proof_1' => 'required|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'id_proof_2' => 'required|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'id_proof_3' => 'required|file|mimes:jpg,jpeg,png,pdf|max:5120'
        ]);

        $userId = session('user_id');

        $idProof1 = $request->file('id_proof_1');
        $idProof1Name = time() . '_1_' . $idProof1->getClientOriginalName();
        $idProof1Path = $idProof1->storeAs('kyc', $idProof1Name, 'public');

        $idProof2 = $request->file('id_proof_2');
        $idProof2Name = time() . '_2_' . $idProof2->getClientOriginalName();
        $idProof2Path = $idProof2->storeAs('kyc', $idProof2Name, 'public');

        $idProof3 = $request->file('id_proof_3');
        $idProof3Name = time() . '_3_' . $idProof3->getClientOriginalName();
        $idProof3Path = $idProof3->storeAs('kyc', $idProof3Name, 'public');

        Kyc::create([
            'user_id' => $userId,
            'id_proof_1_path' => $idProof1Path,
            'id_proof_1_name' => $idProof1Name,
            'id_proof_2_path' => $idProof2Path,
            'id_proof_2_name' => $idProof2Name,
            'id_proof_3_path' => $idProof3Path,
            'id_proof_3_name' => $idProof3Name,
            'status' => 'pending'
        ]);

        return redirect()->route('user.dashboard')->with('success', 'KYC documents uploaded successfully! Awaiting admin approval.');
    }
}