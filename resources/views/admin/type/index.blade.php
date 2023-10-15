@extends('layouts.admin')
@section('title','Type list')
@section('main')
<form action="" class= "form-inline" >
    <div class="form-group">
        <input type="text" class="form-control" name ="search" placeholder="Tìm kiếm">
    </div>
    <button type="submit" class="btn btn-primary">
        <i class="fas fa-search"></i>
    </button>
</form>
<table class="table table-hover">
    <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Total</th>
                <th>Create Date</th>
                <th class="text-right">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($list as $table)
            <tr>
                <td>{{$table->id}}</td>
                <td>{{$table->name}}</td>
                <td>{{$table->words ? $table->words->count() : 0}}</td>
                <td>{{$table->date}}</td>
                <td class="text-right"> 
                    <a href=""class="btn btn-sm btn-succes">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a href=""class="btn btn-sm btn-succes">
                        <i class="fas fa-trash"></i>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
</table>
<hr>
<div>
    {{$list->appends(request()->all())->links()}}
</div>
@stop();