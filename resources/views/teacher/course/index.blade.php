@extends('layouts.app_global')
@section('content')
    <div class="row">
        <div class="btn-group-fab" role="group" aria-label="FAB Menu">
            <div>
                <button type="button" class="btn btn-main btn-primary has-tooltip" data-placement="left" title="New" data-toggle="modal" data-target=".bs-add-course-modal"> <i class="fa fa-plus"></i> </button>
            </div>
        </div>
        @if(!empty($courses))
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
                            <p class="text-muted">
                                {{$course->course_code}}
                            </p>

                            <div>
                                <a href="#" class="badge badge-info font-size-11 m-1">{{$course->code}}</a>
                                <?php $i = 0; ?>
                                @foreach($counts as $count)
                                    @if($course->id == $count->courses_id)
                                        <?php $i++; ?>
                                    @endif

                                @endforeach
                                <a href="#" class="badge badge-danger font-size-11 m-1">Enrolled: <?php echo $i;?></a>

                            </div>
                        </div>
                        <div class="card-footer bg-transparent border-top">
                            <div class="contact-links d-flex font-size-20">
                                <div class="flex-fill">
                                    <a href="#" data-toggle="tooltip" data-placement="top" title="Post"><i class="bx bx-message-square-dots"></i></a>
                                </div>
                                <div class="flex-fill">
                                    <a href="{{url("/classroom/$course->id")}}" data-toggle="tooltip" data-placement="top" title="View"><i class="bx bx-slideshow"></i></a>
                                </div>
                                <div class="flex-fill">
                                    <a href="#" data-toggle="tooltip" data-placement="top" title="Edit" onclick="showEdit({{$course->id}})"><i class="bx bxs-eyedropper"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        @endif

    </div>

    <div class="modal fade bs-add-course-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0">Create Course</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="outer-repeater" role="form" action="{{route('teacher.course.store')}}" method="post">
                        @csrf
                        <input type="hidden" name="users_id" value="{{\Illuminate\Support\Facades\Auth::user()->id}}">
                        <div data-repeater-list="outer-group" class="outer">
                            <div data-repeater-item class="outer">
                                <div class="form-group">
                                    <label for="title">Title :</label>
                                    <input type="text" class="form-control" id="title" name="course_title" placeholder="Enter Course Title..." autocomplete="off">
                                </div>
                                    <div class="form-group">
                                        <label for="title" id="code_chk_add">Course Code :</label>
                                        <input type="text" class="form-control" id="code" name="code" placeholder="Enter Course Code..." autocomplete="off" onkeyup="check_c_code(this.value)"/>
                                    </div>
                                <div class="text-right">
                                    <button id="add_sub" type="submit" class="btn btn-primary">Submit</button>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <div class="modal fade bs-add-course-modal_edit" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0">Edit Course</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="outer-repeater" role="form" action="{{route('teacher.course.update')}}" method="post">
                        @csrf
                        <input type="hidden" name="id" id="c_id" value="">
                        <div data-repeater-list="outer-group" class="outer">
                            <div data-repeater-item class="outer">
                                <div class="form-group">
                                    <label for="titleEdit">Title :</label>
                                    <input type="text" class="form-control" id="titleEdit" name="course_title" placeholder="Enter Course Title..." autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label for="code_edit" id="code_chk_add_edit">Course Code :</label>
                                    <input type="text" class="form-control" id="code_edit" name="code" placeholder="Enter Course Code..." autocomplete="off" onkeyup="check_c_code_edit(this.value)"/>
                                </div>
                                <div class="text-right">
                                    <button id="add_sub_edit" type="submit" class="btn btn-primary">Submit</button>
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
    $(document).keypress(
        function(event){
            if (event.which == '13') {
                event.preventDefault();
            }
        });
    var editModal = $('.bs-add-course-modal_edit');
    var course_title = $('#titleEdit');
    var code_chk_add = $('#code_chk_add');
    var code_chk_add_edit = $('#code_chk_add_edit');
    var add_sub = $('#add_sub');
    var add_sub_edit = $('#add_sub_edit');
    var code_edit = $('#code_edit');
    function showEdit(any){
        $('#c_id').val(any);

        // console.log( $('#c_id').val());
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{ route('teacher.course.edit') }}",
            method: 'get',
            data: {
                id: any,
            },
            success: function(result){

                course_title.val(result.msg.course.course_title);
                code_edit.val(result.msg.course.code);
                editModal.modal();

            }});

    }
    function check_c_code(any){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{ route('teacher.course.code_check') }}",
            method: 'get',
            data: {
                id: any,
            },
            success: function(result){

                // course_title.val(result.msg.course.course_title);
                if (result.msg.course){
                    code_chk_add.html('Not Available');
                    add_sub.hide();
                }  else {code_chk_add.html('Available'); add_sub.show();}

            }});
    }

    function check_c_code_edit(any){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{ route('teacher.course.code_check') }}",
            method: 'get',
            data: {
                id: any,
            },
            success: function(result){

                // course_title.val(result.msg.course.course_title);
                if (result.msg.course){
                    code_chk_add_edit.html('Not Available');
                    add_sub_edit.hide();
                }  else {code_chk_add_edit.html('Available'); add_sub_edit.show();}

            }});
    }

</script>
@endsection
