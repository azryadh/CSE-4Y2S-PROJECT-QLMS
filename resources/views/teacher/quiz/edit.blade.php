@extends('layouts.app_global')
@section('content')
    <div class="row justify-content-center">
        <div class="card">
            <div class="card-body">
                {!! Form::open(['method' => 'POST','action' => 'Teacher\TopicController@update']) !!}
                <input type="hidden" value="{{$topic->id}}" name="topic_id">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                {!! Form::label('title', 'Topic Title') !!}
                                <span class="required">*</span>
                                <input type="text" class="form-control" required placeholder="Please Enter Quiz Title" name="title" value="{{$topic->title}}">
                                <small class="text-danger">{{ $errors->first('title') }}</small>
                            </div>
                            <div class="form-group{{ $errors->has('per_q_mark') ? ' has-error' : '' }}">
                                {!! Form::label('per_q_mark', 'Per Question Mark') !!}
                                <span class="required">*</span>
                                <input type="number" class="form-control" required placeholder="Please Enter Per Question Mark" name="per_q_mark" value="{{$topic->per_q_mark}}">
                                <small class="text-danger">{{ $errors->first('per_q_mark') }}</small>
                            </div>
                            <div class="form-group{{ $errors->has('timer') ? ' has-error' : '' }}">
                                {!! Form::label('timer', 'Quiz Time (in minutes)') !!}
                                <input type="number" class="form-control" required placeholder="Please Enter Quiz Total Time (In Minutes)" name="timer" value="{{$topic->timer}}">
                                <small class="text-danger">{{ $errors->first('timer') }}</small>
                            </div>

                            <div class="form-group">
                                <label for="course_id">Select Course:</label>
                                <select name="course_id" id="course_id" class="form-control">
                                    <option value="">Select Course..</option>
                                    @foreach($courses as $data)
                                        <option value="{{$data->id}}" <?php if ($data->id == $topic->course_id) {echo "selected";} ?>>{{$data->course_title}}</option>
                                    @endforeach

                                </select>
                            </div>


                            <label for="">Enable Show Answer: </label>
                            <input {{ $topic->show_ans ==1 ? "checked" : "" }} type="checkbox" class="toggle-input" name="show_ans" id="toggle{{ $topic->id }}">
                            <label for="toggle{{ $topic->id }}"></label>

                        </div>

                        <div class="col-md-6">
                            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                {!! Form::label('description', 'Description') !!}
                                <textarea class="form-control"  placeholder="Please Enter Quiz Description" name="description">{{$topic->description}}</textarea>
                                <small class="text-danger">{{ $errors->first('description') }}</small>
                            </div>
                        </div>
                    </div>



                    <div class="modal-footer">
                        <div class="btn-group pull-right">
                            {!! Form::submit("Update", ['class' => 'btn btn-wave']) !!}
                            <a type="button" class="btn btn-wave" href="{{route('teacher.quiz')}}">Close</a>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
