<?php
namespace App\Repositories\Admin;

use App\Models\Salary;
use App\Models\Employee;
use Jsdecena\Baserepo\BaseRepository;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use App\Repositories\Admin\Interfaces\EmployeeRepositoryInterface;

class EmployeeRepository extends BaseRepository implements employeeRepositoryInterface
{
    protected $salary;
    /**
     * CategoryRepository constructor.
     * @param Salary $salary
     */
    public function __construct(Employee $employee, Salary $salary)
    {
        parent::__construct($employee);
        $this->model = $employee;
        $this->salary = $salary;
    }

    /**
     * List all month salary of an employee
     * @param Integer $id
     */
    public function getSalaryOfAnEmployee($id) : Collection
    {
        return $this->model->with('salary')->whereIn('id', [$id])->get();
    }

    /**
     * List all month salary of an employee
     * @param Request $request
     */
    public function getSummaryOfAnEmployee(Request $request) : Collection
    {
        return $this->salary
                    ->where('salary_year', $request->get('year'))
                    ->whereHas('employee', function($query) use ($request) {
                          $query->where('id', $request->get('id'));
                    })->get();
    }

    /**
     * List All employees each month salaries
     * 
     */
    public function getAllEmployeeSalaryList() : Collection
    {
        return $this->salary->join('employees', 'salaries.emp_id', '=', 'employees.id')
            ->orderBy('salaries.salary_year', 'desc')
            ->orderBy('salaries.salary_month', 'desc')
            ->orderBy('employees.name', 'asc')
            ->get(['employees.emp_title as designation', 'employees.name', 'salaries.*']);
    }

    /**
     * List all employees
     * 
     */
    public function getAllEmployees() : Collection
    {
        return $this->model->all();
    }

    /**
     * Find an employee
     * @param Integer $id
     */
    public function findEmployee(int $id) : Employee
    {
        return $this->model->find($id);
    }
}