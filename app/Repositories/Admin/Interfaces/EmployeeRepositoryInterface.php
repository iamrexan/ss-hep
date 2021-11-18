<?php

namespace App\Repositories\Admin\Interfaces;

use Jsdecena\Baserepo\BaseRepositoryInterface;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use App\Models\Employee;

interface EmployeeRepositoryInterface extends BaseRepositoryInterface
{
    public function getSalaryOfAnEmployee(int $id) : Collection;

    public function getAllEmployees(): Collection;

    public function getSummaryOfAnEmployee(Request $request): Collection;

    public function getAllEmployeeSalaryList(): Collection;

    public function findEmployee(int $id): Employee;
}