<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class KontrolAkses extends Model
{
    protected $table = 'kontrol_akses';
    protected $primaryKey = 'id_kontrol';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'sedang_dibuka',
        'waktu_buka',
        'waktu_tutup',
        'diubah_oleh'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (!$model->getKey()) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }

    // Relasi: KontrolAkses diubah oleh satu Pengguna (Admin)
    public function pengubah()
    {
        return $this->belongsTo(Pengguna::class, 'diubah_oleh', 'id_pengguna');
    }
}
