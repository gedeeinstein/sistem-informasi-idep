<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

/**
 * Class MatchKecamatanID
 *
 * Validates that the input matches the expected Kecamatan ID format.
 *
 * @package App\Rules
 */
class MatchKecamatanID implements Rule
{
    /**
     * The Kecamatan ID to match against.
     *
     * @var string
     */
    protected $kecamatanID;

    /**
     * Create a new rule instance.
     *
     * @param  string  $kecamatanID
     * @return void
     */
    public function __construct($kecamatanID)
    {
        $this->kecamatanID = $kecamatanID;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return substr($value, 0, 8) === $this->kecamatanID;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "The :attribute must start with of the " . __("cruds.kecamatan.title") . " " .__("cruds.kecamatan.kode") ." followed by remain ".__("cruds.desa.title") ." ".__("cruds.desa.form.kode");
    }
}
