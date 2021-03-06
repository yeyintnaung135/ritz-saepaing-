<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable=['role'];
    public function user(){
        $this->hasMany(User::class,'role_id');
    }
}
