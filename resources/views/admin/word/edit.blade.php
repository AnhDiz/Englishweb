@extends('layouts.admin')
@section('title','Type list')
@section('main')
<form action="{{route('word.update',$word->id)}}" method="POST" role="form">
    @csrf @method('PUT')
    <div class="row">
        <div class="col-md-9">
            <div class = "form-group">
                <label for="">Từ vững</label>
                <input type="text" class="form-control" name ="word" placeholder = "Nhập từ mới" value = "{{$word->word}}" >
                @error('word')
                <small class="help-block">{{$message}}</small>
                @enderror
                <label for="">Ý nghĩa</label>
                <textarea type="text" class="form-control" name ="description" placeholder = "Nhập chi tiết từ mới" value = "">{{$word->description}}</textarea>
                @error('description')
                <small class="help-block">{{$message}}</small>
                @enderror
                <label for="">Thông tin</label>
                <textarea type="text" class="form-control" name ="html" id = "content" placeholder = "Nhập chi tiết từ mới">{{$word->html}}</textarea>
            </div>
        </div>
        <div class="col-md-3">
            <div class ="form-group">
                <label for="">Loại từ</label>
                <select name="type_id" id="" class ="form-control">
                    <option value="0">loại từ</option>
                    @foreach($types as $type)
                    <option value="{{$type->id}}">{{$type->name}}</option>
                    @endforeach
                </select>
                @error('type_id')
                <small class="help-block">{{$message}}</small>
                @enderror
                <label for="">Đánh vần</label>
                <input type="text" class="form-control" name ="pronounce" placeholder = "Cách đánh vần" value = "{{$word->pronounce}}">
                @error('pronounce')
                <small class="help-block">{{$message}}</small>
                @enderror
            </div>
        </div>
    </div>
    <button class="btn btn-primary">Lưu</button>
</form>
@stop();
@section('css')
    <link rel="stylesheet" href="{{url('/ad111')}}/plugins/summernote/summernote-bs4.min.css">
@stop();
@section('js')
    <script src="{{url('/ad111')}}/plugins/summernote/summernote-bs4.min.js"></script>
    <script>
        $(function () {
            $('#content').summernote()
        })
    </script>
@stop();
