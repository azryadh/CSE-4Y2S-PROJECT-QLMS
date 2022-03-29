@extends('layouts.app_global')
@section('content')
    <div class="row">
        @if ($topics)
            @foreach ($topics as $key => $topic)
                <div class="col-md-4">
                    <div class="card">
                        <h3 class="card-header">{{$topic->title}}</h3>
                        <div class="card-body">
                            <p title="{{$topic->description}}">
                                {{ Str::limit($topic->description, 120, '....')}}
                            </p>
                            <div class="row">
                                <div class="col-xs-6 pad-0">
                                    <ul class="topic-detail">
                                        <li>Per Question Mark <i class="fa fa-long-arrow-right"></i></li>
                                        <li>Total Marks <i class="fa fa-long-arrow-right"></i></li>
                                        <li>Total Questions <i class="fa fa-long-arrow-right"></i></li>
                                        <li>Total Time <i class="fa fa-long-arrow-right"></i></li>
                                    </ul>
                                </div>
                                <div class="col-xs-6">
                                    <ul class="topic-detail right">
                                        <li>{{$topic->per_q_mark}}</li>
                                        <li>
                                            @php
                                                $qu_count = 0;
                                            @endphp
                                            @foreach($questions as $question)
                                                @if($question->topic_id == $topic->id)
                                                    @php
                                                        $qu_count++;
                                                    @endphp
                                                @endif
                                            @endforeach
                                            {{$topic->per_q_mark*$qu_count}}
                                        </li>
                                        <li>
                                            {{$qu_count}}
                                        </li>
                                        <li>
                                            {{$topic->timer}} minutes
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <a href="{{route('teacher.question.show', $topic->id)}}" class="btn btn-outline-success float-lg-right">Add Questions</a>
{{--                            <a data-target="#deleteans{{ $topic->id }}" data-toggle="modal" class="btn btn-outline-danger float-lg-left">Delete Answer Sheet</a>--}}
                        </div>



                    </div>

{{--                    <div id="deleteans{{ $topic->id }}" class="delete-modal modal fade" role="dialog">--}}
{{--                        <!-- Delete Modal -->--}}
{{--                        <div class="modal-dialog modal-sm">--}}
{{--                            <div class="modal-content">--}}
{{--                                <div class="modal-header">--}}
{{--                                    <button type="button" class="close" data-dismiss="modal">&times;</button>--}}
{{--                                    <div class="delete-icon"></div>--}}
{{--                                </div>--}}
{{--                                <div class="modal-body text-center">--}}
{{--                                    <h4 class="modal-heading">Are You Sure ?</h4>--}}
{{--                                    <p>Do you really want to delete these Quiz Answer Sheet? This process cannot be undone.</p>--}}
{{--                                </div>--}}
{{--                                <div class="modal-footer">--}}
{{--                                    {!! Form::open(['method' => 'DELETE', ]) !!}--}}
{{--                                    {!! Form::reset("No", ['class' => 'btn btn-gray', 'data-dismiss' => 'modal']) !!}--}}
{{--                                    {!! Form::submit("Yes", ['class' => 'btn btn-danger']) !!}--}}
{{--                                    {!! Form::close() !!}--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}




                </div>
            @endforeach
        @endif
    </div>
@endsection
