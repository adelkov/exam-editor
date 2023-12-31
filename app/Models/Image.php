<?php

namespace App\Models;

use Faker\Core\File;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Image extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'alt',
        'url',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];

    public function questions(): BelongsToMany
    {
        return $this->belongsToMany(Question::class);
    }

    public static function getForm(): array
    {
        return [
                TextInput::make('alt')
                    ->required()
                    ->maxLength(255),
                FileUpload::make('url')
                    ->image()
                    ->imageEditor()
                    ->maxSize(1024 * 1024 * 2)
                    ->required(),
        ];
    }
}
