<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(){
        $data['courses'] = DB::table('enrolls')
            ->where('enrolls.users_id',Auth::user()->id)
            ->leftJoin('courses','courses.id','=','enrolls.courses_id')
            ->select('courses.course_title',DB::raw('courses.id as c_id'))
            ->get();
        return view('student.home',$data);
    }

    public function enroll(Request $request){
        if ($this->course_check($request->code)){
            $data['courses_id'] = $this->get_course_id($request->code);
            $data['users_id'] =  Auth::user()->id;
            $data['created_at'] =  Carbon::now();
            if ($this->enroll_check($this->get_course_id($request->code),Auth::user()->id)){
                $ins_id = DB::table('enrolls')->insertGetId($data);
                if (!empty($ins_id)){
                    return redirect()->back()->with('success', 'Done');
                }
            }else{
                return redirect()->back()->with('error', 'Code Invalid!');
            }


        }

        else
            return redirect()->back()->with('error', 'check code again!');
    }

    private function course_check($code){
        if (DB::table('courses')->where('course_code',$code)->exists()){
            return true;
        }else
            return false;
    }

    private function enroll_check($id, $user){
        if (DB::table('enrolls')->where('courses_id',$id)->where('users_id',$user)->exists()){
            return false;
        }else
            return true;
    }

    private function get_course_id($code){
        $c_id = DB::table('courses')->where('course_code',$code)->select('id')->first();
        return $c_id->id;
    }

    public function class_work(){
        $course_ids = DB::table('enrolls')->where('users_id', Auth::user()->id)->pluck('courses_id');
        $data['courses'] = DB::table('courses')->whereIn('id', $course_ids)->get();
        if(isset($_GET['btn'])){
            $csr = $_GET['course'];
            $data['csr'] = $csr;
            $data['reports'] = DB::table('class_works_ans')->where('class_works_ans.users_id',Auth::user()->id)->where('class_works_ans.courses_id',$csr)
                ->leftJoin('courses','courses.id','=','class_works_ans.courses_id')->select('courses.course_title','class_works_ans.evaluations',DB::raw('class_works_ans.id as id'),'class_works_ans.created_at')
                ->groupBy('class_works_ans.created_at')
                ->get();
        }else{
            $data['csr'] = 'all';
            $data['reports'] = null;
        }


        return view('student.reports.class_work',$data);
    }

    public function class_work_print(){
        if(isset($_GET['btn'])){
            $csr = $_GET['course'];

            $data['reports'] = DB::table('class_works_ans')->where('class_works_ans.users_id',Auth::user()->id)->where('class_works_ans.courses_id',$csr)
                ->leftJoin('courses','courses.id','=','class_works_ans.courses_id')->select('courses.course_title','class_works_ans.evaluations',DB::raw('class_works_ans.id as id'),'class_works_ans.created_at')
                ->groupBy('class_works_ans.created_at')
                ->get();
            $data['student'] = DB::table('users')->where('id',Auth::user()->id)->first();
        }else{
            $data['reports'] = null;
        }

        return view('student.reports.class_print',$data);
    }

    public function class_quiz(Request $request){
        $course_ids = DB::table('enrolls')->where('users_id', Auth::user()->id)->pluck('courses_id');
        $data['topics'] = DB::table('topics')->whereIn('course_id', $course_ids)->get();
        if(isset($_GET['btn'])){
            $tpc = $_GET['topic'];
            $data['tpc'] = $tpc;
            $data['reports'] = DB::table('answers')->where('answers.user_id',Auth::user()->id)->where('answers.topic_id',$tpc)
                ->leftJoin('questions','questions.id','=','answers.question_id')->select('questions.question','answers.user_answer',DB::raw('answers.id as id'),'answers.created_at','answers.answer')
                ->get();
        }else{
            $data['tpc'] ='all';
            $data['reports'] = null;

        }


        return view('student.reports.quiz',$data);

    }

    public function class_quiz_print(){
        if(isset($_GET['btn'])){
            $tpc = $_GET['topic'];
            $data['reports'] = DB::table('answers')->where('answers.user_id',Auth::user()->id)->where('answers.topic_id',$tpc)
                ->leftJoin('questions','questions.id','=','answers.question_id')->select('questions.question','answers.user_answer',DB::raw('answers.id as id'),'answers.created_at','answers.answer')
                ->get();
            $data['student'] = DB::table('users')->where('id',Auth::user()->id)->first();
            $data['title_q'] = DB::table('topics')->where('id', $tpc)->first();
        }else{
            $data['reports'] = null;
        }
        return view('student.reports.quiz_print',$data);
    }
}
