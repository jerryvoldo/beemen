<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spb extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['daftarspb_id', 'isAju'];

}
