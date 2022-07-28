<?php

namespace App\Filament\Resources\FormationsResource\RelationManagers;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Card;
class EvaluationsRelationManager extends RelationManager
{
    protected static string $relationship = 'evaluations';

    protected static ?string $recordTitleAttribute = 'Formation_id';

    public static function form(Form $form): Form
    {
        return $form
        ->schema(Card::make()->columns(1)->schema([
           
            
            Forms\Components\RichEditor::make('remarque_formation')->required(),
            Forms\Components\TextInput::make('note_formation')->required(),
            Forms\Components\RichEditor::make('remarque_formateur')->required(),
            Forms\Components\TextInput::make('note_formateur')->required(),
            Forms\Components\RichEditor::make('remarque_participant')->required(),
            Forms\Components\TextInput::make('note_participant')->required(),
            Forms\Components\Toggle::make('is_evaluate')->required(),
    
            
        ]));
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                tables\Columns\TextColumn::make('formations_id')->sortable()->searchable(),
                
                tables\Columns\TextColumn::make('note_formation')->sortable()->searchable(),
                
                tables\Columns\TextColumn::make('note_formateur')->sortable()->searchable(),
                
                tables\Columns\TextColumn::make('note_participant')->sortable()->searchable(),
                tables\Columns\BooleanColumn::make('is_evaluate')->sortable()->searchable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\viewAction::make(),
                
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }    
}
