<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bbs extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'bbs';

    protected $fillable = [
        'title',
        'image',
        'contents',
        'created_by',
        'created_at',
        'updated_by',
    ];

    public function accountboard()
    {
        return $this->hasOne('App\Models\User','id','created_by');
    }

    // public function accountboard_id()
    // {
    //     return $this->hasOne('App\Models\User','id','id');
    // }
}
