<?php

namespace App\Models;

use DateTimeInterface;
use App\Models\Kegiatan;
use App\Traits\Auditable;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Kegiatan_Sosialisasi
 *
 * Represents a socialization activity (Kegiatan Sosialisasi).
 *
 * @package App\Models
 */
class Kegiatan_Sosialisasi extends Model
{
    use HasFactory, Auditable, LogsActivity;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'trkegiatansosialisasi';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'kegiatan_id',
        'sosialisasiyangterlibat',
        'sosialisasitemuan',
        'sosialisasitambahan',
        'sosialisasitambahan_ket',
        'sosialisasikendala',
        'sosialisasiisu',
        'sosialisasipembelajaran',
        'created_at',
        'updated_at',
    ];

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
     * Get the activity associated with the socialization.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class, 'kegiatan_id');
    }
}
