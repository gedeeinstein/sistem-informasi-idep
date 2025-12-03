<?php

namespace App\Models;

use App\Traits\Auditable;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Meals_Penerima_Manfaat
 *
 * Represents a beneficiary in the MEALS system (Penerima Manfaat).
 *
 * @package App\Models
 */
class Meals_Penerima_Manfaat extends Model
{
    use HasFactory, Auditable, LogsActivity, SoftDeletes;

    /**
     * Get the options for the activity log.
     *
     * @return \Spatie\Activitylog\LogOptions
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['*']);
    }

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "trmeals_penerima_manfaat";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'program_id',
        'user_id',
        'dusun_id',
        'nama',
        'no_telp',
        'jenis_kelamin',
        'rt',
        'rw',
        'umur',
        'keterangan',
        'is_head_family',
        'head_family_name',
        'is_non_activity',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'is_non_activity' => 'boolean',
        'is_head_family' => 'boolean',
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
     * Get the program associated with the beneficiary.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function program()
    {
        return $this->belongsTo(Program::class, 'program_id');
    }

    /**
     * Get the user associated with the beneficiary.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the Dusun (Sub-village) associated with the beneficiary.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function dusun()
    {
        return $this->belongsTo(Dusun::class, 'dusun_id');
    }

    /**
     * Get the group types (Jenis Kelompok) associated with the beneficiary.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function jenisKelompok()
    {
        return $this->belongsToMany(
            Master_Jenis_Kelompok::class,
            'trmeals_penerima_manfaat_jenis_kelompok',
            'trmeals_penerima_manfaat_id',
            'jenis_kelompok_id'
        );
    }

    /**
     * Get the marginalized groups associated with the beneficiary.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function kelompokMarjinal()
    {
        return $this->belongsToMany(
            Kelompok_Marjinal::class, // Model yang berelasi
            'trmeals_penerima_manfaat_kelompok_marjinal', // nama table untuk menampung relasi many-to-many (pivot) trmeasls_penerima_manfaat dan (master) kelompok_marjinal
            'trmeals_penerima_manfaat_id', // Foreign key di tabel pivot untuk model ini
            'kelompok_marjinal_id' // Foreign key di tabel pivot untuk model yang berelasi
        );
    }

    /**
     * Get the marginalized group pivot data.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function kelompokMarjinalPivot()
    {
        return $this->hasMany(Meals_Penerima_Manfaat_Kelompok_Marjinal::class, 'trmeals_penerima_manfaat_id');
    }

    /**
     * Get the activities associated with the beneficiary.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function penerimaActivity()
    {
        return $this->belongsToMany(
            Program_Outcome_Output_Activity::class, // Model yang berelasi
            'trmeals_penerima_manfaat_activity', // nama table untuk menampung relasi many-to-many (pivot) trmeasls_penerima_manfaat dan (master) kelompok_marjinal
            'trmeals_penerima_manfaat_id', // Foreign key di tabel pivot untuk model ini
            'programoutcomeoutputactivity_id' // Foreign key di tabel pivot untuk model yang berelasi
        );
    }
}
