<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kyc;
use App\Models\User;

class KycSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get existing users and create KYC records for some of them
        $users = User::all();

        foreach ($users->take(15) as $user) {
            Kyc::create([
                'user_id' => $user->id,
                'document_type' => fake()->randomElement(['passport', 'drivers_license', 'national_id']),
                'document_number' => strtoupper(fake()->bothify('??#######')),
                'document_front_path' => 'kyc/documents/' . fake()->uuid() . '.jpg',
                'document_back_path' => fake()->boolean(70) ? 'kyc/documents/' . fake()->uuid() . '.jpg' : null,
                'selfie_path' => 'kyc/selfies/' . fake()->uuid() . '.jpg',
                'verification_status' => fake()->randomElement(['pending', 'approved', 'rejected', 'under_review']),
                'verified_at' => fake()->boolean(40) ? fake()->dateTimeThisMonth() : null,
                'rejection_reason' => fake()->boolean(20) ? fake()->sentence() : null,
            ]);
        }
    }
}