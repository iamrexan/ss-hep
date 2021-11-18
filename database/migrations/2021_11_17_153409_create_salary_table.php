<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalaryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salaries', function (Blueprint $table) {
            $table->id();
            $table->integer('emp_id')->references('id')->on('employees');
            $table->string('salary_month');
            $table->string('salary_year');
            $table->integer('emp_basic_salary');
            $table->integer('emp_hra')->comment('Employee HRA');
            $table->integer('emp_pf')->comment('Employee PF amount');
            $table->integer('emp_tax')->comment('Employee professional tax')->nullable();
            $table->integer('emp_gross');
            $table->integer('emp_total_salary')->comment('Employee take home salary');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('salary');
    }
}
