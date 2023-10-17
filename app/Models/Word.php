<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Word extends Model
{
    use HasFactory;
    protected $table = 'av';
    protected $fillable = [
        'word',
        'html',
        'type_id',
        'description',
        'pronounce'
    ];

    public function scopeSearch($query){
        if($search = request()->search){
            $query = $query->where('word','like','%'.$search.'%');
            }
        return $query;
    }
    public function type(){
        return $this->hasOne(Type::class,'id','type_id');
    }
}
