@extends('layouts.admin')
@section('title','Type list')
@section('main')
<form action="{{route('word.store')}}" method="POST" role="form">
    @csrf
    <div class="row">
        <div class="col-md-9">
            <div class = "form-group">
                <label for="">Từ vững</label>
                <input type="text" class="form-control" name ="word" placeholder = "Nhập từ mới">
                @error('word')
                <small class="help-block">{{$message}}</small>
                @enderror
                <label for="">Ý nghĩa</label>
                <textarea type="text" class="form-control" name ="description" placeholder = "Nhập chi tiết từ mới"></textarea>
                @error('description')
                <small class="help-block">{{$message}}</small>
                @enderror
                <label for="">Thông tin</label>
                <textarea type="text" class="form-control" name ="html" id = "content" placeholder = "Nhập chi tiết từ mới"></textarea>
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
                <input type="text" class="form-control" name ="pronounce" placeholder = "Cách đánh vần" >
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
            $('#content').summernote({
                height:400,
            })
        })
    </script>
@stop();