@extends('layouts.layout')

@section('content')

        <div id="post" class="col-9">
            <div class="card">
                <div class="card-header">
                    <h2>{{ $post->post_name }}</h2>               
                    <div class="card-subtitleInfo">
                        <div class="card-createrInfo">
                            <h6>Категория: {{ $post->category_title }}</h6>
                            <h6>{{ Illuminate\Support\Carbon::create($post->post_created)->diffForHumans() }}</h6>
                            <h6>Автор поста: {{ $post->name }}</h6>
                        </div>
                        <div class="icon-btn">
                            @auth
                                @if(Auth::user()->id == $post->author_id)
                                    <a href="#" class="edit-icon" data-bs-toggle="modal" data-bs-target="#editPost" aria-pressed="false" autocomplete="off"></a>
                                    <form action="{{ route('destroy',['id' => $post->post_id]) }}" method="post" onsubmit="if (confirm('Вы уверены что хотите удалить этот пост?')) {return true} else {return false}">
                                        {{ csrf_field() }}  
                                        {{ method_field('delete') }}
                                        <button type="submit" class="invisible p-0 m-0 bg-transparent"><a class="destroy-icon visible p-0 m-0"></a></button>
                                    </form>
                                @endif
                            @endauth
                        </div>
                        @include('posts.modal-edit')
                    </div>
                </div>
                <div class="card-body">
                    <div class="card-img" id="cardImg" style="background-image: url('{{ $post->img_url ?? asset('image/default.jpg') }}')"></div>
                    <div>{!!$post->content!!}</div>
                </div>
                <div class="card-header">
                    <div class="likesIndex p-0 m-0">
                        <form action="{{route('likeViewCreate',['id' => $post->post_id])}}" method="post">
                            {{ csrf_field() }}
                            <button type="submit" class="d-flex">
                                @auth  
                                    @if(auth()->user()->likedPosts->contains($post->post_id))
                                        <i class="fa-solid fa-heart"></i>
                                        <div class="mx-2 p-0 likesCount">
                                            {{$like->count()}}
                                        </div>
                                    @else
                                        <i class="fa-regular fa-heart"></i>
                                        <div class="mx-2 p-0 likesCount">
                                            {{$like->count()}}
                                        </div>
                                    @endif()
                                @endauth
                                @guest
                                    <i class="fa-regular fa-heart"></i>    
                                    <div class="mx-2 p-0 likesCount">
                                        {{$like->count()}}
                                    </div>
                                @endguest
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @auth
        <form action="{{route('commentCreate',['id' => $post->post_id])}}" method="post">
            {{ csrf_field() }}  
            <div class="comments col-9 m-auto">
                <h4>Добавить комментарий</h4>
                <textarea name="commentText" class="form-control" rows="5" required></textarea>
                <input type="submit" class="btn btn-secondary my-2" value="Отправить">
        </form>
        @endauth
        <h3 class="title-comments">Комментарии ({{$comment->count()}})</h3>
        @foreach($comment as $comm)
            <ul class="media-list">
                <li class="media">
                    <div class="media-body">
                        <div class="panel panel-info">
                            <div class="panel-heading d-flex justify-content-between">
                                <div class="author">{{$comm->name}}</div>
                                <div class="metadata">
                                    <span class="date">{{ Illuminate\Support\Carbon::create($comm->comm_created)->diffForHumans() }}</span>
                                </div>     
                            </div>
                            <div class="panel-body d-flex justify-content-between">
                                <div class="media-text text-justify">{!! $comm->comm_text !!}</div>
                                @auth
                                    @if(Auth::user()->id == $comm->comm_user_id)
                                        <form action="{{ route('commentDestroy',['id' => $comm->comm_id]) }}" method="post" onsubmit="if (confirm('Удалить комментарий?')) {return true} else {return false}">
                                            {{ csrf_field() }}  
                                            {{ method_field('delete') }}
                                            <button type="submit" class="invisible"><a class="destroy-icon visible"></a></button>
                                        </form>
                                    @endif
                                @endauth
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        @endforeach
        </div>

        @include('posts.modal-create2')
@endsection

@push('styles')
<link rel = "stylesheet" href = "{{ asset('plugins/summernote/summernote-bs4.min.css') }}">
@endpush


@push('scripts')
    <script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('plugins/summernote/lang/summernote-ru-RU.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $("#your_summernote").summernote({
                toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link']],
                ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });
            $('.dropdown-toggle').dropdown();
        });
    </script>
    <script>
        $(document).ready(function() {
            $("#summernote").summernote({
                toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link']],
                ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });
            $('.dropdown-toggle').dropdown();
        });
    </script>
@endpush