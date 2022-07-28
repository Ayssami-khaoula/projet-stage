<?php

namespace App\Filament\Resources\FormationsResource\RelationManagers;
use Filament\Forms\Components\Card;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FormateursRelationManager extends RelationManager
{
    protected static string $relationship = 'formateurs';

    protected static ?string $recordTitleAttribute = 'formations';

    public static function form(Form $form): Form
    {
        return $form
          
            ->schema(Card::make()->columns(1)->schema([
                Forms\Components\TextInput::make('formations')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('nom')->required(),
                
                Forms\Components\Select::make('type')
                 ->options([
                      'interne' => 'interne',
                      'externe' => 'externe',
      
                   ])->required(),
             
               
                
            ]));
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('formations'),
                tables\Columns\TextColumn::make('nom')->sortable()->searchable(),
                
                tables\Columns\TextColumn::make('type')->sortable()->searchable()

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
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }    
}
