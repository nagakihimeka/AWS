<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
        // 追記することで、指定したカラムに対してのみ、 createやupdateなどが可能
    // ※fillable = 書き換え可能
    protected $fillable = [
        'post'
    ];
}
