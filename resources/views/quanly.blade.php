@extends('layouts.admin')

@section('main')
<div class="container">
    <div class="row">
        <div class="col">
            <h1 class="my-4">Quản lý tài khoản</h1>
        </div>
        <div class="col text-end">
            <a href="{{ route('quanly.add') }}" class="btn btn-primary my-4">Thêm mới</a>
        </div>
    </div>

    <div class="table-container">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Password</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($quanlyuser as $ql)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $ql->id }}</td>
                        <td>{{ $ql->name }}</td>
                        <td>{{ $ql->password }}</td>
                        <td>{{ $ql->email }}</td>
                        <td>{{ $ql->role }}</td>
                        <td>
                            <form action="{{ route('quanly.delete', ['id' => $ql->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm btn-hover">Xóa</button>
                            </form>
                            <a href="{{ route('quanly.edit', ['id' => $ql->id]) }}" class="btn btn-primary btn-sm btn-hover">Sửa</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="pagination-container">
            {{ $quanlyuser->links() }}
        </div>
    </div>
</div>

<style>
    .table-container {
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
        margin-top: 20px;
        overflow-x: auto;
    }

    .table-container table {
        width: 100%;
        margin-bottom: 0;
    }

    .table-container h1 {
        margin-bottom: 20px;
    }

    .table-container .my-4 {
        margin-top: 0;
    }

    .table-container .btn {
        margin-bottom: 10px;
    }

    .table-container .btn-hover:hover {
        /* Định dạng hiệu ứng hover ở đây */
    }

    .table-container .table-fade {
        opacity: 0;
        transition: opacity 0.5s;
    }

    .table-container .table-fade.fade-in {
        opacity: 1;
    }

    .pagination-container {
        margin-top: 20px;
        display: flex;
        justify-content: center;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const table = document.querySelector('.table-fade');
        table.classList.add('fade-in');
    });
</script>
@endsection