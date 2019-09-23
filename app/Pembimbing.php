<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pembimbing extends Model
{
    use SoftDeletes;

    protected $table = 'pembimbing';
    protected $primaryKey = 'nik_nip';
    protected $guarded = [];
    public $incrementing = false;
}
