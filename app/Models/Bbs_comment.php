<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bbs_comment extends Model
{
    use HasFactory;

    protected $table = 'bbs_comments';

    protected $fillable = [
        'bbs_id',
        'comment',
        'created_by',
    ];

    public function accountboard()
    {
        return $this->hasOne('App\Models\User','id','created_by');
    }

    public function bbsboard()
    {
        return $this->hasOne('App\Models\Bbs','id','bbs_id');
    }
}
