<?php

namespace App\Filament\Resources;

use App\Enums\QuestionType;
use App\Filament\Resources\FreeNumericQuestionResource\Pages;
use App\Filament\Resources\FreeNumericQuestionResource\RelationManagers;
use App\Models\FreeNumericQuestion;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FreeNumericQuestionResource extends Resource
{
    protected static ?string $model = FreeNumericQuestion::class;

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
                    ->native(false)
                    ->relationship('questionCategory', 'name')
                    ->required(),
                Forms\Components\RichEditor::make('text')
                    ->required()
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
            'index' => Pages\ListFreeNumericQuestions::route('/'),
            'create' => Pages\CreateFreeNumericQuestion::route('/create'),
            'edit' => Pages\EditFreeNumericQuestion::route('/{record}/edit'),
        ];
    }
}
