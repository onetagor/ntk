<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->string('business_id')->nullable()->after('site_name');
            $table->string('phone_2')->nullable()->after('phone');
            $table->string('contact_person_1')->nullable()->after('address');
            $table->string('contact_person_2')->nullable()->after('contact_person_1');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn(['business_id', 'phone_2', 'contact_person_1', 'contact_person_2']);
        });
    }
};
