<?php

namespace App\Http\Controllers;

use App\Question;
use App\Topic;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ClassroomController extends Controller
{
    public function index($id){
        $data['hasCourse']= DB::table('courses')
            ->where('users_id',Auth::user()->id)
            ->get();
        $data['course'] = DB::table('courses')->where('id',$id)->first();
        $data['lectures'] = DB::table('lectures')->where('courses_id',$id)->paginate(1);
        $data['tab_active'] = 'lecture_active';
        return view('classroom.index',$data);
    }

    public function class_work($id){
        $data['hasCourse']= DB::table('courses')
            ->where('users_id',Auth::user()->id)
            ->get();
        $data['course'] = DB::table('courses')->where('id',$id)->first();
        $data['class_works'] = DB::table('class_works')->where('class_works.courses_id',$id)
            ->leftJoin('class_works_ans','class_works_ans.class_works_id','=','class_works.id')
            ->select(DB::raw('class_works.id as id'),'class_works.question','class_works.description','class_works.created_at',
            'class_works_ans.evaluations','class_works_ans.flag')
            ->paginate(9);
        $data['class_works_ans_teacher'] = DB::table('class_works_ans')->where('class_works_ans.courses_id',$id)
            ->leftJoin('users','users.id','=','class_works_ans.users_id')
            ->select('users.name','class_works_ans.evaluations',DB::raw('class_works_ans.class_works_id as cls_id'),DB::raw('class_works_ans.id as cl_id'))
            ->get();
        $data['eval'] = DB::table('class_evaluations')->get();
        $data['tab_active'] = 'lecture_classwork';
        return view('classroom.index',$data);
    }
    public function class_work_store(Request $request){
        $data['courses_id'] = $request->course_id;
        $data['question'] = $request->question_title;
        $data['description'] = $request->question;
        $data['created_at'] = Carbon::now();
        DB::table('class_works')->insert($data);
        return redirect()->intended(url("classroom/class_work/$request->course_id"));
    }
    public function discussions($id){
        $data['hasCourse']= DB::table('courses')
            ->where('users_id',Auth::user()->id)
            ->get();
        $data['course'] = DB::table('courses')->where('id',$id)->first();
        $data['discussions'] = DB::table('posts')->where('posts.course_id',$id)
            ->leftJoin('users','users.id','=','posts.user_id')
            ->select('posts.*','users.name')
            ->paginate(9);
        $data['tab_active'] = 'discussion_active';
        return view('classroom.index',$data);
    }

    public function students($id){
        $data['hasCourse']= DB::table('courses')
            ->where('users_id',Auth::user()->id)
            ->get();
        $data['course'] = DB::table('courses')->where('id',$id)->first();
        $data['tab_active'] = 'student_active';
        $data['students'] = DB::table('enrolls')->where('enrolls.courses_id',$id)
            ->leftJoin('users','users.id','=','enrolls.users_id')
            ->select('users.name','users.email',DB::raw('enrolls.id as eid'))->get();
        return view('classroom.index',$data);
    }

    public function quizs($id){
        $data['hasCourse']= DB::table('courses')
            ->where('users_id',Auth::user()->id)
            ->get();
        $data['course'] = DB::table('courses')->where('id',$id)->first();
        $data['tab_active'] = 'quiz_active';
        $data['topics'] = Topic::where('course_id','=',$id)->get();
        $data['questions'] = Question::all();
        return view('classroom.index',$data);
    }

    public function class_works_ans_store(Request $request){
        $data['answers'] = $request->answers;
        $data['users_id'] = Auth::user()->id;
        $data['courses_id'] = $request->courses_id;
        $data['flag'] = 1;
        $data['class_works_id'] = $request->class_works_id;
        $data['created_at'] = Carbon::now();
       $ins_id =  DB::table('class_works_ans')->insertGetId($data);
       if (!empty($ins_id)){
           return redirect()->intended(url("classroom/class_work/$request->courses_id"))->with('success', 'Done');
       }else{
           return redirect()->intended(url("classroom/class_work/$request->courses_id"))->with('error', 'Something wrong');
       }

    }

    public function class_works_ans_view(Request $request){
        $id = $request->id;
        $msg['ans'] = DB::table('class_works_ans')->where('id',$id)->first();
        return response()->json(array('msg'=> $msg), 200);
    }

    public function class_works_evaluations(Request $request){
        $data['evaluations'] = $request->eval_select;
        DB::table('class_works_ans')->where('id',$request->id)->update($data);
        return redirect()->intended(url("classroom/class_work/$request->cid"))->with('success', 'Done');
    }

    private function retrieveCommon(){

    }
}
