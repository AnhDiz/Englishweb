@extends('layouts.site')

@section('test')
    <br>
    <br>
    <div class ="row">
        <div>
            <h1>quan lý tài khoản </h1>
        </div>
        
        <div>
            <a href="{{route('register')}}">Thêm mới</a>                
        </div>

    </div>

    <div>
        <table>
            <thead>
                <tr>
                    <th> STT_id</th>
                    <th>id</th>
                    <th> name</th>
                    <th> pass</th>
                    <th> email</th>
                    <th> role</th>
                </tr>
            </thead>

            <tbody>
                @foreach($quanlyuser as $ql)
                    <tr>
                        <td>{{++$i}}</td>
                        <td>{{$ql->id}}</td>
                        <td>{{$ql->name}}</td>
                        <td>{{$ql->password}}</td>
                        <td>{{$ql->email}}</td>
                        <td>{{$ql->role}}</td>
                        <td>
                                <form action="{{ route('quanly.delete', ['id' => $ql->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">Xóa</button>
                                </form>
                            </td>
                            <td>
                                <a href="{{ route('quanly.edit', ['id' => $ql->id]) }}">Sửa</a>
                            </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection