<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
    //
    public $timestamps = false;


    protected $primaryKey ='comment_id';

    protected $fillable=['comment_id','user_comment','comment','comment_created_at'];
 
}
