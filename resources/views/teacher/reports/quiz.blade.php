@extends('layouts.app_global')

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">Quiz</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboards</a></li>
                        <li class="breadcrumb-item active">Quiz</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="btn-group-fab" role="group" aria-label="FAB Menu">
        <div>
            <button type="button" class="btn btn-main btn-primary has-tooltip" data-placement="left" title="print" onclick="printReport()"> <i class="fa fa-print"></i> </button>
        </div>
    </div>
    <form class="form-horizontal" action="{{ route('teacher.report.class_quiz') }}" method="GET">
        <div class="row">
            <div class="col-2">


                <div class="form-group">
                    <label>Student Name</label>
                    <div class="input-group">
                        <select class="form-control select2" name="student" required>
                            <option value="all" <?= ($user=='all') ? 'selected' : ''?>>All</option>
                            @foreach($enrolled as $data)
                                <option value="{{$data->std}}" <?= ($data->std == $user) ? 'selected' : ''?>>{{$data->name}}</option>
                            @endforeach
                        </select>
                    </div><!-- input-group -->
                </div>

            </div>


            <div class="col-2">
                <div class="form-group">
                    <label>Topic</label>
                    <div class="input-group">
                        <select class="form-control select2" name="topic"  required>
                            @foreach($topics as $data)
                                <option value="{{$data->id}}" <?= ($data->id == $tpc) ? 'selected' : ''?>>{{$data->title}}</option>
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
            @if(!empty($c_name))
                <div class="col-6 float-lg-end">
                    <h4>{{$c_name->course_title}}</h4>
                </div>
            @endif

        </div>
    </form>
    <div class="card">
        <div class="card-body">
            <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead>
                <tr>

                    @if($user == 'all')
                        <th>#</th>
                        <th>Student</th>
                        <th>Quiz</th>
                        <th>Marks Got</th>
                        <th>Total Marks</th>
                    @else
                        <th>#</th>
                        <th>Questions</th>
                        <th>Student Ans.</th>
                        <th>Right Ans.</th>
                    @endif

                </tr>
                </thead>
                <tbody>
                @if($user == 'all')
                    @if (!empty($answers))
                        @foreach ($filtStudents as $key => $student)
                            <tr>
                                <td>
                                    {{$key+1}}
                                </td>
                                <td>{{$student->name}}</td>
                                <td>{{$topic->title}}</td>
                                <td>
                                    @php
                                        $mark = 0;
                                        $correct = collect();
                                    @endphp
                                    @foreach ($answers as $answer)
                                        @if ($answer->user_id == $student->id && $answer->answer == $answer->user_answer)
                                            @php
                                                $mark++;
                                            @endphp
                                        @endif
                                    @endforeach
                                    @php
                                        $correct = $mark*$topic->per_q_mark;
                                    @endphp
                                    {{$correct}}
                                </td>
                                <td>
                                    {{$c_que*$topic->per_q_mark}}
                                </td>
                            </tr>
                        @endforeach
                    @endif
                @else
                    <?php $cout = 1; ?>
                    @if(!empty($reports))
                        @foreach($reports as $data)
                            <tr>
                                <td>
                                    {{$cout}}
                                </td>
                                <td>{{$data->question}}</td>
                                <td>{{$data->user_answer}}</td>
                                <td>{{$data->answer}}</td>
                            </tr>
                            <?php $cout++ ?>
                        @endforeach
                    @endif
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

        })

        function printReport(){
            window.open("{{url("teacher/report/class_quiz/print?student=")}}"+"{{$user}}"+'&'+'&'+"topic={{$tpc}}"+'&'+"btn=");
        }

    </script>
@endsection
