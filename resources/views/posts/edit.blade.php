@extends('layouts.app')
@section('content')
  <section class="row">
    <div class="col-md-12">
        @include('shared.messages')
        <header><h3>What do you have to change?</h3></header>
        {!! Form::open(['action' => ['PostsController@update',$post->id],'method' => 'put']) !!}
            <div class="form-group">
            {!! Form::textArea('body', $post->body, ['class' => 'form-control','rows'=>'5']) !!}
          </div>
            {!! Form::submit('Edit post',['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}
    </div>
  </section>
@endsection
