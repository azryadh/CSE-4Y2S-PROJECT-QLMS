@extends('layouts.app_global')
@section('content')
    <div class="blog-box">
        <div class="card">
            <div class="card-body">
                <div id="accordion">
                    @if(!empty($lectures))
                        @foreach($lectures as $data)
                            <div class="card mb-1 shadow-none">
                                <div class="card-header" id="headingTwo{{$data->lectures_id}}">
                                    <h6 class="m-0">
                                        <a href="#collapseTwo{{$data->lectures_id}}" class="text-dark collapsed" data-toggle="collapse"
                                           aria-expanded="false"
                                           aria-controls="collapseTwo{{$data->lectures_id}}">
                                           {{$data->heading}}
                                        </a>
                                    </h6>
                                </div>
                                <div id="collapseTwo{{$data->lectures_id}}" class="collapse" aria-labelledby="headingTwo{{$data->lectures_id}}"
                                     data-parent="#accordion">
                                    <div class="card-body">
                                        <form role="form" method="post" action="{{route('teacher.lecture.update')}}" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="courses_id" value="{{$data->courses_id}}">
                                            <input type="hidden" name="lectures_id" value="{{$data->lectures_id}}">
                                            <div class="form-group">
                                                <label for="heading">Heading</label>
                                                <input type="text" class="form-control" id="heading" name="heading" required value="{{$data->heading}}">
                                            </div>
                                            <textarea class="summernote form-control" name="description">{{$data->description}}</textarea>
                                            <hr>

                                            <div class="float-lg-right">
                                                <button type="submit" class="btn btn-primary w-md">Update</button>
                                            </div>
                                            <div class="float-lg-left">
                                                <button type="button" class="btn btn-danger w-md">Delete</button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        @endforeach
                        @endif

                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <script>
        $('.summernote').summernote({
            placeholder: 'Hello Bootstrap 4',
            tabsize: 2,
            height: 400
        });
    </script>
@endsection
