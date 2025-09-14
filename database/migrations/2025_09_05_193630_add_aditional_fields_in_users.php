<?php

use App\UserRoles;
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
            $table->string('profile_photo')->nullable();
            $table->enum('role', array_column(UserRoles::cases(), 'value'))->default(UserRoles::User->value);
            $table->boolean('isActive')->default(true);
            $table->string('location')->nullable();
            $table->string('phone_no')->nullable();
            $table->text('bio', 500)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
