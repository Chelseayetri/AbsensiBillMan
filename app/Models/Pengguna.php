<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Str;

class Pengguna extends Authenticatable
{
    protected $table = 'pengguna';
    protected $primaryKey = 'id_pengguna';

    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'id_peran',
        'nama_lengkap',
        'email',
        'kata_sandi',
        'foto',
        'dibuat_pada'
    ];

    // 👉 Laravel AUTH pakai kolom ini sebagai password
    protected $authPasswordName = 'kata_sandi';

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (!$model->getKey()) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
            if (!$model->dibuat_pada) {
                $model->dibuat_pada = now();
            }
        });
    }

    // Relasi ke Peran
    public function peran()
    {
        return $this->belongsTo(Peran::class, 'id_peran', 'id_peran');
    }
}
