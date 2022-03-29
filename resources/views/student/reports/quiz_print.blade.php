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
                                <strong>Titlt:</strong><br>
                               {{$title_q->title}}
                            </address>
                        </div>
                        <div class="col-sm-6 text-sm-right">
                            <address class="mt-2 mt-sm-0">
                                <strong>To:</strong><br>
                                {{$student->name}}<br>
                                {{$student->email }}<br>
                            </address>
                        </div>
                    </div>
                    <div class="py-2 mt-3">
                        <h3 class="font-size-15 font-weight-bold">Summary</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-nowrap">
                            <?php $count = 1; ?>
                            <thead>
                            <tr>
                                <th style="width: 70px;">No.</th>
                                <th>Questions</th>
                                <th>Student Ans.</th>
                                <th>Right Ans.</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(!empty($reports))
                                @foreach($reports as $data)
                                    <tr>
                                        <td>{{$count}}</td>
                                        <td>{{$data->question}}</td>
                                        <td>{{$data->user_answer}}</td>
                                        <td>{{$data->answer}}</td>
                                    </tr>
                                    <?php $count++; ?>
                                @endforeach
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
