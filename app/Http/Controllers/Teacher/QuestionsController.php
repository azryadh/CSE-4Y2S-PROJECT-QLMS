<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Question;
use App\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionsController extends Controller
{
    public function index(){
        $topics = Topic::where('users_id',Auth::user()->id)->get();
        $questions = Question::all();

        return view('teacher.question.index',compact('questions', 'topics'));
    }

    public function store(Request $request){
        $path_image = 'uploads/posts/img';
        $request->validate([
            'topic_id' => 'required',
            'question' => 'required',
            'a' => 'required',
            'b' => 'required',
            'c' => 'required',
            'd' => 'required',
            'answer' => 'required',
            'question_img' => 'image'
        ]);
        $input = $request->all();

        if ($file = $request->file('question_img')) {

            $name = 'question_'.time().$file->getClientOriginalName();
            $file->move($path_image, $name);
            $input['question_img'] = $name;

        }

        Question::create($input);
        return back()->with('added', 'Question has been added');
    }
    public function show($id){
        $topic = Topic::findOrFail($id);
        $questions = Question::where('topic_id', $topic->id)->get();
        return view('teacher.question.show',compact('topic', 'questions'));
    }

    public function destroy($id){

    }

    public function update(Request $request, $id){
        $path_image = 'uploads/posts/img';
        $question = Question::findOrFail($id);
        $request->validate([
            'topic_id' => 'required',
            'question' => 'required',
            'a' => 'required',
            'b' => 'required',
            'c' => 'required',
            'd' => 'required',
            'answer' => 'required',
        ]);

        $input = $request->all();

        if ($file = $request->file('question_img')) {

            $name = 'question_'.time().$file->getClientOriginalName();

            if($question->question_img != null) {
                unlink(public_path().$path_image.$question->question_img);
            }

            $file->move($path_image, $name);
            $input['question_img'] = $name;

        }

        $question->update($input);
        return back()->with('updated', 'Question has been updated');
    }

    public function importExcelToDB(){

    }
}
