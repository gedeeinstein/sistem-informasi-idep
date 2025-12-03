<?php

namespace App\Models;

use App\Models\User;
use App\Models\Dusun;
use App\Traits\Auditable;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Program_Outcome_Output_Activity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Meals_PrePostTest
 *
 * Represents a pre-post test activity within the MEALS system.
 *
 * @package App\Models
 */
class Meals_PrePostTest extends Model
{
    use SoftDeletes, HasFactory, Auditable, LogsActivity;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'trmealspreposttest';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'programoutcomeoutputactivity_id',
        'user_id',
        'trainingname',
        'tanggalmulai',
        'tanggalselesai',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'tanggalmulai' => 'datetime',
        'tanggalselesai' => 'datetime',
        'filedbytraineepre' => 'boolean',
        'filedbytraineepost' => 'boolean',
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
     * Get the program activity associated with the test.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function programActivity()
    {
        return $this->belongsTo(Program_Outcome_Output_Activity::class, 'programoutcomeoutputactivity_id');
    }

    /**
     * Get the participants (peserta) associated with the test.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function peserta()
    {
        return $this->hasMany(Meals_PrePostTestPeserta::class, 'preposttest_id');
    }

    /**
     * Get the user who created the test.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
