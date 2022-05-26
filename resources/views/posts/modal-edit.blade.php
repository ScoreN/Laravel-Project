<div class="modal fade" id="editPost" tabindex="-1" role="dialog" aria-labelledby="editPost" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editPost">Изменение поста</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('update', ['id' => $post->post_id])}}" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                            {{ csrf_field() }}  
                            {{ method_field('patch') }}
                            <div class="form-group pb-2">
                                <p class="m-0 p-0">Название поста</p>
                                <input name="postName" type="text" value="{{ old('postName') ?? $post->post_name ?? '' }}" class="form-control" required>
                            </div>
                            <div class="form-group pb-2">   
                                <p class="m-0 p-0">Категория</p>                
                                <select class="form-select" name="categoryAdd" aria-label="Disabled select example" required>
                                    <option selected>{{ old('categoryAdd') }}</option>
                                    @foreach($categories as $cat)
                                        <option value="{{$cat->category_id}}">{{$cat->category_title}}</option>
                                    @endforeach
                                </select>  
                            </div>
                            <div class="form-group pb-2">
                                <p class="m-0 p-0">Содержание поста</p>
                                <textarea name="Content" id="your_summernote" class="form-control" rows="10" required>{{ old('Content') ?? $post->content ?? '' }}</textarea>
                            </div>
                            <div class="form-group pb-2">
                                <p class="m-0 p-0">Изображение поста</p>
                                <input name="Img" type="file">
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Сохранить изменения</button>
                    </div>
                </form>
            </div>
        </div>
    </div>