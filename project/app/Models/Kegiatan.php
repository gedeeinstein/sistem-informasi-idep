<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\User;
use DateTimeInterface;
use App\Traits\Auditable;
use Spatie\Image\Enums\Fit;

use App\Models\Jenis_Kegiatan;
use App\Models\TargetReinstra;
use App\Models\Kegiatan_Penulis;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Activitylog\LogOptions;
use GedeAdi\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Collection;
use Spatie\MediaLibrary\Conversions\Manipulations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\MediaCollections\Models\MediaCollection;

/**
 * Class Kegiatan
 *
 * Represents an activity (Kegiatan).
 *
 * @package App\Models
 */
class Kegiatan extends Model implements HasMedia
{
    use InteractsWithMedia, Auditable, HasFactory, HasRoles, LogsActivity;

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = ['assessment', 'sosialisasi', 'pelatihan', 'pembelanjaan', 'pengembangan', 'kampanye', 'pemetaan', 'monitoring', 'kunjungan', 'konsultasi', 'lainnya'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'trkegiatan';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'tanggalmulai',
        'tanggalselesai'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'created_at'   => 'datetime',
        'updated_at'   => 'datetime',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'programoutcomeoutputactivity_id',
        'jeniskegiatan_id',
        'user_id',
        'fasepelaporan',
        'tanggalmulai',
        'tanggalselesai',
        'status',
        'deskripsilatarbelakang',
        'deskripsitujuan',
        'deskripsikeluaran',
        'deskripsiyangdikaji',
        'penerimamanfaatdewasaperempuan',
        'penerimamanfaatdewasalakilaki',
        'penerimamanfaatdewasatotal',
        'penerimamanfaatlansiaperempuan',
        'penerimamanfaatlansialakilaki',
        'penerimamanfaatlansiatotal',
        'penerimamanfaatremajaperempuan',
        'penerimamanfaatremajalakilaki',
        'penerimamanfaatremajatotal',
        'penerimamanfaatanakperempuan',
        'penerimamanfaatanaklakilaki',
        'penerimamanfaatanaktotal',
        'penerimamanfaatdisabilitasperempuan',
        'penerimamanfaatdisabilitaslakilaki',
        'penerimamanfaatdisabilitastotal',
        'penerimamanfaatnondisabilitasperempuan',
        'penerimamanfaatnondisabilitaslakilaki',
        'penerimamanfaatnondisabilitastotal',
        'penerimamanfaatmarjinalperempuan',
        'penerimamanfaatmarjinallakilaki',
        'penerimamanfaatmarjinaltotal',
        'penerimamanfaatperempuantotal',
        'penerimamanfaatlakilakitotal',
        'penerimamanfaattotal',
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
     * Get the start date attribute.
     *
     * @param  string|null  $value
     * @return string|null
     */
    public function getTglMulaiAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    /**
     * Set the writer (penulis) attribute.
     *
     * @param  int  $value
     * @return void
     */
    public function setPenulisAttribute($value)
    {
        // Set the penulis_id attribute to the ID of the user associated with the penulis input
        $this->attributes['penulis_id'] = $value;
    }

    /**
     * Get the writer (penulis) attribute.
     *
     * @return \App\Models\User|null
     */
    public function getPenulisAttribute()
    {
        return isset($this->attributes['penulis_id']) ? User::find($this->attributes['penulis_id']) : null;
    }

    /**
     * Set the start date attribute.
     *
     * @param  string|null  $value
     * @return void
     */
    public function setTglMulaiAttribute($value)
    {
        $this->attributes['tanggalmulai'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    /**
     * Get the end date attribute.
     *
     * @param  string|null  $value
     * @return string|null
     */
    public function getTglSelesaiAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    /**
     * Set the end date attribute.
     *
     * @param  string|null  $value
     * @return void
     */
    public function setTglSelesaiAttribute($value)
    {
        $this->attributes['tanggalselesai'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    /**
     * Get the image attribute.
     *
     * @return \Spatie\MediaLibrary\MediaCollections\Models\Media|null
     */
    public function getImageAttribute()
    {
        $file = $this->getMedia('media_pendukung')->last();
        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
        }

        return $file;
    }

    /**
     * Register media collections.
     *
     * @return void
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('dokumen_pendukung')
            ->useDisk('kegiatan_uploads');

        $this->addMediaCollection('media_pendukung')
            ->useDisk('kegiatan_uploads');
    }

    /**
     * Register media conversions.
     *
     * @param  \Spatie\MediaLibrary\MediaCollections\Models\Media|null  $media
     * @return void
     */
    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit(Fit::Crop, 320, 320)->performOnCollections('media_pendukung');
        $this->addMediaConversion('preview')->fit(Fit::Crop, 600, 800)->performOnCollections('media_pendukung');
    }

    /**
     * Get supporting documents.
     *
     * @return \Spatie\MediaLibrary\MediaCollections\Models\MediaCollection
     */
    public function getDokumenPendukung()
    {
        return $this->getMedia('dokumen_pendukung');
    }

    /**
     * Get supporting media.
     *
     * @return \Spatie\MediaLibrary\MediaCollections\Models\MediaCollection
     */
    public function getMediaPendukung()
    {
        return $this->getMedia('media_pendukung');
    }

    /**
     * Get duration in days.
     *
     * @return int
     */
    public function getDurationInDays()
    {
        return Carbon::parse($this->tanggalmulai)
            ->diffInDays(Carbon::parse($this->tanggalselesai));
    }

    /**
     * Get the user who owns the activity.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the dusun associated with the activity.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function dusun()
    {
        return $this->belongsTo(Dusun::class, 'dusun_id');
    }

    /**
     * Get the location category associated with the activity.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function kategori_lokasi()
    {
        return $this->belongsTo(Kategori_Lokasi_Kegiatan::class, 'kategorilokasikegiatan_id');
    }

    /**
     * Get the assistance type associated with the activity.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function jenis_bantuan()
    {
        return $this->belongsTo(Jenis_Bantuan::class, 'jenisbantuan_id');
    }

    /**
     * Get the unit associated with the activity.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function satuan()
    {
        return $this->belongsTo(Satuan::class, 'satuan_id');
    }

    /**
     * Get the program outcome output activity.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function activity()
    {
        return $this->belongsTo(Program_Outcome_Output_Activity::class, 'programoutcomeoutputactivity_id');
    }

    /**
     * Get the type of activity.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function jenisKegiatan()
    {
        return $this->belongsTo(Jenis_Kegiatan::class, 'jeniskegiatan_id');
    }

    /**
     * Get the program outcome output activity (alias).
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function programOutcomeOutputActivity()
    {
        return $this->belongsTo(Program_Outcome_Output_Activity::class, 'programoutcomeoutputactivity_id');
    }

    /**
     * Get the locations associated with the activity.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function lokasi()
    {
        return $this->hasMany(Kegiatan_Lokasi::class, 'kegiatan_id');
    }

    /**
     * Get the location activities associated with the activity (BelongsToMany).
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function lokasi_kegiatan()
    {
        return $this->belongsToMany(Kelurahan::class, 'trkegiatan_lokasi', 'kegiatan_id', 'desa_id');
    }

    /**
     * Get the writers associated with the activity.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function penulis()
    {
        return $this->belongsToMany(User::class, 'trkegiatanpenulis', 'kegiatan_id', 'penulis_id')->withPivot('peran_id')->withTimestamps();
    }

    /**
     * Get the writer data (alias).
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function datapenulis()
    {
        return $this->belongsToMany(User::class, 'trkegiatanpenulis', 'kegiatan_id', 'penulis_id')->withPivot('peran_id')->withTimestamps();
    }

    /**
     * Get the report associated with the activity.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function laporan()
    {
        return $this->belongsToMany(User::class, 'trkegiatanpenulis', 'kegiatan_id', 'penulis_id')
            ->using(Kegiatan_Penulis::class)
            ->withTimestamps();
    }

    /**
     * Constant for status selection options.
     */
    public const STATUS_SELECT = [
        'draft'    => 'Draft',
        'ongoing'  => 'Ongoing',
        'completed' => 'Completed',
        'cancelled' => 'Cancelled',
    ];

    /**
     * Get activity types as an array.
     *
     * @return array
     */
    public static function getJenisKegiatan(): array
    {
        return Jenis_Kegiatan::select('id', 'nama')->get()->mapWithKeys(function ($item) {
            return [$item->id => $item->nama];
        })->toArray();
    }

    /**
     * Get the assessment associated with the activity.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function assessment()
    {
        return $this->hasOne(Kegiatan_Assessment::class, 'kegiatan_id');
    }

    /**
     * Get the campaign associated with the activity.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function kampanye()
    {
        return $this->hasOne(Kegiatan_Kampanye::class, 'kegiatan_id');
    }

    /**
     * Get the consultation associated with the activity.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function konsultasi()
    {
        return $this->hasOne(Kegiatan_Konsultasi::class, 'kegiatan_id');
    }

    /**
     * Get the visit associated with the activity.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function kunjungan()
    {
        return $this->hasOne(Kegiatan_Kunjungan::class, 'kegiatan_id');
    }

    /**
     * Get other activity details associated with the activity.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function lainnya()
    {
        return $this->hasOne(Kegiatan_Lainnya::class, 'kegiatan_id');
    }

    /**
     * Get the monitoring associated with the activity.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function monitoring()
    {
        return $this->hasOne(Kegiatan_Monitoring::class, 'kegiatan_id');
    }

    /**
     * Get the training associated with the activity.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function pelatihan()
    {
        return $this->hasOne(Kegiatan_Pelatihan::class, 'kegiatan_id');
    }

    /**
     * Get the procurement associated with the activity.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function pembelanjaan()
    {
        return $this->hasOne(Kegiatan_Pembelanjaan::class, 'kegiatan_id');
    }

    /**
     * Get the mapping associated with the activity.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function pemetaan()
    {
        return $this->hasOne(Kegiatan_Pemetaan::class, 'kegiatan_id');
    }

    /**
     * Get the development associated with the activity.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function pengembangan()
    {
        return $this->hasOne(Kegiatan_Pengembangan::class, 'kegiatan_id');
    }

    /**
     * Get the socialization associated with the activity.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function sosialisasi()
    {
        return $this->hasOne(Kegiatan_Sosialisasi::class, 'kegiatan_id');
    }

    /**
     * Get the partners associated with the activity.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function mitra()
    {
        return $this->belongsToMany(Partner::class, 'trkegiatan_mitra', 'kegiatan_id', 'mitra_id');
    }

    /**
     * Get the activity writers.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function kegiatan_penulis()
    {
        return $this->hasMany(Kegiatan_Penulis::class, 'kegiatan_id')
            ->with('peran', 'user'); // eager load peran & user
    }

    /**
     * Get the sectors associated with the activity.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function sektor()
    {
        return $this->belongsToMany(TargetReinstra::class, 'trkegiatan_sektor', 'kegiatan_id', 'sektor_id');
    }

    /**
     * Get the Reinstra targets associated with the activity.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function target_reinstra()
    {
        return $this->belongsToMany(TargetReinstra::class, 'trkegiatan_sektor', 'kegiatan_id', 'sektor_id');
    }

    /**
     * Get the user who owns the activity (alias).
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the village associated with the activity.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function desa()
    {
        return $this->belongsTo(Kelurahan::class, 'desa_id');
    }

    /**
     * Get the model map for activity types.
     *
     * @return array
     */
    public static function getJenisKegiatanModelMap(): array
    {
        return [
            1 => Kegiatan_Assessment::class,
            2 => Kegiatan_Sosialisasi::class,
            3 => Kegiatan_Pelatihan::class,
            4 => Kegiatan_Pembelanjaan::class,
            5 => Kegiatan_Pengembangan::class,
            6 => Kegiatan_Kampanye::class,
            7 => Kegiatan_Pemetaan::class,
            8 => Kegiatan_Monitoring::class,
            9 => Kegiatan_Kunjungan::class,
            10 => Kegiatan_Konsultasi::class,
            11 => Kegiatan_Lainnya::class,
        ];
    }

    /**
     * Get the relation map for activity types.
     *
     * @return array
     */
    public static function getJenisKegiatanRelationMap(): array
    {
        return [
            1 => 'assessment',
            2 => 'sosialisasi',
            3 => 'pelatihan',
            4 => 'pembelanjaan',
            5 => 'pengembangan',
            6 => 'kampanye',
            7 => 'pemetaan',
            8 => 'monitoring',
            9 => 'kunjungan',
            10 => 'konsultasi',
            11 => 'lainnya',
        ];
    }

    /**
     * Get the result of the activity based on its type.
     *
     * @return mixed
     */
    public function getKegiatanHasilAttribute()
    {
        $jenisKegiatan = (int) $this->jeniskegiatan_id;
        $relationMap = self::getJenisKegiatanRelationMap();

        if (!isset($relationMap[$jenisKegiatan])) {
            return null; // Or throw an exception
        }

        $relationName = $relationMap[$jenisKegiatan];
        return $this->$relationName;
    }

    /**
     * Get all media attributes.
     *
     * @return array
     */
    public function getAllMediaAttribute()
    {
        return [
            'dokumen_pendukung' => $this->getMedia('dokumen_pendukung'),
            'media_pendukung' => $this->getMedia('media_pendukung'),
        ];
    }

    /**
     * Get the program associated with the activity.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOneThrough
     */
    public function program()
    {
        return $this->belongsToThrough(
            \App\Models\Program::class,
            [
                \App\Models\Program_Outcome_Output_Activity::class,
                \App\Models\Program_Outcome_Output::class,
                \App\Models\Program_Outcome::class,
            ],
            foreignKeyLookup: [
                \App\Models\Program_Outcome_Output_Activity::class => 'programoutcomeoutputactivity_id',
            ]
        );
    }
}
