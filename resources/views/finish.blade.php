@extends('layouts.app_global')
@section('content')
    <div class="container">

            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="card">
                        <div class="card-body">
                            @if($topic->show_ans==1)

                                <div class="question-block">
                                    <h2 class="text-center main-block-heading">{{$topic->title}} ANSWER REPORT</h2>
                                    <table class="table table-bordered result-table">
                                        <thead>
                                        <tr>
                                            <th>Question</th>

                                            <th style="color: green;">Correct Answer</th>
                                            <th style="color: red;">Your Answer</th>
                                            <th>Answer Explnation</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php
                                            $answers = App\Answer::where('topic_id',$topic->id)->where('user_id',Auth::user()->id)->get();
                                        @endphp

                                        @php
                                            $x = $count_questions;
                                            $y = 1;
                                        @endphp
                                        @foreach($answers as $key=> $a)

                                            @if($a->user_answer != "0" && $topic->id == $a->topic_id)
                                                <tr>
                                                    <td>{{ $a->question->question }}</td>
                                                    <td>{{ $a->answer }}</td>
                                                    <td>{{ $a->user_answer }}</td>
                                                    <td>{{ $a->question->answer_exp }}</td>
                                                </tr>
                                                @php
                                                    $y++;
                                                    if($y > $x){
                                                      break;
                                                    }
                                                @endphp
                                            @endif
                                        @endforeach

                                        </tbody>
                                    </table>

                                </div>

                            @endif



                            <div class="question-block">
                                <h2 class="text-center main-block-heading">{{$topic->title}} Result</h2>
                                <table class="table table-bordered result-table">
                                    <thead>
                                    <tr>
                                        <th>Total Questions</th>
                                        <th>My Marks</th>
                                        <th>Per Question Mark</th>
                                        <th>Total Marks</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>{{$count_questions}}</td>
                                        <td>
                                            @php
                                                $mark = 0;
                                                $correct = collect();
                                            @endphp
                                            @foreach ($answers as $answer)
                                                @if ($answer->answer == $answer->user_answer)
                                                    @php
                                                        $mark++;
                                                    @endphp
                                                @endif
                                            @endforeach
                                            @php
                                                $correct = $mark*$topic->per_q_mark;
                                            @endphp
                                            {{$correct}}
                                        </td>
                                        <td>{{$topic->per_q_mark}}</td>
                                        <td>{{$topic->per_q_mark*$count_questions}}</td>
                                    </tr>
                                    </tbody>
                                </table>
                                <h2 class="text-center">Thank You!</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('old/jquery.cookie.js')}}"></script>
    <script type="text/javascript" language="javascript">
        //all controller is disable
        $(function() {
            var isCtrl = false;
            document.onkeyup=function(e){
                if(e.which == 17) isCtrl=false;
            }

            document.onkeydown=function(e){
                if(e.which == 17) isCtrl=true;
                if(e.which == 85 && isCtrl == true) {
                    return false;
                }
            };
            $(document).keydown(function (event) {
                if (event.keyCode == 123) { // Prevent F12
                    return false;
                }
                else if (event.ctrlKey && event.shiftKey && event.keyCode == 73) { // Prevent Ctrl+Shift+I
                    return false;
                }
            });
        });
        // end all controller is disable
    </script>
@endsection
