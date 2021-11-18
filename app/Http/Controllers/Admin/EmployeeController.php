<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use App\Repositories\Admin\Interfaces\EmployeeRepositoryInterface;
use App\Http\Requests\EmployeeSalaryRequest;
use Carbon\Carbon;

class EmployeeController extends Controller
{
    private $employeeRepositoryInterface;

    public function __construct(EmployeeRepositoryInterface $employeeRepositoryInterface) {
        $this->employeeRepositoryInterface = $employeeRepositoryInterface;
    }

    public function index() {
        $employees = $this->employeeRepositoryInterface->getAllEmployees();
        return view('admin.employee.list', \compact('employees'));
    }

    public function getEmployeesEachMonthSalaryData(EmployeeSalaryRequest $request) {
        if ($request->ajax()) {
            $data = $this->employeeRepositoryInterface->getSalaryOfAnEmployee($request->get('id'));
            return DataTables::of($data->first()->salary)
                ->addIndexColumn()
                ->editColumn('salary_month', function($data) {
                  return Carbon::create()->month($data->salary_month)->format('M');
                })
                ->editColumn('emp_total_salary', function($data) {
                  return \number_format($data->emp_total_salary, 2);
                })
                ->make(true);
        }
        $employees = $this->employeeRepositoryInterface->getAllEmployees();
        
        return view('admin.employee.list', \compact('employees'));
    }

    public function getEmployeeSummaryData(Request $request) {
      if ($request->ajax()) {
          $data = $this->employeeRepositoryInterface->getSummaryOfAnEmployee($request);
          $datatable = DataTables::of($data)
              ->addIndexColumn()
              ->editColumn('salary_month', function($data) {
                return Carbon::create()->month($data->salary_month)->format('M');
              })
              ->make(true);

          return response()->json([$datatable, $this->employeeRepositoryInterface->findEmployee($request->get('id'))]);
      }

      return view('admin.employee.summary')
                ->withEmployees($this->employeeRepositoryInterface->getAllEmployees());
    }

    public function getAllEmployeeSalaryList(Request $request) {
        if ($request->ajax()) {
          $data = $this->employeeRepositoryInterface->getAllEmployeeSalaryList();
          return DataTables::of($data)
              ->addIndexColumn()
              ->editColumn('salary_month', function($data) {
                return Carbon::create()->month($data->salary_month)->format('M');
              })
              ->editColumn('emp_total_salary', function($data) {
                return number_format($data->emp_total_salary, 2);
              })
              ->make(true);
      }

      return view('admin.employee.all-list');
    }
}
