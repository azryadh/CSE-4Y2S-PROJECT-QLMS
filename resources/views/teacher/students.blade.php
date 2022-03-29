@extends('layouts.app_global')

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">Enrolled Student</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Enrolled</a></li>
                        <li class="breadcrumb-item active">Enrolled</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="justify-content-center">
        <div class="card">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Enrolled Log</h4>
                            <div class="table-responsive">
                                <table class="table table-centered table-nowrap mb-0">
                                    <thead class="thead-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>TimeStamp</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $count = 1; ?>
                                                                    @if(!empty($enrolled))
                                                                        @foreach($enrolled as $data)
                                                                            <tr>
                                                                                <td>{{$count}}</td>
                                                                                <td>{{$data->name}}</td>
                                                                                <td>{{$data->email}}</td>

                                                                                <td>
                                                                                    <!-- Button trigger modal -->
                                                                                    <a type="button" class="btn btn-primary btn-sm btn-rounded waves-effect waves-light" href="javascript:void(0)">
                                                                                        {{Carbon\Carbon::parse($data->created_at)->diffForHumans()}} </a>
                                                                                </td>
                                                                            </tr>
                                                                            <?php $count++ ?>
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

@endsection
