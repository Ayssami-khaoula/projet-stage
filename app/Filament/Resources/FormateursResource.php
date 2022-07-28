<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FormateursResource\Pages;
use App\Filament\Resources\FormateursResource\RelationManagers;
use App\Models\Formateurs;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Forms\Components\Card;
use Filament\Widgets\Widget;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FormateursResource extends Resource
{
    protected static ?string $model = Formateurs::class;
    protected static ?string $recordTitleAttribute = 'nom';

    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function form(Form $form): Form
    {
        return $form
        ->schema(Card::make()->columns(1)->schema([
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
                tables\Columns\TextColumn::make('nom')->sortable()->searchable(),
                
                tables\Columns\TextColumn::make('type')->sortable()->searchable(),
            ])
            ->filters([
                SelectFilter::make('type')
                ->options([
                    'interne' => 'interne',
                    'externe' => 'externe',
                ]),
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
         
        ];
    }
   
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFormateurs::route('/'),
            'create' => Pages\CreateFormateurs::route('/create'),
            'edit' => Pages\EditFormateurs::route('/{record}/edit'),
        ];
    }    
}
