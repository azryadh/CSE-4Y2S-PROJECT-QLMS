<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LectureController extends Controller
{
    public function index(){
        $data['lectures'] = DB::table('lectures')
            ->leftJoin('courses','courses.id','=','lectures.courses_id')
            ->where('courses.users_id',Auth::user()->id)
            ->select('courses.course_title','courses.course_code',DB::raw('courses.id as courses_id'),DB::raw('COUNT(lectures.id) as lecture_count'))
            ->groupBy('courses.id')
            ->get();

        return view('teacher.lecture.index',$data);
    }

    public function create(){
        $data['courses'] = DB::table('courses')->where('users_id',Auth::user()->id)
            ->select('course_title','id')
            ->get();
        return view('teacher.lecture.create',$data);
    }

    public function store(Request $request){
        $data['courses_id'] = $request->course_id;
        $data['heading'] = $request->heading;
        $data['description'] = $request->description;
        $data['created_at'] = Carbon::now();
        DB::table('lectures')->insert($data);
        return redirect()->route('teacher.lecture');
    }
    public function view($id){
        $data['lectures'] = DB::table('lectures')
            ->leftJoin('courses','courses.id','=','lectures.courses_id')
            ->where('courses.id',$id)
            ->select('courses.course_title','lectures.description',DB::raw('courses.id as courses_id'),DB::raw('lectures.id as lectures_id'),'lectures.heading')
            ->get();
        return view('teacher.lecture.show',$data);
    }

    public function update(Request $request){
        $data['heading'] = $request->heading;
        $data['description'] = $request->description;
        DB::table('lectures')->where('id',$request->lectures_id)->update($data);
        return redirect()->intended(url("teacher/lecture/view/$request->courses_id"));


    }
}
