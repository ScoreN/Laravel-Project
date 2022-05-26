@extends('layouts.layout')

@section('content')

        @if(isset($_GET['search'])) 
            @if(count($posts)>0)
                <h5 class="my-2">По запросу "<?=htmlspecialchars($_GET['search'])?>" найдено постов: {{ count($posts) }}.</h5>
            @else        
                <h5 class="my-2">По запросу "<?=htmlspecialchars($_GET['search'])?>" ничего не найдено.</h5>
                <a href="/" class="btn btn-dark my-2 px-4 my-sm-0" data-toggle="button" aria-pressed="false" autocomplete="off">На главную</a>
            @endif
        @endif

        <form action="{{route('search')}}" method="get" class="category-selector offset-4">
            <h5>Сортировка по категориям</h5>
            <select class="categ-select" name="categoryAdd" aria-label="Disabled select example" required>
                <option value=""></option>
                @foreach($categories as $cat)
                    <option value="{{$cat->category_title}}" @if(isset($_GET['categoryAdd'])) @if($_GET['categoryAdd'] == $cat->category_title) selected @endif @endif>
                        {{$cat->category_title}}
                    </option>
                @endforeach
            </select>
            <button class="btn btn-categ btn-primary my-2 px-4 my-sm-0" type="submit">Найти</button>
        </form>

            @foreach($posts as $post)
            <div id="post" class="col-7">
                <div class="card">
                    <div class="card-header">
                        <h2>{{ $post->post_name }}</h2>
                        <h4>{{ $post->category_title }}</h4>
                        <div class="card-createrInfo">
                            <h6>{{ Illuminate\Support\Carbon::create($post->post_created)->diffForHumans() }}</h6>
                            <h6>{{ $post->name }}</h6>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="card-img" id="cardImg" style="background-image: url('{{ $post->img_url ?? asset('image/default.jpg') }}')"></div>
                        <div>{!!Str::length($post->content)>80 ? Str::substr($post->content, 0, 60) . '...' : $post->content!!}</div>
                    </div>
                    <div class="card-header d-flex justify-content-between align-middle">
                        <a href="{{ route('view',['id' => $post->post_id]) }}" class="btn btn-dark" data-toggle="button" aria-pressed="false" autocomplete="off">Посмотреть пост</a>
                        <div class="likesIndex p-0 m-0">
                            <form action="{{route('likeCreate',['id' => $post->post_id])}}" method="post">
                                {{ csrf_field() }}
                                <button type="submit">
                                    @auth  
                                        @if(auth()->user()->likedPosts->contains($post->post_id))
                                            <i class="fa-solid fa-heart"></i>
                                        @else
                                            <i class="fa-regular fa-heart"></i>
                                        @endif()
                                    @endauth
                                    @guest
                                        <i class="fa-regular fa-heart"></i>    
                                    @endguest
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach 

    <!-- Модальное окно -->
    @include('posts.modal-create')
    <!-- Конец модального окна -->

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
@endpush


