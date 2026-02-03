<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Peran extends Model
{
    protected $table = 'peran';
    protected $primaryKey = 'id_peran';

    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = ['nama_peran'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (!$model->getKey()) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }

    public function pengguna()
    {
        return $this->hasMany(Pengguna::class, 'id_peran', 'id_peran');
    }
}
