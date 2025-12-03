<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Auditable;
use DateTimeInterface;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * Class Meals
 *
 * Represents a MEALS (Monitoring, Evaluation, Accountability, Learning, and Sharing) entity.
 *
 * @package App\Models
 */
class Meals extends Model
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
            ->logOnly(['*']);
    }

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "tr_meals";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'program_id',
        'meals_title',
        'meals_code',
        'meals_status',
        'meals_description',
        'progress',
        'to_complete',
        'challenges',
        'risk',
        'mitigation',
        'action_plan',
        'action_plan_status',
        'action_plan_date'
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
     * Get the program associated with the MEALS.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    /**
     * Get the beneficiaries associated with the MEALS.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function beneficiaries()
    {
        return $this->hasMany(Meals_Penerima_Manfaat::class);
    }
}
