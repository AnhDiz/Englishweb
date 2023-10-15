@extends('layouts.admin')
@section('title','Word list')
@section('main')
<form action="" class= "form-inline" >
    <select name="type" id="" >
        <option value="0">Tất cả</option>
        <option value="1">danh từ</option>
        <option value="2">động từ</option>
        <option value="3">phó từ</option>
        <option value="4">tính từ</option>
        <option value="5">đại từ</option>
        <option value="6">liên từ</option>
        <option value="7">giới từ</option>
        <option value="8">thán từ</option>
        <option value="9">viết tắt</option>
    </select>
    <div class="form-group">
        <input type="text" class="form-control" name = "search" placeholder="Tìm kiếm" value ="{{$search}}">
    </div>
    <button type="submit" class="btn btn-primary">
        <i class="fas fa-search"></i>
    </button>
</form>
<table class="table table-hover">
    <thead>
            <tr>
                <th>Word</th>
                <th>Type</th>
                <th>Description</th>
                <th>Pronounce</th>
                <th class="text-right">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($list as $table)
            <tr>
                <td>{{$table->word}}</td>
                <td>{{$table->type->name}}</td>
                <td>{{$table->description}}</td>
                <td>{{$table->pronounce}}</td>
                <td>
                <td class="text-right"> 
                    <a href="{{route('word.edit',$table->id)}}"class="btn btn-sm btn-succes">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a href="{{route('word.destroy',$table->id)}}" class="btn btn-sm btn-succes btndelete">
                        <i class="fas fa-trash"></i>
                    </a>
                </td>
                </td>
            </tr>
            @endforeach
        </tbody>
</table>
<form action="" method = "POST" id = "form-delete">
    @csrf @method('DELETE')

</form>
<hr>
<div>
    {{$list->appends(request()->all())->links()}}
</div>
@stop();

@section('js')
    <script>
        $("a.btndelete").click(function(e){
            e.preventDefault();
            var _href = $(this).attr('href');
            $('form#form-delete').attr('action',_href);
            if(confirm('Are you sủe?')){
                $('form#form-delete').submit();
            }
        })
    </script>
@stop();