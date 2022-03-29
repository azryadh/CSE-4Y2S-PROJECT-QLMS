@extends('layouts.app_global')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">Detail</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Quiz</a></li>
                        <li class="breadcrumb-item active">Detail</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="invoice-title">
                        <h4 class="float-right font-size-16">{{\Carbon\Carbon::now()}}</h4>
                        <div class="mb-4">
                            <img src="{{asset('assets/images/logo-dark.png')}}" alt="logo" height="40"/>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-6">
                            <address>
                                <strong>From:</strong><br>
                                @if($user == 'all')
                                    {{$teacher->t_name}}<br>
                                    {{$teacher->t_email }}<br>
                                @else
                                    {{$teacher->name}}<br>
                                    {{$teacher->email }}<br>
                                @endif
                            </address>
                        </div>
                        <div class="col-sm-6 text-sm-right">
                            <address class="mt-2 mt-sm-0">

                                @if($user == 'all')
                                    <strong>Course:</strong><br>
                                    {{$c_name->course_title}}
                                @else
                                    <strong>To:</strong><br>
                                    {{$student->name}}<br>
                                    {{$student->email }}<br>
                                @endif

                            </address>
                        </div>
                    </div>
                    <div class="py-2 mt-3">
                        <h3 class="font-size-15 font-weight-bold">Summary</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-nowrap">
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
                                @if ($answers)
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
                    <div class="d-print-none">
                        <div class="float-right">
                            <a href="javascript:window.print()" class="btn btn-success waves-effect waves-light mr-1"><i class="fa fa-print"></i></a>
                            <a href="javascript:window.close()" class="btn btn-danger w-md waves-effect waves-light">close</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->

@endsection
@section('scripts')
    <script>
        $(document).ready(function () {
            // window.print();
        });

    </script>
@endsection
