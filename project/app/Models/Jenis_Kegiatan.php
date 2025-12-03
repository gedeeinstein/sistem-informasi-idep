<?php

namespace App\Models;

use DateTimeInterface;
use App\Traits\Auditable;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Jenis_Kegiatan
 *
 * Represents a type of activity (Jenis Kegiatan).
 *
 * @package App\Models
 */
class Jenis_Kegiatan extends Model
{
    use HasFactory, Auditable, LogsActivity;

    /**
     * Get the options for the activity log.
     *
     * @return \Spatie\Activitylog\LogOptions
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly(['*']);  // Pastikan log yang diinginkan
    }

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'mjeniskegiatan';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama',
        'aktif',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $date = [
        'created_at',
        'updated_at',
    ];

    /**
     * Prepare a date for array / JSON serialization.
     *
     * @param  \DateTimeInterface  $date
     * @return string
     */
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    /**
     * Get the activities associated with this type.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function trkegiatan()
    {
        return $this->hasMany(Kegiatan::class, 'jeniskegiatan_id');
    }

    /**
     * Get the activities associated with this type (alias for trkegiatan).
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function kegiatan()
    {
        return $this->hasMany(Kegiatan::class, 'jeniskegiatan_id');
    }
}
