@extends('layouts.app_global')

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">Class Works</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboards</a></li>
                        <li class="breadcrumb-item active">Class Works</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->
    @if(!empty($reports))
        <div class="btn-group-fab" role="group" aria-label="FAB Menu">
            <div>
                <button type="button" class="btn btn-main btn-primary has-tooltip" data-placement="left" title="print" onclick="printReport()"> <i class="fa fa-print"></i> </button>
            </div>
        </div>
    @endif

    <form class="form-horizontal" action="{{ route('teacher.report.class_work') }}" method="GET">
        <div class="row">
            <div class="col-2">


                <div class="form-group">
                    <label>Student Name</label>
                    <div class="input-group">
                        <select class="form-control select2" name="student" required>
                            @foreach($enrolled as $data)
                                <option value="{{$data->std}}" <?= ($data->std == $user) ? 'selected' : ''?>>{{$data->name}}</option>
                            @endforeach
                        </select>
                    </div><!-- input-group -->
                </div>

            </div>

            <div class="col-2">
                <div class="form-group">
                    <label>Course</label>
                    <div class="input-group">
                        <select class="form-control select2" name="course"  required>
                            <option value="all" <?= ($csr=='all') ? 'selected' : ''?>>All</option>
                            @foreach($courses as $data)
                                <option value="{{$data->id}}" <?= ($data->id == $csr) ? 'selected' : ''?>>{{$data->course_title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>


            <div class="col-2">
                <div class="input-group">
                    <button type="submit" name="btn" class="btn btn-primary mt-4">Filter</button>
                </div>
            </div>
        </div>
    </form>
    <div class="card">
        <div class="card-body">
            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead>
                <tr>
                    <th>Date</th>
                    <th>Course</th>
                    <th>Eval</th>
                </tr>
                </thead>
                <tbody>
                @if(!empty($reports))
                @foreach($reports as $data)
                                                <tr>

                                                    <td>
                                                        <?php
                                                            $date = '';
                                                            $carDate = \Carbon\Carbon::parse($data->created_at);
                                                            $date =  $carDate->format('M d Y');
                                                            echo $date;
                                                        ?>

                                                    </td>
                                                    <td>{{$data->course_title}}</td>
                                                    <td>{{$data->evaluations}}</td>
                                                </tr>
                @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>


@endsection
@section('scripts')
<script>
    $(document).ready(function () {
        $(".select2").select2({});
        $("#datatable").DataTable();

    });

    function printReport(){
        window.open("{{url("teacher/report/class_work/print?student=")}}"+"{{$user}}"+'&'+"course={{$csr}}"+'&'+"btn=");
    }

</script>
@endsection
