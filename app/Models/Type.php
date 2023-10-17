<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;
    protected $table = 'type';
    protected $fillable = [
        'name',
    ];

    public function scopeSearch($query){
        if($search = request()->search){
            $query = $query->where('name','like','%'.$search.'%');
            }
        return $query;
    }

    public function words(){
        return $this->hasMany(Word::class,'type_id','id');
    }

}
