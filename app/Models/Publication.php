<?php

namespace App\Models;

use App\Casts\CustomTypeArray;
use App\Models\Presentation;
use App\Types\CitationIndex;
use App\Types\PublicationType;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Publication extends Model
{
    protected $fillable = [
        'type',
        'name',
        'paper_title',
        'date',
        'volume',
        'publisher',
        'number',
        'indexed_in',
        'page_numbers',
        'city',
        'country',
        'author_type',
        'author_id',
        'is_published',
        'document_path',
        'paper_link',
    ];

    protected static function boot()
    {
        parent::boot();

        static::deleting(static function ($publication) {
            Storage::delete($publication->document_path);
        });
    }

    protected $dates = ['date'];

    protected $casts = [
        'indexed_in' => CustomTypeArray::class . ':' . CitationIndex::class,
        'page_numbers' => 'array',
        'is_published' => 'boolean',
    ];

    public function scopeJournal(Builder $builder)
    {
        return $builder->whereType(PublicationType::JOURNAL)->orderBy('date', 'DESC');
    }

    public function scopeConference(Builder $builder)
    {
        return $builder->whereType(PublicationType::CONFERENCE)->orderBy('date', 'DESC');
    }

    public function setIndexedInAttribute($value)
    {
        if (is_array($value)) {
            $this->attributes['indexed_in'] = implode('|', $value);
        } else {
            $this->attributes['indexed_in'] = $value;
        }
    }

    public function getIndexedInAttribute($value)
    {
        return explode('|', $value);
    }

    public function setPageNumbersAttribute($value)
    {
        $this->attributes['page_numbers'] = implode('-', $value);
    }

    public function getPageNumbersAttribute($value)
    {
        return explode('-', $value);
    }

    public function author()
    {
        return $this->morphTo('author');
    }

    public function presentations()
    {
        return $this->hasMany(Presentation::class)->orderBy('date', 'desc');
    }

    public function coAuthors()
    {
        return $this->hasMany(CoAuthor::class, 'publication_id');
    }

    public function isPublished()
    {
        return $this->is_published === true;
    }
}
