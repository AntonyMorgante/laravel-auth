<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Cathegory;

class Post extends Model
{
    protected $fillable=['title','content','slug','user_id','cathegory_id'];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function cathegoryName(){
        $cathegory_id = $this->cathegory_id;
        $cathegory = Cathegory::all()->where('id','=',$cathegory_id)->first();
        $name = $cathegory->name;
        return $name;
    }

    public function totalCathegories(){
        return Cathegory::all()->count();
    }
}
