<?php

namespace App\Http\Controllers\Teacher;
use App\Http\Controllers\Controller;
use App\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TopicController extends Controller
{
    public function index(){
        $data['courses'] = DB::table('courses')->where('users_id',Auth::user()->id)->get();
        $data['topics'] = DB::table('topics')->where('topics.users_id',Auth::user()->id)
            ->leftJoin('courses','courses.id','=','topics.course_id')
            ->select('topics.*','courses.course_title')->get();
        return view('teacher.quiz.index',$data);
    }
    public function store(Request $request){
        $input['title'] = $request->title;
        $input['per_q_mark'] = $request->per_q_mark;
        $input['timer'] = $request->timer;
        $input['course_id'] = $request->course_id;
        $input['users_id'] = Auth::user()->id;
        $input['description'] = $request->description;
        if(isset($request->show_ans)){
            $input['show_ans'] = "1";
        }else{
            $input['show_ans'] = "0";
        }


        $id = DB::table('topics')->insertGetId($input);
        if (!empty($id)){
            return back()->with('added', 'Quiz has been added');
        }else{
            return back()->with('error', 'Error');
        }

    }
    public function edit($id){
        $data['topic'] = Topic::find($id);
        $data['courses'] = DB::table('courses')->where('users_id',Auth::user()->id)->get();
        return view('teacher.quiz.edit',$data);
    }
    public function update(Request $request){
        $id = $request->topic_id;
        $input['title'] = $request->title;
        $input['per_q_mark'] = $request->per_q_mark;
        $input['timer'] = $request->timer;
        $input['course_id'] = $request->course_id;
        $input['description'] = $request->description;
        if(isset($request->show_ans)){
            $input['show_ans'] = "1";
        }else{
            $input['show_ans'] = "0";
        }

        DB::table('topics')->where('id',$id)->update($input);
        return back()->with('added', 'Quiz has been edited');
    }

    public function destroy($id){

    }
}
