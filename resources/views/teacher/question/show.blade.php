@extends('layouts.app_global')
@section('content')
    <div class="card-header">
        <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#createModal">Add Question</button>
        <button type="button" class="btn btn-outline-pink" data-toggle="modal" data-target="#importQuestions">Import Questions</button>
    </div>
    <!-- Create Modal -->
    <div id="createModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Question</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {!! Form::open(['method' => 'POST', 'action' => 'Teacher\QuestionsController@store', 'files' => true]) !!}
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            {!! Form::hidden('topic_id', $topic->id) !!}
                            <div class="form-group{{ $errors->has('question') ? ' has-error' : '' }}">
                                {!! Form::label('question', 'Question') !!}
                                <span class="required">*</span>
                                {!! Form::textarea('question', null, ['class' => 'form-control', 'placeholder' => 'Please Enter Question', 'rows'=>'8', 'required' => 'required']) !!}
                                <small class="text-danger">{{ $errors->first('question') }}</small>
                            </div>
                            <div class="form-group{{ $errors->has('answer') ? ' has-error' : '' }}">
                                {!! Form::label('answer', 'Correct Answer') !!}
                                <span class="required">*</span>
                                {!! Form::select('answer', array('A'=>'A', 'B'=>'B', 'C'=>'C', 'D'=>'D'),null, ['class' => 'form-control select2', 'required' => 'required', 'placeholder'=>'']) !!}
                                <small class="text-danger">{{ $errors->first('answer') }}</small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group{{ $errors->has('a') ? ' has-error' : '' }}">
                                {!! Form::label('a', 'A - Option') !!}
                                <span class="required">*</span>
                                {!! Form::text('a', null, ['class' => 'form-control', 'placeholder' => 'Please Enter A Option', 'required' => 'required']) !!}
                                <small class="text-danger">{{ $errors->first('a') }}</small>
                            </div>
                            <div class="form-group{{ $errors->has('b') ? ' has-error' : '' }}">
                                {!! Form::label('b', 'B - Option') !!}
                                <span class="required">*</span>
                                {!! Form::text('b', null, ['class' => 'form-control', 'placeholder' => 'Please Enter B Option', 'required' => 'required']) !!}
                                <small class="text-danger">{{ $errors->first('b') }}</small>
                            </div>
                            <div class="form-group{{ $errors->has('c') ? ' has-error' : '' }}">
                                {!! Form::label('c', 'C - Option') !!}
                                <span class="required">*</span>
                                {!! Form::text('c', null, ['class' => 'form-control', 'placeholder' => 'Please Enter C Option', 'required' => 'required']) !!}
                                <small class="text-danger">{{ $errors->first('c') }}</small>
                            </div>
                            <div class="form-group{{ $errors->has('d') ? ' has-error' : '' }}">
                                {!! Form::label('d', 'D - Option') !!}
                                <span class="required">*</span>
                                {!! Form::text('d', null, ['class' => 'form-control', 'placeholder' => 'Please Enter D Option', 'required' => 'required']) !!}
                                <small class="text-danger">{{ $errors->first('d') }}</small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group{{ $errors->has('code_snippet') ? ' has-error' : '' }}">
                                {!! Form::label('code_snippet', 'Code Snippets') !!}
                                {!! Form::textarea('code_snippet', null, ['class' => 'form-control', 'placeholder' => 'Please Enter Code Snippets', 'rows' => '5']) !!}
                                <small class="text-danger">{{ $errors->first('code_snippet') }}</small>
                            </div>
                            <div class="form-group{{ $errors->has('answer_ex') ? ' has-error' : '' }}">
                                {!! Form::label('answer_exp', 'Answer Explanation') !!}
                                {!! Form::textarea('answer_exp', null, ['class' => 'form-control', 'placeholder' => 'Please Enter Answer Explanation', 'rows' => '4']) !!}
                                <small class="text-danger">{{ $errors->first('answer_ex') }}</small>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="extras-block">
                                <h4 class="extras-heading">Video And Image For Question</h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group{{ $errors->has('question_video_link') ? ' has-error' : '' }}">
                                            {!! Form::label('question_video_link', 'Add Video To Question') !!}
                                            {!! Form::text('question_video_link', null, ['class' => 'form-control', 'placeholder'=>'https://myvideolink.com/embed/..']) !!}
                                            <small class="text-danger">{{ $errors->first('question_video_link') }}</small>
                                            <p class="help">YouTube And Vimeo Video Support (Only Embed Code Link)</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group{{ $errors->has('question_img') ? ' has-error' : '' }}">
                                            {!! Form::label('question_img', 'Add Image To Question') !!}
                                            {!! Form::file('question_img') !!}
                                            <small class="text-danger">{{ $errors->first('question_img') }}</small>
                                            <p class="help">Please Choose Only .JPG, .JPEG and .PNG</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="btn-group pull-right">
                        {!! Form::reset("Reset", ['class' => 'btn btn-outline-info']) !!}
                        {!! Form::submit("Add", ['class' => 'btn btn-outline-success']) !!}
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <!-- Import Questions Modal -->
    <div id="importQuestions" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Import Questions (Excel File With Exact Header of DataBase Field)</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {!! Form::open(['method' => 'POST', 'action' => 'Teacher\QuestionsController@importExcelToDB', 'files' => true]) !!}
                <div class="modal-body">
                    {!! Form::hidden('topic_id', $topic->id) !!}
                    <div class="form-group{{ $errors->has('question_file') ? ' has-error' : '' }}">
                        {!! Form::label('question_file', 'Import Question Via Excel File', ['class' => 'col-sm-3 control-label']) !!}
                        <span class="required">*</span>
                        <div class="col-sm-9">
                            {!! Form::file('question_file', ['required' => 'required']) !!}
                            <p class="help-block">Only Excel File (.CSV and .XLS)</p>
                            <small class="text-danger">{{ $errors->first('question_file') }}</small>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="btn-group pull-right">
                        {!! Form::reset("Reset", ['class' => 'btn btn-outline-info']) !!}
                        {!! Form::submit("Import", ['class' => 'btn btn-outline-success']) !!}
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="questions_table" class="table table-hover table-striped">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Questions</th>
                        <th>A - Option</th>
                        <th>B - Option</th>
                        <th>C - Option</th>
                        <th>D - Option</th>
                        <th>Correct Answer</th>
                        <th>Code Snippet</th>
                        <th>Answer Explanation</th>
                        <th>Image</th>
                        <th>Video Link</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if ($questions)
                        @foreach ($questions as $key => $question)
                            @php
                                $answer = strtolower($question->answer);
                            @endphp
                            <tr>
                                <td>
                                    {{$key+1}}
                                </td>
                                <td>{{$question->question}}</td>
                                <td>{{$question->a}}</td>
                                <td>{{$question->b}}</td>
                                <td>{{$question->c}}</td>
                                <td>{{$question->d}}</td>
                                <td>{{$question->$answer}}</td>
                                <td>
                  <pre>
                    {{{$question->code_snippet}}}
                  </pre>
                                </td>
                                <td>
                                    {{$question->answer_exp}}
                                </td>
                                <td>
                                    <img src="{{asset('/images/questions/'.$question->question_img)}}" class="img-responsive" alt="image">
                                </td>
                                <td>
                                    {{$question->question_video_link}}
                                </td>
                                <td>

                                    <div class="btn-group ">
                                        <button type="button" class="btn btn-outline-primary dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Action <span class="caret"></span>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                            <a type="button" class="dropdown-item cursor-pointer" data-toggle="modal" data-target="#EditModal_{{$question->id}}"><i class="fa fa-edit"></i> Edit</a>
                                            <a type="button" class="dropdown-item cursor-pointer" data-toggle="modal" data-target="#deleteModal_{{$question->id}}"><i class="fa fa-close"></i> Delete</a>
                                        </div>
                                    </div>
                                    <div id="deleteModal_{{$question->id}}" class="modal fade" role="dialog">
                                        <!-- Delete Modal -->
                                        <div class="modal-dialog modal-sm">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <div class="delete-icon"></div>
                                                </div>
                                                <div class="modal-body text-center">
                                                    <h4 class="modal-heading">Are You Sure ?</h4>
                                                    <p>Do you really want to delete these records? This process cannot be undone.</p>
                                                </div>
                                                <div class="modal-footer">
                                                    {!! Form::open(['method' => 'DELETE', 'action' => ['Teacher\QuestionsController@destroy', $question->id]]) !!}
                                                    {!! Form::reset("No", ['class' => 'btn btn-gray', 'data-dismiss' => 'modal']) !!}
                                                    {!! Form::submit("Yes", ['class' => 'btn btn-danger']) !!}
                                                    {!! Form::close() !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <!-- edit model -->
                            <div id="EditModal_{{$question->id}}" class="modal fade" role="dialog">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Question</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        {!! Form::model($question, ['method' => 'POST', 'action' => ['Teacher\QuestionsController@update', $question->id], 'files' => true]) !!}
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    {!! Form::hidden('topic_id', $topic->id) !!}
                                                    <div class="form-group{{ $errors->has('question') ? ' has-error' : '' }}">
                                                        {!! Form::label('question', 'Question') !!}
                                                        <span class="required">*</span>
                                                        {!! Form::textarea('question', null, ['class' => 'form-control', 'placeholder' => 'Please Enter Question', 'rows'=>'8', 'required' => 'required']) !!}
                                                        <small class="text-danger">{{ $errors->first('question') }}</small>
                                                    </div>
                                                    <div class="form-group{{ $errors->has('answer') ? ' has-error' : '' }}">
                                                        {!! Form::label('answer', 'Correct Answer') !!}
                                                        <span class="required">*</span>
                                                        {!! Form::select('answer', array('A'=>'A', 'B'=>'B', 'C'=>'C', 'D'=>'D'),null, ['class' => 'form-control select2', 'required' => 'required', 'placeholder'=>'']) !!}
                                                        <small class="text-danger">{{ $errors->first('answer') }}</small>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group{{ $errors->has('a') ? ' has-error' : '' }}">
                                                        {!! Form::label('a', 'A - Option') !!}
                                                        <span class="required">*</span>
                                                        {!! Form::text('a', null, ['class' => 'form-control', 'placeholder' => 'Please Enter A Option', 'required' => 'required']) !!}
                                                        <small class="text-danger">{{ $errors->first('a') }}</small>
                                                    </div>
                                                    <div class="form-group{{ $errors->has('b') ? ' has-error' : '' }}">
                                                        {!! Form::label('b', 'B - Option') !!}
                                                        <span class="required">*</span>
                                                        {!! Form::text('b', null, ['class' => 'form-control', 'placeholder' => 'Please Enter B Option', 'required' => 'required']) !!}
                                                        <small class="text-danger">{{ $errors->first('b') }}</small>
                                                    </div>
                                                    <div class="form-group{{ $errors->has('c') ? ' has-error' : '' }}">
                                                        {!! Form::label('c', 'C - Option') !!}
                                                        <span class="required">*</span>
                                                        {!! Form::text('c', null, ['class' => 'form-control', 'placeholder' => 'Please Enter C Option', 'required' => 'required']) !!}
                                                        <small class="text-danger">{{ $errors->first('c') }}</small>
                                                    </div>
                                                    <div class="form-group{{ $errors->has('d') ? ' has-error' : '' }}">
                                                        {!! Form::label('d', 'D - Option') !!}
                                                        <span class="required">*</span>
                                                        {!! Form::text('d', null, ['class' => 'form-control', 'placeholder' => 'Please Enter D Option', 'required' => 'required']) !!}
                                                        <small class="text-danger">{{ $errors->first('d') }}</small>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group{{ $errors->has('code_snippet') ? ' has-error' : '' }}">
                                                        {!! Form::label('code_snippet', 'Code Snippets') !!}
                                                        {!! Form::textarea('code_snippet', null, ['class' => 'form-control', 'placeholder' => 'Please Enter Code Snippets', 'rows' => '5']) !!}
                                                        <small class="text-danger">{{ $errors->first('code_snippet') }}</small>
                                                    </div>
                                                    <div class="form-group{{ $errors->has('answer_ex') ? ' has-error' : '' }}">
                                                        {!! Form::label('answer_exp', 'Answer Explanation') !!}
                                                        {!! Form::textarea('answer_exp', null, ['class' => 'form-control',  'placeholder' => 'Please Enter Answer Explanation',  'rows' => '4']) !!}
                                                        <small class="text-danger">{{ $errors->first('answer_ex') }}</small>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="extras-block">
                                                        <h4 class="extras-heading">Images And Video For Question</h4>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group{{ $errors->has('question_video_link') ? ' has-error' : '' }}">
                                                                    {!! Form::label('question_video_link', 'Add Video To Question') !!}
                                                                    {!! Form::text('question_video_link', null, ['class' => 'form-control', 'placeholder'=>'https://myvideolink.com/embed/..']) !!}
                                                                    <small class="text-danger">{{ $errors->first('question_video_link') }}</small>
                                                                    <p class="help">YouTube And Vimeo Video Support (Only Embed Code Link)</p>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group{{ $errors->has('question_img') ? ' has-error' : '' }}">
                                                                    {!! Form::label('question_img', 'Add Image In Question') !!}
                                                                    {!! Form::file('question_img') !!}
                                                                    <small class="text-danger">{{ $errors->first('question_img') }}</small>
                                                                    <p class="help">Please Choose Only .JPG, .JPEG and .PNG</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <div class="btn-group pull-right">
                                                {!! Form::submit("Update", ['class' => 'btn btn-outline-success']) !!}
                                            </div>
                                        </div>
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection
