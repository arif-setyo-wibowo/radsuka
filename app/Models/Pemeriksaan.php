<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Pasien;

class Pemeriksaan extends Model
{
    use HasFactory;
    protected $table = 'pemeriksaans';
    public $primaryKey = 'idpemeriksaan';

    public function pasien(): BelongsTo
    {
        return $this->belongsTo(Pasien::class,'idpasien','idpasien');
    }
}
