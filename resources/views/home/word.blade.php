@extends('layouts.site')
@section('test')

    <div id = "content">
        <div id="cover">
        <form method="get" action="">
            @csrf
            <div class="tb">
            <div class="td"><input type="text" placeholder="Search" required name="search" value ="{{$search}}"></div>
            <div class="td" id="s-cover">
                <button type="submit">
                <div id="s-circle"></div>
                <span></span>
                </button>
            </div>
            </div>
        </form>
        </div>
        <div id="cover">
            @foreach($list as $lists)
            <a class ="tab" href="{{route('word.detail',['id'=>$lists->id])}}">
                <div class="tb"><h1>{{$lists->word}}</h1></div>
                <div class="tb"><h3>{{$lists->description}}</h3></div>
            </a>
            @endforeach
            <div>
                {{$list->appends(request()->all())->links()}}
            </div>
        </div>
    </div>
@endsection