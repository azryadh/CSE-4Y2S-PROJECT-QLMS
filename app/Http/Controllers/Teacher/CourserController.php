<?php

namespace App\Http\Controllers\Teacher;

use App\Helpers\Helper;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CourserController extends Controller
{
    public function index(){
        $data['courses'] = DB::table('courses')
            ->where('users_id',Auth::user()->id)
            ->get();
        $courses = DB::table('courses')->where('users_id',Auth::user()->id)->pluck('id');
        $data['counts'] = DB::table('enrolls')->whereIn('courses_id',$courses)
            ->select('courses_id')
            ->get();
        return view('teacher.course.index',$data);
    }

    public function create(Request $request){
        return view('teacher.course.create');
    }

    public function store(Request $request){
        $data['course_title'] = $request->course_title;
        $data['code'] = $request->code;
        $data['course_code'] = uniqid();;
        $data['users_id'] = $request->users_id;
        $data['created_at'] = Carbon::now();
        DB::table('courses')->insert($data);
        return redirect()->route('teacher.course');
    }

    public function edit(Request $request){
        $id = $request->id;
        $msg['course'] = DB::table('courses')->where('id',$id)->first();
        return response()->json(array('msg'=> $msg), 200);
    }

    public function update(Request $request){
        $data['course_title'] = $request->course_title;
        $data['code'] = $request->code;
        DB::table('courses')->where('id',$request->id)->update($data);
        return redirect()->route('teacher.course');
    }

    public function course_code_chk(Request $request){
        $id = $request->id;
        if(DB::table('courses')->where('code',$id)->exists()){
            $msg['course'] = true;
        }else $msg['course'] = false;

        return response()->json(array('msg'=> $msg), 200);
    }


}
