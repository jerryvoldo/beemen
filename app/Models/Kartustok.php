<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kartustok extends Model
{
    use HasFactory;

    protected $fillable = ['nomor_kartu', 'masuk', 'keluar', 'sisa', 'nomor_spb', 'nomor_sbbk'];
}
