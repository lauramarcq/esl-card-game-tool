<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Noun extends Model
{
    use HasFactory;

    protected $fillable = [
        'noun',
        'is_plural',
        'is_irregular',
        'ends_in_y',
        'ends_in_s_sh_ch',
        'ends_in_f',
        'begins_with_vowel_sound',
    ];

    public function getIsPluralAttribute($value): string
    {
        return $value ? 'Yes' : 'No';
    }

    public function getIsIrregularAttribute($value): string
    {
        return $value ? 'Yes' : 'No';
    }

    public function getEndsInYAttribute($value): string
    {
        return $value ? 'Yes' : 'No';
    }

    public function getEndsInSShChAttribute($value): string
    {
        return $value ? 'Yes' : 'No';
    }

    public function getEndsInFAttribute($value): string
    {
        return $value ? 'Yes' : 'No';
    }

    public function getBeginsWithVowelSoundAttribute($value): string
    {
        return $value ? 'Yes' : 'No';
    }

        /**
     * Get the articles that begin with the noun.
     *
     * @return array<string>
     */
    public function articles(): array
    {
        $articles = [];

        if ($this->begins_with_vowel_sound && !$this->is_plural) {
            $articles[] = 'an';
        }

        if (!$this->begins_with_vowel_sound && !$this->is_plural) {
            $articles[] = 'a';
        }

        else {
            $articles[] = 'the';
        }

        return $articles;
    }
}
