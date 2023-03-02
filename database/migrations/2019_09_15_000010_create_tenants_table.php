<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('tenants', function (Blueprint $table) {
            $table->string('id')->primary();

            $table->string('email')->unique();

            $table->string('stripe_id')->nullable()->index();
            $table->string('pm_type')->nullable();
            $table->string('pm_last_four', 4)->nullable();
            $table->timestamp('trial_ends_at')->nullable();
            // your custom columns may go here
            //from domain table
            $table->unsignedTinyInteger('is_primary')->default(false);
            $table->unsignedTinyInteger('is_fallback')->default(false);
            $table->string('location_name')->nullable();
            $table->string('company')->nullable();
            $table->string('website')->nullable();
            $table->string('primary_industry')->nullable();
            $table->string('phone')->nullable();
            $table->integer('dial_code')->nullable();
            $table->longText('company_description')->nullable();
            $table->string('address_1')->nullable();
            $table->string('address_2')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zip')->nullable();
            $table->string('country')->nullable();
            $table->string('timezone_iso3')->nullable();
            $table->string('currency_iso3')->nullable();
            $table->string('language_iso2')->default('en');
            $table->string('order_number_format')->default('numeric');
            $table->string('order_number_prefix')->nullable();
            $table->string('date_format')->default('D, d M, Y');
            $table->string('time_format')->default('12h');

            //

            $table->timestamps();
            $table->json('data')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('tenants');
    }
};
