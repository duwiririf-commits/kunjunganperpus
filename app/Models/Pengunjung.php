<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengunjung extends Model
{
    protected $table = 'pengunjung';

    protected $primaryKey = 'id_pengunjung';

    protected $fillable = [
        'nisn_nip',
        'nama',
        'kelas_jabatan',
    ];

    public function kunjungan()
    {
        return $this->hasMany(Kunjungan::class, 'id_pengunjung', 'id_pengunjung');
    }
}