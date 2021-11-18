<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Employee Each month salary details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div>
                        <table class="table table-bordered employee-datatable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Month</th>
                                    <th>Year</th>
                                    <th>Year</th>
                                    <th>Year</th>
                                    <th>Year</th>
                                    <th>Year</th>
                                    <th>Year</th>
                                    <th>Year</th>
                                    <th>Year</th>
                                    <th>Total Salary drawn</th>
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
        $(function () {
          renderTable();

          $('#employee').on('change', () => {
            renderTable();
          });
        });

        function renderTable() {
          var table = $('.employee-datatable').DataTable({
              processing: true,
              serverSide: true,
              "bDestroy": true,
              ajax: "{{ route('employee.all.data') }}",
              columns: [
                  {data: 'DT_RowIndex'},
                  {data: 'name'},
                  {data: 'designation'},
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
    </script>
@endpush
</x-app-layout>
