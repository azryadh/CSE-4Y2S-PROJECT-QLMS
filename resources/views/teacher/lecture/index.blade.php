@extends('layouts.app_global')
@section('content')
    <div class="my-4 text-right">
        <a type="button" href="{{route('teacher.lecture.create')}}" class="btn btn-success waves-effect waves-light" ><i class="bx bx-plus-circle"></i> Create Lecture</a>
    </div>
        <div class="card">
            <div class="card-body">
                <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Course</th>
                        <th>Token</th>
                        <th>Lecture Count</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i = 1; ?>
                    @if(!empty($lectures))
                        @foreach($lectures as $data)
                            <tr>
                                <td><?php echo $i?></td>
                                <td>{{$data->course_title}}</td>
                                <td>{{$data->course_code}}</td>
                                <td><a href="{{url("teacher/lecture/view/".$data->courses_id)}}">{{$data->lecture_count}}</a></td>
                            </tr>
                            <?php $i++ ?>
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
            $("#datatable").DataTable()
        });
    </script>
@endsection
