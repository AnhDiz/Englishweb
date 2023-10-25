<?php

namespace App\Http\Controllers;

use App\Models\Word;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class WordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {   
        $type = $request->type;
        $search = $request->search;
        if($type == 0){
            $list = Word::orderBy('id','ASC')->search()->paginate(15);
        }else{
            $list = Word::orderBy('id','ASC')->where('type_id','like',$request->type)->search()->paginate(15);
        }
        $role = Auth::user()->role;
        if($role == '1'){
            return view('admin.word.index',compact('list','type','search'));
        }else{
            return view('home.word',compact('list','search'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = Type::orderBy('id','ASC')->select('id','name')->get();
        return view('admin.word.create',compact('types'));
    }

    public function detail(){
        $id = request()->id;
        $word = Word::find($id);
        return view('home.detail',['word'=>$word]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(Word::create($request->all())){
            return redirect()->route('word.index')->with('success','Thêm từ mới thành công');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Word $word)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Word $word)
    {
        $types = Type::orderBy('id','ASC')->select('id','name')->get();
        return view('admin.word.edit',compact('word','types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Word $word)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Word $word)
    {
        $word->delete();
        return redirect()->route('word.index')->with('success','xóa thành công');
    }
}
