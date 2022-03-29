
<ul class="metismenu list-unstyled" id="side-menu">
    <li class="menu-title">Menu</li>
    <?php $user = \Illuminate\Support\Facades\Auth::user() ?>
    @if($user->isTeacher())
        <li>
            <a href="{{route('teacher.home')}}" class="waves-effect">
                <i class="bx bx-home-circle"></i>
                <span>Dashboards</span>
            </a>
        </li>

        <li>
            <a href="javascript: void(0);" class="has-arrow waves-effect">
                <i class="bx bx-user-circle"></i>
                <span>Course Management</span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li><a href="{{route('teacher.course')}}">Course</a></li>
                <li><a href="{{route('teacher.lecture')}}">Lectures</a></li>
                <li><a href="{{route('teacher.quiz')}}">Quiz</a></li>
                <li><a href="{{route('teacher.question')}}">Questions</a></li>
            </ul>
        </li>
        @if(!empty($hasCourse))
            <li class="menu-title">Courses</li>
            @foreach($hasCourse as $data)
                <li>
                    <a href="{{url("/classroom/$data->id")}}" class="waves-effect">
                        <span>{{$data->course_title}}</span>
                    </a>
                </li>
            @endforeach
        @endif
        <li>
            <a href="javascript: void(0);" class="has-arrow waves-effect">
                <i class="bx bx-bar-chart"></i>
                <span>Student Report</span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li><a href="{{route('teacher.report.class_work')}}">Class Works</a></li>
                <li><a href="{{route('teacher.report.class_quiz')}}">Quiz</a></li>
            </ul>
        </li>
    @endif

    @if($user->isStudent())
        <li>
            <a href="{{route('teacher.home')}}" class="waves-effect">
                <i class="bx bx-home-circle"></i>
                <span>Dashboards</span>
            </a>
        </li>
        <li>
            <a href="javascript: void(0);" class="has-arrow waves-effect">
                <i class="bx bxs-report"></i>
                <span>Reports</span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li><a href="{{route('student.report.class_work')}}">Class Works</a></li>
                <li><a href="{{route('student.report.class_quiz')}}">Quiz</a></li>
            </ul>
        </li>
        @if(!empty($hasCourse))
            <li class="menu-title">Courses</li>
            @foreach($hasCourse as $data)
                <li>
                    <a href="{{url("/classroom/$data->id")}}" class="waves-effect">
                        <span>{{$data->course_title}}</span>
                    </a>
                </li>
            @endforeach
        @endif
    @endif

</ul>


