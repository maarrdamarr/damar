<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->timestamps();
        });

        // Insert default auction settings
        DB::table('settings')->insert([
            ['key' => 'auction.default_duration_hours', 'value' => '24', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'auction.anti_sniping_window_minutes', 'value' => '5', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'auction.anti_sniping_extension_minutes', 'value' => '5', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
