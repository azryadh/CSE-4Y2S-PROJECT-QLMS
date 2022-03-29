@extends('layouts.app_global')
@section('content')
    <?php $user = \Illuminate\Support\Facades\Auth::user() ?>
    <div class="card">
        <div class="card-body">

            <h4 class="card-title">{{$course->course_title}}</h4>
            <p class="card-title-desc">{{$course->code}}</p>
            <div class="row">
                <div class="col-md-2">
                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <a class="nav-link mb-2 <?php if ($tab_active=="lecture_active") {echo "active"; } else  {echo "noactive";}?>"  href="{{url("/classroom/$course->id")}}" >Lectures</a>
                        <a class="nav-link mb-2 <?php if ($tab_active=="lecture_classwork") {echo "active"; } else  {echo "noactive";}?>" href="{{url("/classroom/class_work/$course->id")}}">Class Works</a>
                        <a class="nav-link mb-2 <?php if ($tab_active=="discussion_active") {echo "active"; } else  {echo "noactive";}?>" href="{{url("/classroom/discussion/$course->id")}}" >Discussions</a>
                        <a class="nav-link mb-2 <?php if ($tab_active=="quiz_active") {echo "active"; } else  {echo "noactive";}?>" href="{{url("/classroom/quiz/$course->id")}}" >Quiz</a>
                        @if($user->isTeacher())
                            <a class="nav-link <?php if ($tab_active=="student_active") {echo "active"; } else  {echo "noactive";}?>" href="{{url("/classroom/student/$course->id")}}">Students</a>
                        @endif

                        <hr>
                        @if($tab_active=="discussion_active")
                            <button class="btn btn-outline-success" id="new_post_button" onclick="toggle_posts_to_new_post()">New Post</button>
                        @endif

                    </div>
                </div>
                <div class="col-md-10">
                    @if($tab_active=="lecture_active")
                        @if(!empty($lectures))
                            <div class="card">
                                @foreach ($lectures as $data)

                                        <div class="card-header">
                                            <h4 class="text-muted">{{$data->heading}}</h4>
                                        </div>
                                        <div class="card-body">
                                            <?php echo $data->description?>
                                        </div>

                                @endforeach
                                    {{ $lectures->links() }}
                            </div>


                        @else
                            <p class="mb-0">
                                Nothing Found
                            </p>
                        @endif
                    @elseif($tab_active=="lecture_classwork")
                        @if(!$user->isStudent())
                        <div class="btn-group-fab" role="group" aria-label="FAB Menu">
                            <div>
                                <button type="button" class="btn btn-main btn-primary has-tooltip" data-placement="left" title="New" data-toggle="modal" data-target=".bs-add-course-modal"> <i class="fa fa-plus"></i> </button>
                            </div>
                        </div>
                        @endif
                        <div id="accordion">
                            @if(!empty($class_works))
                                @foreach($class_works as $data)
                                    <div class="card mb-1 shadow-none text-dark">
                                        <div class="card-header" id="headingOne{{$data->id}}">
                                            <h6 class="m-0">
                                                <a href="#collapseOne{{$data->id}}" class="text-dark collapsed" data-toggle="collapse"
                                                   aria-expanded="false"
                                                   aria-controls="collapseOne{{$data->id}}">
                                                    {{$data->question}} <span></span> <span class="badge-info">{{Carbon\Carbon::parse($data->created_at)->diffForHumans()}}</span>
                                                </a>
                                            </h6>
                                        </div>

                                        <div id="collapseOne{{$data->id}}" class="collapse"
                                             aria-labelledby="headingOne{{$data->id}}" data-parent="#accordion">

                                                @if(!empty($data->description))
                                                    <div class="card-body">
                                                        <h4>Description</h4>
                                                        <?php echo $data->description ?>
                                                    </div>
                                                @endif
                                            <hr>
                                                    @if($user->isStudent())
                                                        @if(!empty($data->flag))
                                                            <p class="alert-success">Remarks: {{$data->evaluations}}</p>
                                                        @else
                                                            <form role="form" action="{{route('class.work.store.student')}}" method="post" id="{{$data->id}}">
                                                                @csrf
                                                                <input type="hidden" name="courses_id" value="{{$course->id}}">
                                                                <input type="hidden" name="class_works_id" value="{{$data->id}}">
                                                                <label for="ans">Your Answer</label>
                                                                <textarea class="form-control summernote" id="ans" name="answers" required></textarea>
                                                                <hr>
                                                                <button class="btn btn-primary" type="submit">Submit</button>
                                                            </form>
                                                        @endif
                                                    @elseif($user->isTeacher())
                                                        <table class="table table-bordered dt-responsive nowrap datatable" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                            <thead>
                                                            <tr>
                                                                <th>Name</th>
                                                                <th>Answer</th>
                                                                <th>Evaluation</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            @if(!empty($class_works_ans_teacher))
                                                                @foreach($class_works_ans_teacher as $ans)
                                                                    @if($ans->cls_id == $data->id)
                                                                        <tr>
                                                                            <td>{{$ans->name}}</td>
                                                                            <td><a href="javascript:showAns({{$ans->cl_id}})">Answers <i class="bx bxs-eyedropper"></i></a></td>
                                                                            <td>{{$ans->evaluations}}</td>
                                                                        </tr>
                                                                    @endif
                                                                @endforeach
                                                            @endif

                                                            </tbody>
                                                        </table>
                                                    @endif


                                        </div>
                                    </div>
                                @endforeach
                            @endif

                        </div>
                    @elseif($tab_active=="discussion_active")
                        <div class="container mt-3">
                            <div class="card">

                                <div class="card-body">
                                    <div id="post_box_new">
                                        <form role="form" method="post" action="{{route('class.posts.store')}}" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="c_id" value="{{$course->id}}">
                                            <div class="form-group">
                                                <textarea class="form-control" id="post_txt" style="height: 200px" placeholder="Whats on your mind?" required name="post"></textarea>
                                                <small id="post_txt" class="form-text text-muted">Start discussion with your classmates .</small>
                                            </div>
                                            <div class="form-group">
                                                <label for="image">Image</label>
                                                <input type="file" class="form-control" id="image" placeholder="image" name="img">
                                            </div>
                                            <hr>
                                            <button type="button" class="btn btn-outline-danger float-lg-left" onclick="_to_post_list()">Close</button>
                                            <button type="submit" class="btn btn-outline-primary float-lg-right">Post</button>
                                        </form>
                                    </div>
                                    <div id="post_box">

                                            <div class="row">
                                                @foreach($discussions as $discus)
                                                <div class="col-xl-3 col-sm-6">
                                                    <div class="card">
                                                        <img src="{{asset("uploads/posts/img/$discus->img")}}" class="card-img-top" alt="...">
                                                        <div class="card-body">
                                                            <h5 class="card-title"><span class="text-primary">@</span> {{$discus->name}} <i class="bx bx-selection"></i></h5>
                                                            <p class="card-text">{{\Illuminate\Support\Str::words($discus->post,6,'...')}}</p>
                                                            <a href="{{url("/classroom/posts/details/$discus->id/$discus->course_id")}}" class="btn btn-primary float-lg-right">See More</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                                {{$discussions->links()}}
                                            </div>



                                    </div>

                                </div>
                            </div>
                        </div>

                    @elseif($tab_active=="quiz_active")
                        @if($user->isStudent())
                            <div>
                                <div class="row">
                                    @if ($topics)
                                        @foreach ($topics as $topic)
                                            <div class="col-md-4">
                                                <div class="topic-block">
                                                    <div class="card">
                                                        <div class="card-body white-text">
                                                            <span class="text-center">{{$topic->title}}</span>
                                                            <p style="margin-left: 10px" title="{{$topic->description}}">{{ Str::limit($topic->description, 120, '....')}}</p>
                                                            <div class="row">
                                                                <div class="col-xs-6 pad-0">
                                                                    <ul class="text-decoration-underline">
                                                                        <li>Per Question Mark <i class="bx bx-right-arrow-alt"></i></li>
                                                                        <li>Total Marks <i class="bx bx-right-arrow-alt"></i></li>
                                                                        <li>Total Questions <i class="bx bx-right-arrow-alt"></i></li>
                                                                        <li>Total Time <i class="bx bx-right-arrow-alt"></i></li>
                                                                    </ul>
                                                                </div>
                                                                <div class="col-xs-6">
                                                                    <ul class="topic-detail right">
                                                                        <li>{{$topic->per_q_mark}}</li>
                                                                        <li>
                                                                            @php
                                                                                $qu_count = 0;
                                                                            @endphp
                                                                            @foreach($questions as $question)
                                                                                @if($question->topic_id == $topic->id)
                                                                                    @php
                                                                                        $qu_count++;
                                                                                    @endphp
                                                                                @endif
                                                                            @endforeach
                                                                            {{$topic->per_q_mark*$qu_count}}
                                                                        </li>
                                                                        <li>
                                                                            {{$qu_count}}
                                                                        </li>
                                                                        <li>
                                                                            {{$topic->timer}} minutes
                                                                        </li>

                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <div class="card-action text-center">

                                                            @if (Session::has('added'))
                                                                <div class="alert alert-success sessionmodal">
                                                                    {{session('added')}}
                                                                </div>
                                                            @elseif (Session::has('updated'))
                                                                <div class="alert alert-info sessionmodal">
                                                                    {{session('updated')}}
                                                                </div>
                                                            @elseif (Session::has('deleted'))
                                                                <div class="alert alert-danger sessionmodal">
                                                                    {{session('deleted')}}
                                                                </div>
                                                            @endif

                                                            <a target="_blank" href="{{route('start_quiz', ['id' => $topic->id])}}" class="btn btn-outline-success float-lg-right" title="Start Quiz">Start Quiz </a>

                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        @endif

                            @elseif($tab_active=="student_active")
                                    @if($user->isTeacher())
                                    <table class="table dataTable">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>name</th>
                                            <th>email</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(!empty($students))
                                            @foreach($students as $student)
                                                <tr>
                                                    <td>
                                                       S
                                                    </td>
                                                    <td>{{$student->name}}</td>
                                                    <td>{{$student->email}}</td>
                                                </tr>
                                            @endforeach
                                        @endif

                                        </tbody>

                                    </table>
                                    @endif

                            @endif


                </div>
            </div>
            <!-- Nav tabs -->


        </div>
    </div>

    <div class="modal fade bs-add-course-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0">New Questions</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="outer-repeater" role="form" action="{{route('class.work.store')}}" method="post">
                        @csrf
                        <input type="hidden" name="course_id" value="{{$course->id}}">
                        <div data-repeater-list="outer-group" class="outer">
                            <div data-repeater-item class="outer">
                                <div class="form-group">
                                    <label for="question_title">Questions :</label>
                                    <input type="text" class="form-control" id="question_title" name="question_title" >
                                </div>
                                <div class="form-group">
                                    <label for="question">Description :</label>
                                    <textarea  class="form-control summernote" id="question" name="question" ></textarea>
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
    <div class="modal fade bs-add-evaluation-modal_edit" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0">Evaluation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="outer-repeater" role="form" action="{{route('class.work.ans.teacher.eval')}}" method="post">
                        @csrf
                        <input type="hidden" name="id" id="c_id" value="">
                        <input type="hidden" name="cid" id="cl_id" value="">
                        <div data-repeater-list="outer-group" class="outer">
                            <div data-repeater-item class="outer">
                                <div class="form-group">
                                    <label>Answers</label>
                                    <div class="click2edit"></div>
                                </div>

                                <div class="form-group">
                                    <label>Evaluation</label>
                                    <select class="form-control" name="eval_select" required>
                                        <option>Select one</option>
                                        @if(!empty($eval))
                                            @foreach($eval as $ev)
                                                <option value="{{$ev->title}}">{{$ev->title}}</option>
                                            @endforeach
                                        @endif

                                    </select>
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
    var editModal = $('.bs-add-evaluation-modal_edit');
    var course_title = $('.click2edit');
    var c_id = $('#c_id');
    var cl_id = $('#cl_id');
    //post
    var post_box_new = $('#post_box_new');
    var post_box = $('#post_box');
    var btn_new_post = $('#new_post_button');
    post_box_new.hide();
    function showAns(any){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{ route('class.work.ans.teacher') }}",
            method: 'get',
            data: {
                id: any,
            },
            success: function(result){
                course_title.html(result.msg.ans.answers);
                c_id.val(result.msg.ans.id);
                cl_id.val(result.msg.ans.courses_id);
                console.log(result.msg.ans.answers);
                editModal.modal();

            }});

    }
    $('.summernote').summernote({
        tabsize: 2,
        height: 250
    });

    function toggle_posts_to_new_post(){
        post_box.hide();
        post_box_new.show();
        btn_new_post.hide();
    }

    function _to_post_list(){
        post_box.show();
        post_box_new.hide();
        btn_new_post.show();
    }
</script>
@endsection
