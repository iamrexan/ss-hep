<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Employee::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "emp_title" => $this->faker->jobTitle(),
            "name" => $this->faker->name(),
            "email" => $this->faker->unique()->safeEmail(),
            "mobile" => $this->faker->randomNumber(9, true),
            "date_of_join" =>  \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', now())->toString(),
            "city" => $this->faker->city(),
            "pincode" => $this->faker->postcode(),
            "state" => $this->faker->state(),
        ];
    }
}
