<?php

use App\Enums\TimezoneEnum;
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
        Schema::table('users', function (Blueprint $table) {
            $table->string('time_zone')
                ->default(TimezoneEnum::CET->value)
                ->index('users_timezone_idx');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex("users_timezone_idx");
            $table->dropColumn('time_zone');
        });
    }
};
