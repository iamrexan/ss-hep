<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Employee year vice summary') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div>
                        <div style="margin:10px auto;width:100%;display:flex;flex-direction: row;justify-content: center;align-items: flex-end;">
                            <div>
                            <label style="margin-right:10px">Select Year:</label>
                            <select id="year">
                                    <option value="2018" selected>2018</option>
                                    <option value="2019">2019</option>
                                    <option value="2020">2020</option>
                                    <option value="2021">2021</option>
                            </select>
                            </div>
                            <div class="ml-10">
                              <label style="margin-right:10px">Select an Employee:</label>
                              <select id="employee">
                                  @foreach($employees as $employee)
                                      <option value="{{ $employee->id }}" {{($employee->id == 1) ? 'selected=true' : ''}}>{{$employee->name}}</option>
                                  @endforeach
                              </select>
                            </div>
                            <button id="get-employee" class="btn btn-primary ml-10">Submit</button>
                        </div>
                        <div style="margin:10px 0;padding: 30px;line-height:30px;display: flex;flex-direction: row;justify-content: space-evenly;" id="summary">
                          <div>
                            <ul>
                              <li>Employee Name: <span id="name">{{ $employee->first()->name }}</span></li>
                              <li>Employee Mobile: <span id="mobile">{{ $employee->first()->mobile }}</span></li>
                              <li>Employee Email: <span id="email">{{ $employee->first()->email }}</span></li>
                            </ul>
                          </div>
                          <div>
                            <ul>
                              <li>City: <span id="city">{{ $employee->first()->city }}</span></li>
                              <li>pincode: <span id="pincode">{{ $employee->first()->pincode }}</span></li>
                              <li>State: <span id="state">{{ $employee->first()->state }}</span></li>
                            </ul>
                          </div>
                        </div>
                        <table class="table table-bordered employee-datatable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Month</th>
                                    <th>Year</th>
                                    <th>Basic Salary</th>
                                    <th>HRA</th>
                                    <th>PF</th>
                                    <th>tax</th>
                                    <th>Gross salary</th>
                                    <th>Total salary</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@push('script')
<script type="text/javascript">
        var datatable;
        $(function () {
          renderTable();

          $('#get-employee').on('click', () => {
            datatable.destroy();
            renderTable();
          });
        });

        function updateAllValues(data) {
          $('#summary').find('span').each((i, n) => {
              $(n).text(data[n.id]);
          });
        }

        function renderTable() {
          $.ajax({
                "url": `{{ route('employee.summary.data') }}?id=${parseInt($('select#employee')[0].value)}&year=${$('select#year')[0].value}`,
                "type": "GET",
                "datatype": 'json',
                "bDestroy": true,
                "success": function (data) {
                  updateAllValues(data[1]);
                  datatable = $('.employee-datatable').DataTable({
                        data: data[0].original.data,
                        columns: [
                          {data: 'DT_RowIndex'},
                          {data: 'salary_month'},
                          {data: 'salary_year'},
                          {data: 'emp_basic_salary'},
                          {data: 'emp_hra'},
                          {data: 'emp_pf'},
                          {data: 'emp_tax'},
                          {data: 'emp_gross'},
                          {data: 'emp_total_salary'}
                        ]
                    });
                }
            });
        }
    </script>
@endpush
</x-app-layout>
