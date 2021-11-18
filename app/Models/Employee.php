<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
      "emp_title",
      "name",
      "email",
      "mobile",
      "date_of_join",
      "city",
      "pincode",
      "state"
    ];

    protected $dates = [
      'date_of_join',
      'created_at',
      'updated_at'
    ];

    protected $dateFormat = 'd-m-Y H:i';

    public function salary() {
      return $this->hasMany(\App\Models\Salary::class, 'emp_id');
    }
}
