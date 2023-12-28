<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QuestionGroupTemplate extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'numberOfQuestions',
        'pointsFrom',
        'pointsTo',
        'module_template_id',
        'question_category_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'module_template_id' => 'integer',
        'question_category_id' => 'integer',
    ];

    public function moduleTemplate(): BelongsTo
    {
        return $this->belongsTo(ModuleTemplate::class);
    }

    public function questionCategory(): BelongsTo
    {
        return $this->belongsTo(QuestionCategory::class);
    }
}
