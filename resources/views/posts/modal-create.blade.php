<div class="modal fade" id="createPost" tabindex="-1" role="dialog" aria-labelledby="createPost" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createPost">Создание поста</h5>
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('store')}}" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                        {{ csrf_field() }}
                        <div class="form-group pb-2">                   
                            <select class="form-select" name="categoryAdd" aria-label="Disabled select example" required>
                                <option selected>Выберите категорию</option>
                                @foreach($categories as $cat)
                                    <option value="{{$cat->category_id}}">{{$cat->category_title}}</option>
                                @endforeach
                            </select>  
                        </div>
                        <div class="form-group pb-2">
                            <p class="m-0 p-0">Название поста</p>
                            <input name="postName" type="text" class="form-control" value="{{ old('postName') ?? ''}}" required>
                        </div>
                        <div class="form-group pb-2">
                            <p class="m-0 p-0">Содержание поста</p>
                            <textarea name="Content" id="your_summernote" class="form-control" rows="10" required>{{ old('Content') ?? '' }}</textarea>
                        </div>
                        <div class="form-group pb-2">
                            <p class="m-0 p-0">Изображение поста</p>
                            <input name="Img" type="file">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Создать</button>
                </div>
            </form>
        </div>
    </div>
</div>