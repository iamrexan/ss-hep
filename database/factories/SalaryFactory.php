<?php

namespace Database\Factories;

use App\Models\Employee;
use App\Models\Salary;
use Illuminate\Database\Eloquent\Factories\Factory;

class SalaryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Salary::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // $employee = Employee::factory()->create();

        return [
            // "emp_id" => $employee->id,
            "salary_month" => $this->faker->month(),
            "salary_year" => rand(2018, 2021),
            "emp_basic_salary" => rand(10000, 20000),
            "emp_hra" => rand(5000, 8000),
            "emp_pf" => 2100,
            "emp_tax" => rand(2000, 5000),
            "emp_gross" => rand(45000, 50000),
            "emp_total_salary" => rand(40000, 45000),
        ];
    }
}
