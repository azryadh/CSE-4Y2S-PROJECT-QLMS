<?php

namespace App\Http\Controllers;

use App\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use Spatie\LaravelImageOptimizer\Facades\ImageOptimizer;

class PostController extends Controller
{
    public function store(Request $request){
        $path_image = 'uploads/posts/img';
        //$path_thumb = 'uploads/posts/thum';
        $c_id = $request->c_id;
        $img = time().'.'.$request->file('img')->getClientOriginalExtension();
        $request->img->move($path_image, $img);
        $data['post'] = $request->post;
        $data['user_id'] = Auth::user()->id;
        $data['course_id'] = $c_id;
        $data['img'] = $img;
        $data['thumb'] = $img;
        $data['slug'] = Str::words($request->post,3,'.....');
        $data['created_at'] = Carbon::now();
        $id = DB::table('posts')->insertGetId($data);
        if (!empty($id)){
            return redirect()->intended(url("classroom/discussion/$c_id"))->with('success', 'Done');
        }else{
            return redirect()->intended(url("classroom/discussion/$c_id"))->with('error', 'Something wrong');
        }

    }

    public function index($id,$cid){
        $data['post'] = Post::find($id);
        $data['cid'] = $cid;

        return view('post.index',$data);
    }
}
