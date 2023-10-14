@extends('layouts.admin')
@section('title','Type list')
@section('main')
<form action="{{route('type.store')}}" method="POST" role="form">
    @csrf
    <div class="form-group">
        <label for="">Name</label>
        <input type="text" class="form-control" name ="name" placeholder = "Nhập tên của loại từ mới vào đây">
        @error('name')
        <small class="help-block">{{$message}}</small>
        @enderror
    </div>
    <button class="btn btn-primary">Lưu</button>
</form>
@stop();