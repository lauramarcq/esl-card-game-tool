<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Level;

class Subject extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'subject',
        'is_plural',
        'begins_with_article_a',
        'begins_with_article_an',
        'begins_with_article_the',
        'is_people',
        'is_animal',
        'is_place',
        'is_thing',
    ];

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_plural' => 'boolean',
            'begins_with_article_a' => 'boolean',
            'begins_with_article_an' => 'boolean',
            'begins_with_article_the' => 'boolean',
            'is_people' => 'boolean',
            'is_animal' => 'boolean',
            'is_place' => 'boolean',
            'is_thing' => 'boolean',
        ];
    }

    public function levels()
    {
        return $this->belongsToMany(Level::class);
    }

    /**
     * Get the articles that begin with the subject.
     *
     * @return array<string>
     */
    public function articles(): array
    {
        $articles = [];

        if ($this->begins_with_article_a) {
            $articles[] = 'a';
        }

        if ($this->begins_with_article_an) {
            $articles[] = 'an';
        }

        if ($this->begins_with_article_the) {
            $articles[] = 'the';
        }

        return $articles;
    }

    /**
     * Get the subject with the article.
     *
     * @return string
     */
    public function withArticle(): string
    {
        $articles = $this->articles();

        if (count($articles) === 0) {
            return $this->subject;
        }

        return $articles[0] . ' ' . $this->subject;
    }
}
