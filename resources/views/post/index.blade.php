@extends('layouts.app_global')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <a href="{{url("/classroom/discussion/$cid")}}" class="btn btn-outline-danger float-lg-right">X</a>
                    </div>
                    <img src="{{asset("uploads/posts/img/$post->img")}}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <p>{{ $post->post }}</p>
                    </div>

                    <div class="card-body">
                        <h5> Comments</h5>

                        @include('includes.partials.replys', ['comments' => $post->comments, 'post_id' => $post->id])

                        <hr />
                    </div>

                    <div class="card-body">
                        <h5>Leave a comment</h5>
                        <form method="post" action="{{ route('comment.add') }}">
                            @csrf
                            <div class="form-group">
                                <input type="text" name="comment" class="form-control" />
                                <input type="hidden" name="post_id" value="{{ $post->id }}" />
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-sm btn-outline-danger py-0" style="font-size: 0.8em;" value="Add Comment" />
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
