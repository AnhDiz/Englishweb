@extends('layouts.admin')
@section('title','Bảng phân quyền người dùng')
@section('main')
<div class="card card-primary">
    <div class="card-header">Tạo thêm phân quyền mới</div>
    <div class="card-body">
        <form action="{{route('role.store')}}" method="post">
            @csrf
            <div class="form-group">
                <label for="">Tên nhóm quyền</label>
                <input type="text" class="form-control" name="name">
            </div>
            <div class="form-group">
                <label for="">Routes</label>
                <div class="checkbox">
                    <label for="">
                        <input type="checkbox" name="route[]" value="word.index">
                        Word index
                    </label>
                </div>
                <div class="checkbox">
                    <label for="">
                        <input type="checkbox" name="route[]" value="type.index">
                        Type index
                    </label>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>

</div>
@stop();