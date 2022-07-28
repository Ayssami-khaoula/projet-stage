<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EvaluationsResource\Pages;
use App\Filament\Resources\EvaluationsResource\RelationManagers;
use App\Models\Evaluations;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Forms\Components\Card;
use Filament\Tables;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EvaluationsResource extends Resource
{
    protected static ?string $model = Evaluations::class;

    protected static ?string $navigationIcon = 'heroicon-o-badge-check';

    public static function form(Form $form): Form
    {
        return $form
        ->schema(Card::make()->columns(1)->schema([
           
            Forms\Components\Select::make('formations_id')
            ->relationship('formations', 'intitulé')->unique(),
            Forms\Components\RichEditor::make('remarque_formation')->default('...'),
            Forms\Components\Select::make('note_formation')
            ->options([
                '0' => '0',
                '1' => '1',
                '2' => '2',
                '3' => '3',
                '4' => '4',
                '5' => '5',
                
            ])->required(),
            Forms\Components\RichEditor::make('remarque_formateur')->default('...'),
            Forms\Components\Select::make('note_formateur')
            ->options([
                '0' => '0',
                '1' => '1',
                '2' => '2',
                '3' => '3',
                '4' => '4',
                '5' => '5',
                
            ])->required(),
            Forms\Components\RichEditor::make('remarque_participant')->default('...'),
            Forms\Components\Select::make('note_participant')
            ->options([
                '0' => '0',
                '1' => '1',
                '2' => '2',
                '3' => '3',
                '4' => '4',
                '5' => '5',
                
            ])->required(),
           
            Forms\Components\Toggle::make('is_evaluate')->required(),
    
            
        ]));
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                tables\Columns\TextColumn::make('formations_id')->sortable(),
                tables\Columns\TextColumn::make('remarque_formation')->html()->sortable(),
                tables\Columns\TextColumn::make('note_formation')->sortable()->searchable(),
                tables\Columns\TextColumn::make('remarque_formateur')->html()->sortable(),
                tables\Columns\TextColumn::make('note_formateur')->sortable()->searchable(),
                tables\Columns\TextColumn::make('remarque_participant')->html()->sortable(),
                tables\Columns\TextColumn::make('note_participant')->sortable()->searchable(),
              //  tables\Columns\TextColumn::make('moyenne')->sortable()->searchable(),
                tables\Columns\BooleanColumn::make('is_evaluate')->sortable(),
            ])
            ->filters([
                Filter::make('is_evaluate')
                ->query(fn (Builder $query): Builder => $query->where('is_evaluate', true)),
                Filter::make('non_evaluate')
                ->query(fn (Builder $query): Builder => $query->where('non_evaluate', false)),
                SelectFilter::make('formations')->relationship('formations', 'etat')
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListEvaluations::route('/'),
            'create' => Pages\CreateEvaluations::route('/create'),
            'edit' => Pages\EditEvaluations::route('/{record}/edit'),
        ];
    }    
}
