<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    use HasFactory;

    protected $fillable = [
      "emp_id",
      "salary_month",
      "salary_year",
      "emp_basic_salary",
      "emp_hra",
      "emp_pf",
      "emp_tax",
      "emp_gross",
      "emp_total_salary"
    ];

    protected $dates = [
      'created_at',
      'updated_at'
    ];

    public function employee() {
      return $this->belongsTo(\App\Models\Employee::class, 'emp_id');
    }

    public function getEmpBasicSalaryAttribute($value) {
        return \number_format($value, 2);
    }

    public function getEmpHraAttribute($value) {
        return \number_format($value, 2);
    }

    public function getEmpPfAttribute($value) {
        return \number_format($value, 2);
    }

    public function getEmpTaxAttribute($value) {
        return \number_format($value, 2);
    }

    public function getEmpGrossAttribute($value) {
        return \number_format($value, 2);
    }
}
