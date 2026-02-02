<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone')->nullable()->after('email');
            $table->foreignId('application_id')->nullable()->after('id')->constrained('applications')->onDelete('cascade');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending')->after('password');
            $table->boolean('profile_completed')->default(false)->after('status');
            $table->boolean('kyc_verified')->default(false)->after('profile_completed');
            $table->string('skills')->nullable();
            $table->string('languages')->nullable();
            $table->string('availability')->nullable();
            $table->string('emergency_contact_name')->nullable();
            $table->string('emergency_contact_phone')->nullable();
            $table->string('emergency_contact_relation')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('account_number')->nullable();
            $table->string('bank_code')->nullable();
            $table->string('account_holder_name')->nullable();
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'phone', 'application_id', 'status', 'profile_completed', 'kyc_verified',
                'skills', 'languages', 'availability',
                'emergency_contact_name', 'emergency_contact_phone', 'emergency_contact_relation',
                'bank_name', 'account_number', 'bank_code', 'account_holder_name'
            ]);
        });
    }
};