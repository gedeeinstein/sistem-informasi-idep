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
 * Class Kegiatan_Pembelanjaan
 *
 * Represents a procurement activity (Kegiatan Pembelanjaan).
 *
 * @package App\Models
 */
class Kegiatan_Pembelanjaan extends Model
{
    use HasFactory, Auditable, LogsActivity;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'trkegiatanpembelanjaan';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'kegiatan_id',
        'pembelanjaandetailbarang',
        'pembelanjaanmulai',
        'pembelanjaanselesai',
        'pembelanjaandistribusimulai',
        'pembelanjaandistribusiselesai',
        'pembelanjaanterdistribusi',
        'pembelanjaanakandistribusi',
        'pembelanjaanakandistribusi_ket',
        'pembelanjaankendala',
        'pembelanjaanisu',
        'pembelanjaanpembelajaran',
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
     * Get the activity associated with the procurement.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class, 'kegiatan_id');
    }
}
