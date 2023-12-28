<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExamTemplateResource\Pages;
use App\Filament\Resources\ExamTemplateResource\RelationManagers;
use App\Models\ExamTemplate;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ExamTemplateResource extends Resource
{
    protected static ?string $model = ExamTemplate::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('durationInMinutes')
                    ->required()
                    ->numeric(),
                Forms\Components\Repeater::make('moduleTemplates')
                    ->relationship()
                    ->columnSpan(2)
                    ->columns(2)
                    ->collapsed()
                    ->itemLabel(fn(array $state): ?string => $state['name'] ?? "New module template")
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('durationInMinutes')
                            ->required()
                            ->numeric(),
                        Forms\Components\Repeater::make('questionGroupTemplates')
                            ->relationship()
                            ->collapsed()
                            ->columnSpan(2)
                            ->itemLabel(fn(array $state): ?string => $state['name'] ?? "New question group")
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->required()
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('numberOfQuestions')
                                    ->required()
                                    ->numeric(),
                                Forms\Components\TextInput::make('pointsFrom')
                                    ->required()
                                    ->numeric(),
                                Forms\Components\TextInput::make('pointsTo')
                                    ->required()
                                    ->numeric(),
                                Forms\Components\Select::make('question_category_id')
                                    ->relationship('questionCategory', 'name')
                                    ->required(),
                            ])
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('durationInMinutes')
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
            'index' => Pages\ListExamTemplates::route('/'),
            'create' => Pages\CreateExamTemplate::route('/create'),
            'edit' => Pages\EditExamTemplate::route('/{record}/edit'),
        ];
    }
}
