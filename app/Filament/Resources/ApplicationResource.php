<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ApplicationResource\Pages;
use App\Filament\Resources\ApplicationResource\RelationManagers;
use App\Models\Application;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Forms\Components\Card;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ApplicationResource extends Resource
{
    protected static ?string $model = Application::class;

    protected static ?string $navigationIcon = 'heroicon-o-folder';

    public static function form(Form $form): Form
    {
        return $form
        ->schema(Card::make()->columns(1)->schema([
           
            Forms\Components\TextInput::make('nom')->required(),
            Forms\Components\TextInput::make('type')->required(),
            Forms\Components\RichEditor::make('principe')->default('...'),
            Forms\Components\TextInput::make('lien')->default('NULL'),
            Forms\Components\TextInput::make('prestataire')->default('NULL'),
            Forms\Components\RichEditor::make('formateurs')->default('...'),
            
            
           
            
        ]));
        
       
    }

    
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                tables\Columns\TextColumn::make('nom')->sortable()->searchable(),
                
                tables\Columns\TextColumn::make('type')->sortable()->searchable(),
                tables\Columns\TextColumn::make('principe')->sortable()->searchable(),
                tables\Columns\TextColumn::make('lien')->sortable()->searchable(), 
                tables\Columns\TextColumn::make('prestataire')->sortable()->searchable(),
                tables\Columns\TextColumn::make('formateurs')->sortable()->searchable(),
                
                

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListApplications::route('/'),
            'create' => Pages\CreateApplication::route('/create'),
            'edit' => Pages\EditApplication::route('/{record}/edit'),
        ];
    }    
}
