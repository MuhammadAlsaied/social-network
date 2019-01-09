@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-9 col-lg-7">
            @include('shared.messages')
            <div class="card">
                <div class="card-header">Feed</div>

                <div class="card-body">
                    <section class="row new-post">
                      <div class="col-md-12">
                          <header><h3>What do you have to say?</h3></header>
                          <form action="{{action('PostsController@store')}}" method="post">
                              <div class="form-group">
                                  <textarea class="form-control" name="body" id="new-post" rows="5" placeholder="Your Post"></textarea>
                              </div>
                              <button type="submit" class="btn btn-primary">Create Post</button>
                              <input type="hidden" value="{{ Session::token() }}" name="_token">
                          </form>
                      </div>
                    </section><hr />
                    @if(count($posts)>0)
                      <section class="row posts">
                          <div class="col-md-12 ">
                              <header><h3>What other people say...</h3></header>
                                  @foreach($posts as $post)
                                    <!--- \\\\\\\Post-->
                                    <div class="card gedf-card">
                                        <div class="card-header">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="ml-2">
                                                        <div class="h5 m-0">{{$post->user->name}}</div>
                                                    </div>
                                                </div>

                                                  <div>
                                                    @if(auth()->user()->id == $post->user->id)
                                                      <div class="dropdown">
                                                          <button class="btn btn-link dropdown-toggle" type="button" id="gedf-drop1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                              <i class="fa fa-ellipsis-h"></i>
                                                          </button>
                                                          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="gedf-drop1">
                                                              {!! Form::open(['action' => ['PostsController@destroy',$post->id],'method' => 'delete']) !!}
                                                                {!! Form::submit('Delete',['class' => 'dropdown-item']) !!}
                                                              {!! Form::close() !!}
                                                              <a class="dropdown-item" href="{{action('PostsController@edit',$post->id)}}">Edit</a>
                                                          </div>
                                                      </div>
                                                    @endif
                                                  </div>
                                            </div>

                                        </div>
                                        <div class="card-body">
                                          <div class="text-muted h7 mb-2"> <i class="fa fa-clock-o"></i> {{Carbon\Carbon::parse($post->created_at)->diffForHumans()}}</div>
                                            <p class="card-text">{{$post->body}}</p>
                                        </div>
                                        <div id="reactions" class="card-footer" data-postid='{{$post->id}}'>
                                          <?php
                                            $like = auth()->user()->likes()->where("post_id",$post->id)->first();
                                            if($like){
                                              $is_like = $like->like;
                                            }
                                          ?>
                                          <a href="#" data-value = "1" class="like-btn card-link"><i  class="fa fa-thumbs-o-up {{$like&&$is_like?'fa-2x':''}}"></i> Like</a>
                                          <a href="#" data-value = "0" class="like-btn card-link"><i class="fa fa-thumbs-o-down {{$like&&!$is_like?'fa-2x':''}}"></i> Dislike</a>
                                        </div>
                                    </div>
                                    <!-- Post /////-->

                                  @endforeach
                              </div>
                        </section>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection
