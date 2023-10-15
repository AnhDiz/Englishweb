<?php

namespace App\Http\Controllers;

use App\Models\Type;
use Illuminate\Http\Request;

class Typecontroller extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $data = Type::orderBy('id','ASC')->search()->paginate(5);
        return view('admin.type.index',['list'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.type.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:type'
        ],[
            'name.required'=>'Tên loại không được để trống',
            'name.unique'=> 'Loại từ này đã có trong CSDL'
        ]);
        if(Word::create($request->all())){
            return redirect()->route('type.index')->with('success','Thêm loại từ mới thành công');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Type $type)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Type $type)
    {
        return view('admin.type.edit',compact('type'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Type $type)
    {
        $type->update($request->only('name'));
        return redirect()->route('type.index')->with('success','sửa thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Type $type)
    {
        try {
            if($type->words->count() > 0){
                return redirect()->route('type.index')->with('error','không thể xóa loại từ này');
            }else{
                $type->delete();
                return redirect()->route('type.index')->with('success','xóa thành công');
            }
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
