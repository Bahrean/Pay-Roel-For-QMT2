<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('gender')->nullable();
            $table
                ->enum('employment_type',['Full_time','Part_time'])->default('Full_time');
            $table->string('password');
            $table
                ->enum('role',['CEO','CFO','COO','CTO','CISO','Director','Dept_Lead','Normal_Employee'])->default('Normal_Employee');
            $table->string('employment_date')->nullable();
            $table->string('basic_salary')->nullable();
            $table->string('bank_account_number')->nullable();
            $table
                ->enum('status',['active','inactive'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
