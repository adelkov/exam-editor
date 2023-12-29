<?php

namespace App\Models;

use App\Contracts\Evaluatable;
use App\Enums\QuestionType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

abstract class Question extends Model implements Evaluatable
{
    use HasFactory;

    // Specify the table for all types of questions as I use single table inheritance
    protected $table = 'questions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'text',
        'points',
        'question_category_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'question_category_id' => 'integer',
        'type' => QuestionType::class,
    ];

    public function questionType()
    {
        return $this->morphTo('questionable');
    }

    public function questionCategory(): BelongsTo
    {
        return $this->belongsTo(QuestionCategory::class);
    }

    public function answers(): HasMany
    {
        return $this->hasMany(Answer::class);
    }

    public function images(): BelongsToMany
    {
        return $this->belongsToMany(Image::class, 'image_question', 'question_id', 'image_id');
    }

    public function latexes(): HasMany
    {
        return $this->hasMany(Latex::class);
    }

    public function audio(): HasMany
    {
        return $this->hasMany(Audio::class);
    }
}
