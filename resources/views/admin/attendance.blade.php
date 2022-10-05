@extends('layouts.master')

@section('css')
    <!-- Table css -->
    <link href="{{ URL::asset('plugins/RWD-Table-Patterns/dist/css/rwd-table.min.css') }}" rel="stylesheet" type="text/css" media="screen">
@endsection

@section('breadcrumb')
    <div class="col-sm-6">
        <h4 class="page-title text-left">Attendance</h4>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0);">Attendance</a></li>


        </ol>
    </div>
@endsection

@section('button')
    <a href="#Uploadfile" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="mdi mdi-plus mr-2"></i>Add</a>
@endsection

@section('content')
@include('includes.flash')
<!-- Add -->
<div class="modal fade" id="Uploadfile">
    <div class="modal-dialog">
        <div class="modal-content">
            
            <div class="modal-header">
                <h4 class="modal-title"><b>Upload Attendance</b></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                 
            </div>

           
            <div class="modal-body">

                <div class="card-body text-left">

                    <form method="POST" action="/attendance/uploadData" enctype="multipart/form-data">
                        @csrf
                      
                        {{-- <div class="form-group">
                            <label for="schedule" class="col-sm-12 control-label">Employee Name</label>


                            <select class="form-control" id="employee" name="employee" required>
                                <option value="" selected>- Select -</option>
                                @foreach ($employee as $emp)
                                    <option value="{{ $emp->id }}">{{ $emp->name }}  </option>
                                @endforeach

                            </select>

                        </div> --}}
                        <div class="form-group">
                            <label for="schedule" class="col-sm-12 control-label">Upload File</label>
                            <input type="file" name="file" class="form-control" accept=".csv" >
                        </div>

                        <div class="form-group">
                            <div>
                                <button type="submit" class="btn btn-primary waves-effect waves-light">
                                    Submit
                                </button>
                                <button type="reset" class="btn btn-secondary waves-effect m-l-5"
                                    data-dismiss="modal">
                                    Cancel
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>


        </div>

    </div>
</div>
</div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <div class="table-rep-plugin">
                        <div class="table-responsive mb-0" data-pattern="priority-columns">
                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        
                                <thead>
                                    <tr>
                                        <th data-priority="1">Date</th>
                                        <th data-priority="2">Employee ID</th>
                                        <th data-priority="3">Name</th>
                                        <th data-priority="4">Attendance</th>

                                        <th data-priority="6">Time In</th>
                                        <th data-priority="7">Time Out</th>


                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($attendances as $attendance)

                                        <tr>
                                            <td>{{ $attendance->attendance_date }}</td>
                                            <td>{{ $attendance->emp_id }}</td>
                                            <td>{{ $attendance->employee->name }}</td>
                                            <td>{{ $attendance->attendance_time }}
                                                @if ($attendance->status == 1)
                                                    <span class="badge badge-primary badge-pill float-right">On Time</span>
                                                @else
                                                    <span class="badge badge-danger badge-pill float-right">Late</span>
                                                @endif
                                            </td>

                                            <td>{{ $attendance->employee->schedules->first()->time_in }} </td>
                                            <td>{{ $attendance->employee->schedules->first()->time_out }}</td>
                                        </tr>

                                    @endforeach


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

@endsection


@section('script')
    <!-- Responsive-table-->
    <script src="{{ URL::asset('plugins/RWD-Table-Patterns/dist/js/rwd-table.min.js') }}"></script>
 
@endsection

@section('script')
    <script>
        $(function() {
            $('.table-responsive').responsiveTable({
                addDisplayAllBtn: 'btn btn-secondary'
            });
        });
    </script>
@endsection
