<?php

namespace App\Models;

use App\Traits\Auditable;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Builder;


class Provinsi extends Model
{
    use Auditable, HasFactory;
    protected $table = 'provinsi';


    protected $fillable = [
        'kode',
        'nama',
        'aktif',
        'id_negara',
        'created_at',
        'updated_at',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function kabupatens()
    {
        // return $this->hasMany(Kabupaten::class);
    }

    public function dataAktif()
    {
        $province = Provinsi::where('aktif', 1)->get();
    }

    public function scopeWithActive(Builder $query)
    {
        return $query->where('aktif', 1);
    }
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
