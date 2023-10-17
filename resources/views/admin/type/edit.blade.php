@extends('layouts.admin')
@section('title','Type list')
@section('main')
<form action="{{route('type.update',$type->id)}}" method="POST" role="form">
    @csrf @method('PUT')
    <div class="form-group">
        <label for="">Name</label>
        <input type="text" class="form-control" name ="name" placeholder = "Nhập tên của loại từ mới vào đây" value = "{{$type->name}}">
        @error('name')
        <small class="help-block">{{$message}}</small>
        @enderror
    </div>
    <button class="btn btn-primary">Lưu</button>
</form>
@stop();