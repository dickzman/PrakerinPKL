<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Peserta extends Model
{
    use SoftDeletes;
    
    protected $table = 'peserta';
    protected $primaryKey = 'kode_pst';
    public $incrementing = false;
    protected $guarded = [];
}
