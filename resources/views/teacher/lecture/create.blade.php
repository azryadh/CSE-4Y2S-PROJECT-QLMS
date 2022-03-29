@extends('layouts.app_global')
@section('content')
        <div class="card col-6">
            <div class="card-header">
                <h4>New Lecture</h4>
            </div>
            <div class="card-body">
                <form role="form" method="post" action="{{route('teacher.lecture.store')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="heading">Heading</label>
                                <input type="text" class="form-control" id="heading" name="heading" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="course">Course</label>
                                <select class="form-control select2" id="course" name="course_id" required>
                                    <option value="">Select One</option>
                                    @foreach($courses as $data)
                                        <option value="{{$data->id}}">{{$data->course_title}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div>
                        <textarea class="form-control" id="summernote" name="description">

                    </textarea>
                    </div>
                    <hr>

                    <div class="float-lg-right">
                        <button type="submit" class="btn btn-primary w-md">Submit</button>
                    </div>
                    <div class="float-lg-left">
                        <button type="button" class="btn btn-danger w-md">Cancel</button>
                    </div>
                </form>

            </div>
        </div>
@endsection
@section('scripts')
    <script>
        $('#summernote').summernote({
            placeholder: 'Hello Bootstrap 4',
            tabsize: 2,
            height: 400
        });
        $(".select2").select2();
    </script>
@endsection
