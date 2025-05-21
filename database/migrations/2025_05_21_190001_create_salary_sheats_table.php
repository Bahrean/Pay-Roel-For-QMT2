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
        Schema::create('salary_sheats', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('employment_date');
            $table->string('role');
            $table->string('employment_type');
            $table->string('basic_salary');
            $table->string('work_day');
            $table->string('earned_salary')->nullable();
            $table->string('position_allowance');
            $table->string('non_taxable_position_allowance');
            $table->string('taxable_position_allowance');
            $table->string('non_taxable_transport_allowance');
            $table->string('taxable_transport_allowance');
            $table->string('other_benefit');
            $table->string('gross_pay')->nullable();
            $table->string('taxable_income')->nullable();
            $table->string('income_tax')->nullable();
            $table->string('pens_employee')->nullable();
            $table->string('pension_employer')->nullable();
            $table->string('total_pension')->nullable();
            $table->string('loan');
            $table->string('total_deduction')->nullable();
            $table->string('net_payment')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salary_sheats');
    }
};
