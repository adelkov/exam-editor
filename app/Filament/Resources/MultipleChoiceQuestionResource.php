<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MultipleChoiceQuestionResource\Pages;
use App\Filament\Resources\MultipleChoiceQuestionResource\RelationManagers;
use App\Models\Image;
use App\Models\MultipleChoiceQuestion;
use App\Models\QuestionCategory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class MultipleChoiceQuestionResource extends Resource
{
    protected static ?string $model = MultipleChoiceQuestion::class;

    protected static ?string $navigationGroup = 'Questions';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('points')
                    ->minValue(1)
                    ->maxValue(10)
                    ->required()
                    ->numeric(),
                Forms\Components\Select::make('question_category_id')
                    ->createOptionForm(QuestionCategory::getForm())
                    ->editOptionForm(QuestionCategory::getForm())
                    ->native(false)
                    ->relationship('questionCategory', 'name')
                    ->required(),
                Forms\Components\RichEditor::make('text')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\Repeater::make('images')
                    ->itemLabel(fn(array $state): ?string => $state['alt'] ?? "New image")
                    ->relationship()
                    ->schema(Image::getForm())
                    ->collapsed()
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('points')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('type')
                    ->searchable(),
                Tables\Columns\TextColumn::make('questionCategory.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMultipleChoiceQuestions::route('/'),
            'create' => Pages\CreateMultipleChoiceQuestion::route('/create'),
            'edit' => Pages\EditMultipleChoiceQuestion::route('/{record}/edit'),
        ];
    }
}
