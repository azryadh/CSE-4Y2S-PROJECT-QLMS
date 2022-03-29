<?php

namespace App\Http\Controllers\Teacher;

use App\Answer;
use App\Http\Controllers\Controller;
use App\Question;
use App\Topic;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(){
        $course_ids = DB::table('courses')->where('users_id', Auth::user()->id)->pluck('id');
        $data['courseCount'] = DB::table('courses')->where('users_id', Auth::user()->id)->count();

        $data['studentCount'] = DB::table('enrolls')
            ->whereIn('courses_id', $course_ids)
            ->count();

        $data['topics'] = DB::table('topics')->where('users_id', Auth::user()->id)->count();
        $data['currentMonthCount'] =  DB::table('enrolls')
            ->whereIn('courses_id', $course_ids)
            ->whereMonth('created_at', Carbon::now()->month)
            ->count();
        $data['lastMonthCount'] =  DB::table('enrolls')
            ->whereIn('courses_id', $course_ids)
            ->whereMonth('created_at', '=',Carbon::now()->month-1)
            ->count();

        $data['topic'] = DB::table('topics')->where('topics.users_id', Auth::user()->id)->get();
        $topics = DB::table('topics')->where('users_id', Auth::user()->id)->pluck('id');
        $data['tests'] = DB::table('answers')->whereIn('answers.topic_id',$topics)
            ->leftJoin('users','users.id','=','answers.user_id')
            ->select('answers.*','users.name')
            ->get();

        return view('teacher.home',$data);
    }

    public function enrolled(){
        $course_ids = DB::table('courses')->where('users_id', Auth::user()->id)->pluck('id');
        $data['enrolled'] =  DB::table('enrolls')
            ->whereIn('enrolls.courses_id', $course_ids)
            ->leftJoin('users','users.id','=','enrolls.users_id')
            ->select('enrolls.*','users.name',DB::raw('users.email as email'))->orderBy('enrolls.id', 'DESC')->get();
//        dump($data);
        return view('teacher.students',$data);
    }

    public function class_work(){
        $course_ids = DB::table('courses')->where('users_id', Auth::user()->id)->pluck('id');
       $data['courses'] = DB::table('courses')->where('users_id', Auth::user()->id)->get();
        if(isset($_GET['btn'])){
            $user = $_GET['student'];
            $csr = $_GET['course'];
            $data['user'] = $user;
            $data['csr'] = $csr;
            if ($csr == 'all'){
               $data['reports'] = DB::table('class_works_ans')->where('class_works_ans.users_id',$user)
                    ->leftJoin('courses','courses.id','=','class_works_ans.courses_id')->select('courses.course_title','class_works_ans.evaluations',DB::raw('class_works_ans.id as id'),'class_works_ans.created_at')
                    ->groupBy('class_works_ans.created_at')
                    ->get();
            }else{
                $data['reports'] = DB::table('class_works_ans')->where('class_works_ans.users_id',$user)->where('class_works_ans.courses_id',$csr)
                    ->leftJoin('courses','courses.id','=','class_works_ans.courses_id')->select('courses.course_title','class_works_ans.evaluations',DB::raw('class_works_ans.id as id'),'class_works_ans.created_at')
                    ->groupBy('class_works_ans.created_at')
                    ->get();
            }
        }else{
            $data['user'] = 'all';
            $data['csr'] = 'all';
            $data['reports'] = null;
        }

        $data['enrolled'] =  DB::table('enrolls')
            ->whereIn('enrolls.courses_id', $course_ids)
            ->leftJoin('users','users.id','=','enrolls.users_id')
            ->select('enrolls.*','users.name',DB::raw('users.id as std'))->groupBy('users.id')->get();

        return view('teacher.reports.class_work',$data);
    }

    public function class_quiz(Request $request){
        $course_ids = DB::table('courses')->where('users_id', Auth::user()->id)->pluck('id');
        $data['topics'] = DB::table('topics')->where('users_id', Auth::user()->id)->get();
        if(isset($_GET['btn'])){
            $user = $_GET['student'];
            $tpc = $_GET['topic'];
            $data['user'] = $user;
            $data['tpc'] = $tpc;
            if ($user == 'all'){
                $topic = Topic::findOrFail($tpc);
                $answers = Answer::where('topic_id', $topic->id)->get();
                $students = User::where('id', '!=', Auth::id())->get();
                $c_que = Question::where('topic_id', $tpc)->count();

                $filtStudents = collect();
                foreach ($students as $student) {
                    foreach ($answers as $answer) {
                        if ($answer->user_id == $student->id) {
                            $filtStudents->push($student);
                        }
                    }
                }

                $filtStudents = $filtStudents->unique();
                $filtStudents = $filtStudents->flatten();
                $data['filtStudents'] = $filtStudents;
                $data['answers'] = $answers;
                $data['c_que'] = $c_que;
                $data['topic'] = $topic;
                $couser_id = DB::table('topics')->where('id',$tpc)->first();
                $data['c_name'] = DB::table('courses')->where('id',$couser_id->course_id)->first();


            }else{
                $data['reports'] = DB::table('answers')->where('answers.user_id',$user)->where('answers.topic_id',$tpc)
                    ->leftJoin('questions','questions.id','=','answers.question_id')->select('questions.question','answers.user_answer',DB::raw('answers.id as id'),'answers.created_at','answers.answer')
                    ->get();
            }

        }else{
            $data['user'] = 'all';
            $data['tpc'] ='all';
            $data['reports'] = null;

        }
        $data['enrolled'] =  DB::table('enrolls')
            ->whereIn('enrolls.courses_id', $course_ids)
            ->leftJoin('users','users.id','=','enrolls.users_id')
            ->select('enrolls.*','users.name',DB::raw('users.id as std'))->groupBy('users.id')->get();
        return view('teacher.reports.quiz',$data);

    }

    public function class_work_print(){
        if(isset($_GET['btn'])){
            $user = $_GET['student'];
            $csr = $_GET['course'];
            if ($csr == 'all'){
                $data['reports'] = DB::table('class_works_ans')->where('class_works_ans.users_id',$user)
                    ->leftJoin('courses','courses.id','=','class_works_ans.courses_id')->select('courses.course_title','class_works_ans.evaluations',DB::raw('class_works_ans.id as id'),'class_works_ans.created_at')
                    ->groupBy('class_works_ans.created_at')
                    ->get();
            }else{
                $data['reports'] = DB::table('class_works_ans')->where('class_works_ans.users_id',$user)->where('class_works_ans.courses_id',$csr)
                    ->leftJoin('courses','courses.id','=','class_works_ans.courses_id')->select('courses.course_title','class_works_ans.evaluations',DB::raw('class_works_ans.id as id'),'class_works_ans.created_at')
                    ->groupBy('class_works_ans.created_at')
                    ->get();
            }
            $data['student'] = DB::table('users')->where('id',$user)->first();
            $data['teacher'] = DB::table('users')->where('id',Auth::user()->id)->first();
        }else{
            $data['reports'] = null;
        }

        return view('teacher.reports.class_print',$data);
    }

    public function class_quiz_print(){
        if(isset($_GET['btn'])){
            $user = $_GET['student'];
            $tpc = $_GET['topic'];
            if ($user == 'all'){
                $topic = Topic::findOrFail($tpc);
                $answers = Answer::where('topic_id', $topic->id)->get();
                $students = User::where('id', '!=', Auth::id())->get();
                $c_que = Question::where('topic_id', $tpc)->count();

                $filtStudents = collect();
                foreach ($students as $student) {
                    foreach ($answers as $answer) {
                        if ($answer->user_id == $student->id) {
                            $filtStudents->push($student);
                        }
                    }
                }

                $filtStudents = $filtStudents->unique();
                $filtStudents = $filtStudents->flatten();
                $data['filtStudents'] = $filtStudents;
                $data['answers'] = $answers;
                $data['c_que'] = $c_que;
                $data['topic'] = $topic;
                $data['teacher'] = DB::table('users')->where('id',Auth::user()->id)
                    ->select(DB::raw('name as t_name'),DB::raw('email as t_email'))
                    ->first();
                $data['user'] = 'all';
                $couser_id = DB::table('topics')->where('id',$tpc)->first();
                $data['c_name'] = DB::table('courses')->where('id',$couser_id->course_id)->first();
            }else{
                $data['reports'] = DB::table('answers')->where('answers.user_id',$user)->where('answers.topic_id',$tpc)
                    ->leftJoin('questions','questions.id','=','answers.question_id')->select('questions.question','answers.user_answer',DB::raw('answers.id as id'),'answers.created_at','answers.answer')
                    ->get();
                $data['student'] = DB::table('users')->where('id',$user)->first();
                $data['teacher'] = DB::table('users')->where('id',Auth::user()->id)->first();
                $data['user'] = $user;
            }

        }else{
            $data['reports'] = null;
        }
        return view('teacher.reports.quiz_print',$data);
    }

    private function getCsrId($uid){



    }
    private function getCsrName($uid){
        $_rec = DB::table('courses')->where('id',$uid)->first();
        return $_rec->course_title;
    }
}
