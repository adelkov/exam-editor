<?php

namespace App\Models;

use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ModuleTemplate extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'durationInMinutes'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];

    public function questionGroupTemplates(): HasMany
    {
        return $this->hasMany(QuestionGroupTemplate::class);
    }

    public function examTemplates(): BelongsToMany
    {
        return $this->belongsToMany(ExamTemplate::class);
    }


    public static function getForm(): array
    {
        return [
            Section::make('Module details')
                ->columns(2)
                ->aside()
                ->description('The module details so interesting')
                ->icon('heroicon-o-rectangle-stack')
                ->schema([
                    TextInput::make('name')
                        ->required()
                        ->maxLength(255),
                    TextInput::make('durationInMinutes')
                        ->required()
                        ->numeric(),
                ]),
            Section::make('Question groups')
                ->columns(2)
                ->aside()
                ->description('The question groups for this module')
                ->icon('heroicon-o-rectangle-stack')
                ->schema([
            Repeater::make('questionGroupTemplates')
                ->relationship()
                ->collapsed()
                ->columnSpan(2)
                ->itemLabel(fn(array $state): ?string => $state['name'] ?? "New question group")
                ->schema([
                    TextInput::make('name')
                        ->required()
                        ->maxLength(255),
                    TextInput::make('numberOfQuestions')
                        ->required()
                        ->numeric(),
                    TextInput::make('pointsFrom')
                        ->required()
                        ->numeric(),
                    TextInput::make('pointsTo')
                        ->gte('pointsFrom')
                        ->required()
                        ->numeric(),
                    Select::make('question_category_id')
                        ->options(
                            QuestionCategory::all()
                                ->pluck('name', 'id')
                                ->toArray())
                        ->relationship('questionCategory', 'name')
                        ->required()
                        ->columnSpan(2)
                        ->preload()
                        ->native(false)
                        ->createOptionForm(QuestionCategory::getForm())
                        ->editOptionForm(QuestionCategory::getForm())
                ])
            ])
        ];
    }
}
