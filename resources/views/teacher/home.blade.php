@extends('layouts.app_global')

@section('content')

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">Dashboard</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboards</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-xl-4">
            <div class="card overflow-hidden">
                <div class="bg-soft-primary">
                    <div class="row">
                        <div class="col-7">
                            <div class="text-primary p-3">
                                <h5 class="text-primary">Welcome Back !</h5>
                                <p>{{ config('app.name') }} Dashboard</p>
                            </div>
                        </div>
                        <div class="col-5 align-self-end">
                            <img src="assets/images/profile-img.png" alt="" class="img-fluid">
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="avatar-md profile-user-wid mb-4">
                                <img src="assets/images/users/avatar-1.jpg" alt="" class="img-thumbnail rounded-circle">
                            </div>
                            <h5 class="font-size-15 text-truncate">{{\Illuminate\Support\Facades\Auth::user()->name}}</h5>
                            <p class="text-muted mb-0 text-truncate">Teacher</p>
                        </div>

                        <div class="col-sm-8">
                            <div class="pt-4">

                                <div class="row">
                                    <div class="col-6">
                                        <h5 class="font-size-15">{{$courseCount}}</h5>
                                        <p class="text-muted mb-0">Courses</p>
                                    </div>
                                    <div class="col-6">
                                        <h5 class="font-size-15">{{$topics}}</h5>
                                        <p class="text-muted mb-0">Quiz</p>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <a href="#" class="btn btn-success waves-effect waves-light btn-sm">Approved <i class="mdi mdi-check ml-1"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Enrolled</h4>
                    <div class="row">
                        <div class="col-sm-6">
                            <p class="text-muted">This month</p>
                            <h3>{{$currentMonthCount}}</h3>
                            @if(!empty($currentMonthCount))
                                @if($currentMonthCount > $lastMonthCount)
                                    <p class="text-muted"><span class="text-success mr-2"> {{($currentMonthCount / $lastMonthCount)*100}}% <i class="mdi mdi-arrow-up"></i> </span> From previous period</p>
                                @else
                                    <p class="text-muted"><span class="text-danger mr-2"> {{($currentMonthCount / $lastMonthCount)*100}}% <i class="mdi mdi-arrow-down"></i> </span> From previous period</p>
                                @endif
                            @else
                            @endif


                            <div class="mt-4">
                                <a href="{{route('teacher.enrolled')}}" class="btn btn-primary waves-effect waves-light btn-sm">View More <i class="mdi mdi-arrow-right ml-1"></i></a>
                            </div>
                        </div>

                    </div>

                </div>
            </div>

        </div>

        <div class="col-xl-8">
            <div class="row">
                <div class="col-md-4">
                    <div class="card mini-stats-wid">
                        <div class="card-body">
                            <div class="media">
                                <div class="media-body">
                                    <p class="text-muted font-weight-medium">Course</p>
                                    <h4 class="mb-0">{{$courseCount}}</h4>
                                </div>

                                <div class="mini-stat-icon avatar-sm rounded-circle bg-primary align-self-center">
                                                        <span class="avatar-title">
                                                            <i class="bx bx-copy-alt font-size-24"></i>
                                                        </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mini-stats-wid">
                        <div class="card-body">
                            <div class="media">
                                <div class="media-body">
                                    <p class="text-muted font-weight-medium">Quiz</p>
                                    <h4 class="mb-0">{{$topics}}</h4>
                                </div>

                                <div class="avatar-sm rounded-circle bg-primary align-self-center mini-stat-icon">
                                                        <span class="avatar-title rounded-circle bg-primary">
                                                            <i class="bx bx-archive-in font-size-24"></i>
                                                        </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mini-stats-wid">
                        <div class="card-body">
                            <div class="media">
                                <div class="media-body">
                                    <p class="text-muted font-weight-medium">Enrolled</p>
                                    <h4 class="mb-0">{{$studentCount}}</h4>
                                </div>

                                <div class="avatar-sm rounded-circle bg-primary align-self-center mini-stat-icon">
                                                        <span class="avatar-title rounded-circle bg-primary">
                                                            <i class="bx bx-purchase-tag-alt font-size-24"></i>
                                                        </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <div class="card">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-4">Quiz</h4>
                                <div class="table-responsive">
                                    <table class="table table-centered table-nowrap mb-0">
                                        <thead class="thead-light">
                                        <tr>
                                            <th>Title</th>
                                            <th>Marks/Q</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(!empty($topic))
                                            @foreach($topic as $data)
                                                <tr>
                                                    <td>{{$data->title}}</td>
                                                    <td>{{$data->per_q_mark}}</td>

                                                    <td>
                                                        <!-- Button trigger modal -->
                                                        <a type="button" class="btn btn-primary btn-sm btn-rounded waves-effect waves-light" href="{{route('teacher.question.show', $data->id)}}">
                                                            <i class="mdi mdi-plus"></i> Question </a>
                                                    </td>
                                                </tr>
                                            @endforeach

                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->
            </div>
        </div>

    </div>

@endsection
@section('scripts')

@endsection

