<?php

use App\Answer;
use App\Question;
use App\Topic;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});
Route::redirect('/','login');
//Route::get('/home', function () {
//    if (session('status')) {
//        return redirect()->route('admin.home')->with('status', session('status'));
//    }
//
//    return redirect()->route('admin.home');
//});

Route::get('/home', [
    'middleware' => 'auth',
     function () {
         $user = Auth::user();
    if ($user->isAdmin())
        return view('home');
    elseif ($user->isTeacher())
        return redirect()->route('teacher.home');
    elseif ($user->isStudent())
        return redirect()->route('student.home');

}]);

Auth::routes();

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['isAdmin']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');
});

Route::group(['prefix' => 'student', 'as' => 'student.', 'namespace' => 'Student', 'middleware' => ['isStudent']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/report/class_work','HomeController@class_work')->name('report.class_work');
    Route::get('/report/class_work/print','HomeController@class_work_print')->name('report.class_work.print');
    Route::get('/report/class_quiz','HomeController@class_quiz')->name('report.class_quiz');
    Route::get('/report/class_quiz/print','HomeController@class_quiz_print')->name('report.class_quiz.print');
    Route::post('/join', 'HomeController@enroll')->name('join');

});

Route::group(['prefix' => 'teacher', 'as' => 'teacher.', 'namespace' => 'Teacher', 'middleware' => ['isTeacher']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/enrolled', 'HomeController@enrolled')->name('enrolled');
    Route::get('/course', 'CourserController@index')->name('course');
    Route::post('/course/store', 'CourserController@store')->name('course.store');
    Route::get('/course/edit', 'CourserController@edit')->name('course.edit');
    Route::get('/course/code/check', 'CourserController@course_code_chk')->name('course.code_check');
    Route::post('/course/update', 'CourserController@update')->name('course.update');
    //lecture
    Route::get('/lecture','LectureController@index')->name('lecture');
    Route::get('/lecture/create','LectureController@create')->name('lecture.create');
    Route::post('/lecture/store','LectureController@store')->name('lecture.store');
    Route::get('/lecture/view/{id}','LectureController@view')->name('lecture.view');
    Route::post('/lecture/update','LectureController@update')->name('lecture.update');
    //quiz
    Route::get('/quiz','TopicController@index')->name('quiz');
    Route::post('/quiz/store','TopicController@store')->name('quiz.store');
    Route::get('/quiz/edit/{id}','TopicController@edit')->name('quiz.edit');
    Route::post('/quiz/update','TopicController@update')->name('quiz.update');
    Route::delete('/quiz/delete{id}','TopicController@destroy')->name('quiz.destroy');
    Route::get('/questions','QuestionsController@index')->name('question');
    Route::get('/questions/show{id}','QuestionsController@show')->name('question.show');
    Route::delete('/questions/destroy{id}','QuestionsController@destroy')->name('question.destroy');
    Route::post('/questions/update{id}','QuestionsController@update')->name('question.update');
    Route::post('/questions/importExcelToDB','QuestionsController@importExcelToDB')->name('question.importExcelToDB');
    Route::post('/questions/store','QuestionsController@store')->name('question.store');
    Route::get('/report/class_work','HomeController@class_work')->name('report.class_work');
    Route::get('/report/class_work/print','HomeController@class_work_print')->name('report.class_work.print');
    Route::get('/report/class_quiz','HomeController@class_quiz')->name('report.class_quiz');
    Route::get('/report/class_quiz/print','HomeController@class_quiz_print')->name('report.class_quiz.print');

});

Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
// Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});

Route::group(['middleware' => ['auth','optimizeImages']], function () {
    Route::get('/classroom/{id}','ClassroomController@index');
    Route::get('/classroom/class_work/{id}','ClassroomController@class_work')->name('class.work');
    Route::get('/classroom/discussion/{id}','ClassroomController@discussions')->name('class.discussions');
    Route::get('/classroom/student/{id}','ClassroomController@students')->name('class.students');
    Route::get('/classroom/quiz/{id}','ClassroomController@quizs')->name('class.quiz');
    Route::post('/classroom/class_work/store','ClassroomController@class_work_store')->name('class.work.store');
    Route::post('/classroom/class_work/store/student','ClassroomController@class_works_ans_store')->name('class.work.store.student');
    Route::get('/classroom/class_work/ans/get','ClassroomController@class_works_ans_view')->name('class.work.ans.teacher');
    Route::post('/classroom/class_work/ans/store','ClassroomController@class_works_evaluations')->name('class.work.ans.teacher.eval');
    //Posts & Comments
    Route::post('/classroom/posts','PostController@store')->name('class.posts.store');
    Route::get('/classroom/posts/details/{id}/{cid}','PostController@index')->name('class.posts.index');
    Route::post('/classroom/comment/store', 'CommentController@store')->name('comment.add');
    Route::post('/classroom/reply/store', 'CommentController@replyStore')->name('reply.add');

    Route::get('start_quiz/{id}', function($id){
        $topic = Topic::findOrFail($id);
        $answers = Answer::where('topic_id','=',$topic->topic_id)->first();
        return view('main_quiz', compact('topic','answers'));
    })->name('start_quiz');
    Route::resource('start_quiz/{id}/quiz', 'MainQuizController');

    Route::get('start_quiz/{id}/finish', function($id){
        $auth = Auth::user();
        $topic = Topic::findOrFail($id);
        $questions = Question::where('topic_id', $id)->get();
        $count_questions = $questions->count();
        $answers = Answer::where('user_id',$auth->id)
            ->where('topic_id',$id)->get();

        if($count_questions != $answers->count()){
            foreach($questions as $que){
                $a = false;
                foreach($answers as $ans){
                    if($que->id == $ans->question_id){
                        $a = true;
                    }
                }
                if($a == false){
                    Answer::create([
                        'topic_id' => $id,
                        'user_id' => $auth->id,
                        'question_id' => $que->id,
                        'user_answer' => 0,
                        'answer' => $que->answer,
                    ]);
                }
            }
        }

        $ans= Answer::all();
        $q= Question::all();

        return view('finish', compact('ans','q','topic', 'answers', 'count_questions'));
    });
});

