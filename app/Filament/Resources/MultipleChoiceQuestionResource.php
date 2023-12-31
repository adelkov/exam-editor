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
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;


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
                Forms\Components\Toggle::make('is_active')
                    ->required(),
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
                Tables\Columns\ToggleColumn::make('is_active')
                    ->toggleable()
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
                Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('created_from'),
                        Forms\Components\DatePicker::make('created_until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn(Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn(Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    }),
                Filter::make('points')
                    ->form([
                        Forms\Components\TextInput::make('points_from')->numeric(),
                        Forms\Components\TextInput::make('points_to')->numeric(),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['points_from'],
                                fn(Builder $query, $points): Builder => $query->where('points','>=' ,$points),
                            )
                            ->when(
                                $data['points_to'],
                                fn(Builder $query, $points): Builder => $query->where('points', '<=', $points),
                            );

                    }),
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Active')
                    ->native(false)
                    ->options([
                        'Yes' => true,
                        'No' => false,
                    ]),
            ], layout: Tables\Enums\FiltersLayout::AboveContent)
            ->actions([
                Tables\Actions\EditAction::make()->slideOver(),
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
