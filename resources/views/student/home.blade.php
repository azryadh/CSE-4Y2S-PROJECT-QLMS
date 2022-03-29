@extends('layouts.app_global')

@section('content')

    <div class="btn-group-fab" role="group" aria-label="FAB Menu">
        <div>
            <button type="button" class="btn btn-main btn-primary has-tooltip" data-placement="left" title="New" data-toggle="modal" data-target=".bs-add-course-modal"> <i class="fa fa-plus"></i> </button>
        </div>
    </div>

    @if(!empty($courses))
        <div class="row">
            @foreach($courses as $course)

                <div class="col-xl-3 col-sm-6">
                    <div class="card text-center">
                        <div class="card-body">
                            <div class="avatar-sm mx-auto mb-4">
                                            <span class="avatar-title rounded-circle bg-soft-primary text-primary font-size-16">
                                                {{ substr($course->course_title, 0, 1)}}
                                            </span>
                            </div>
                            <h5 class="font-size-15"><a href="#" class="text-dark">{{$course->course_title}}</a></h5>
                        </div>
                        <div class="card-footer bg-transparent border-top">
                            <div class="contact-links d-flex font-size-20">
                                <div class="flex-fill">
                                    <a href="{{url("/classroom/$course->c_id")}}" data-toggle="tooltip" data-placement="top" title="View"><i class="bx bx-slideshow"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>


    @endif
    <div class="modal fade bs-add-course-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0">Join Courses</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="outer-repeater" role="form" action="{{route('student.join')}}" method="post">
                        @csrf
{{--                        <input type="hidden" name="course_id" value="{{$course->id}}">--}}
                        <div data-repeater-list="outer-group" class="outer">
                            <div data-repeater-item class="outer">
                                <div class="form-group">
                                    <label for="code">Code :</label>
                                    <input type="text" class="form-control" id="code" name="code" autocomplete="off">
                                </div>
                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection
@section('scripts')
<script>

</script>
@endsection
