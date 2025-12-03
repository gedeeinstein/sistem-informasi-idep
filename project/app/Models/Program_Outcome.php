<?php

namespace App\Models;

use DateTimeInterface;
use App\Models\Program;
use App\Traits\Auditable;
use Spatie\Activitylog\LogOptions;
use App\Models\Program_Outcome_Output;
use GedeAdi\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Program_Outcome
 *
 * Represents an outcome of a program.
 *
 * @package App\Models
 */
class Program_Outcome extends Model
{
    use HasFactory, Auditable, HasRoles, LogsActivity;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'trprogramoutcome';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'program_id',
        'deskripsi',
        'indikator',
        'target',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
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
     * Get the program associated with the outcome.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function program()
    {
        return $this->belongsTo(Program::class, 'program_id');
    }

    /**
     * Get the outputs associated with the outcome.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function output()
    {
        return $this->hasMany(Program_Outcome_Output::class, 'programoutcome_id');
    }
}
