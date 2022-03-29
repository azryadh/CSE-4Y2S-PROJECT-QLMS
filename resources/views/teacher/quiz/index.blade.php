@extends('layouts.app_global')
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="btn-group-fab" role="group" aria-label="FAB Menu">
                <div>
                    <button type="button" class="btn btn-main btn-primary has-tooltip" data-placement="left" title="New" data-toggle="modal" data-target="#createModal"> <i class="fa fa-plus"></i> </button>
                </div>
            </div>
            <table class="table dataTable">
                <thead>
                <th>Course</th>
                <th>Quiz-Name</th>
                <th>Per Question Mark</th>
                <th>Time</th>
                <th>Action</th>
                </thead>
                <tbody>
                @foreach($topics as $data)
                    <tr>
                        <td>{{$data->course_title}}</td>
                        <td>{{$data->title}}</td>
                        <td>{{$data->per_q_mark}}</td>
                        <td>{{$data->timer}} mins</td>
                        <td>
                            <!-- Edit Button -->
                            <a  class="btn btn-outline-primary btn-xs" href="{{url("/teacher/quiz/edit/$data->id")}}"><i class="fa fa-edit"></i> Edit</a>
                            <!-- Delete Button -->
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Create Modal -->
    <div id="createModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Quiz</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                </div>
                {!! Form::open(['method' => 'POST','action' => 'Teacher\TopicController@store']) !!}
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                {!! Form::label('title', 'Quiz Title') !!}
                                <span class="required">*</span>
                                {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Please Enter Quiz Title', 'required' => 'required']) !!}
                                <small class="text-danger">{{ $errors->first('title') }}</small>
                            </div>
                            <div class="form-group{{ $errors->has('per_q_mark') ? ' has-error' : '' }}">
                                {!! Form::label('per_q_mark', 'Per Question Mark') !!}
                                <span class="required">*</span>
                                {!! Form::number('per_q_mark', null, ['class' => 'form-control', 'placeholder' => 'Please Enter Per Question Mark', 'required' => 'required']) !!}
                                <small class="text-danger">{{ $errors->first('per_q_mark') }}</small>
                            </div>
                            <div class="form-group{{ $errors->has('timer') ? ' has-error' : '' }}">
                                {!! Form::label('timer', 'Quiz Time (in minutes)') !!}
                                {!! Form::number('timer', null, ['class' => 'form-control', 'placeholder' => 'Please Enter Quiz Total Time (In Minutes)']) !!}
                                <small class="text-danger">{{ $errors->first('timer') }}</small>
                            </div>
                            <div class="form-group">
                                <label for="course_id">Select Course:</label>
                                <select name="course_id" id="course_id" class="form-control">
                                    <option value="">Select Course..</option>
                                    @foreach($courses as $data)
                                        <option value="{{$data->id}}">{{$data->course_title}}</option>
                                    @endforeach

                                </select>
                            </div>


                            <div class="form-group {{ $errors->has('show_ans') ? ' has-error' : '' }}">
                                <label for="">Enable Show Answer: </label>
                                <input type="checkbox" class="toggle-input" name="show_ans" id="toggle2">
                                <label for="toggle2"></label>
                                <br>
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                {!! Form::label('description', 'Description') !!}
                                {!! Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'Please Enter Quiz Description', 'rows' => '8']) !!}
                                <small class="text-danger">{{ $errors->first('description') }}</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="btn-group pull-right">
                        {!! Form::reset("Reset", ['class' => 'btn btn-default']) !!}
                        {!! Form::submit("Add", ['class' => 'btn btn-wave']) !!}
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
