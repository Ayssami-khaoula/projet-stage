<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FormationsResource\Pages;
use App\Filament\Resources\FormationsResource\RelationManagers;
use App\Filament\Resources\FormationsResource\RelationManagers\EvaluationsRelationManager;
use App\Filament\Resources\FormationsResource\RelationManagers\FormateursRelationManager;
use App\Filament\Widgets\StatsOverview;
use App\Models\Formations;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Forms\Components\Card;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Filters\Filter;
use pxlrbt\FilamentExcel\Actions\Pages\ExportBulkAction;

use Filament\Tables\Filters\SelectFilter;
use Filament\Widgets\BarChartWidget;
use Filament\Widgets\ChartWidget;
use Filament\Widgets\StatsOverviewWidget;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FormationsResource extends Resource
{
    protected static ?string $model = Formations::class;

    protected static ?string $recordTitleAttribute = 'nom';

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema(Card::make()->columns(1)->schema([
                Forms\Components\TextInput::make('intitulé')->required(),
                Forms\Components\TextInput::make('module')->default('NULL'),
                Forms\Components\Select::make('type')
    ->options([
        'ouverture' => 'Ouverture',
        'label ecole' => 'Label Ecole',
        'besoin formation' => 'Besoin Formation',
        'projet' => 'Projet',
        'compagne' => 'Compagne',
        'cdci' => 'CDCI',
        'nouvelle recrue' => 'Nouvelle recrue',
    ])->required(),
                Forms\Components\Select::make('formateurs_id')->relationship('Formateurs','nom'),
                Forms\Components\Select::make('application_id')->relationship('Application','nom'),
                Forms\Components\TextInput::make('population')->default('NULL'),
                Forms\Components\TextInput::make('nombre_participants')->default('NULL'),
                Forms\Components\TextInput::make('lieu')->default('NULL'),
                Forms\Components\TextInput::make('durée')->default('NULL'),
                Forms\Components\DateTimePicker::make('date_début')->withoutSeconds()->default(' .'),
                Forms\Components\DateTimePicker::make('date_fin')->withoutSeconds()->default(' .'),
                Forms\Components\Toggle::make('date_valide')->required(),
                Forms\Components\TextInput::make('entité')->default('NULL'),
                Forms\Components\Radio::make('etat')
    ->options([
        'proposition envoyée au formateur' => 'Proposition envoyée au formateur',
        ' validée par formateur' => ' Validée par formateur',
        'proposée au population destinée' => 'Proposée au population destinée',
        'valide par cible ' => 'Valide par cible ',
        'realisée ' => 'Realisée',
        'reportée' => 'Reportée ',
        'en cours' => 'En cours ',
        'non planifiée' => 'Non planifiée ',
        'annulée' => 'Annulée ',
    ]),
                Forms\Components\RichEditor::make('description')->default('...'),
                
            ]));
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                tables\Columns\TextColumn::make('intitulé')->sortable()->searchable(),
                tables\Columns\TextColumn::make('module')->sortable()->searchable(),
                tables\Columns\TextColumn::make('type')->sortable(),
                tables\Columns\TextColumn::make('formateurs_id')->sortable(),
                tables\Columns\TextColumn::make('application_id')->sortable(),
                tables\Columns\TextColumn::make('population')->sortable()->searchable(),
                tables\Columns\TextColumn::make('nombre_participants')->sortable()->searchable(),
                tables\Columns\TextColumn::make('lieu')->sortable()->searchable(),
                tables\Columns\TextColumn::make('durée')->sortable()->searchable(),
                tables\Columns\TextColumn::make('date_début')->sortable()->searchable(),
                tables\Columns\TextColumn::make('date_fin')->sortable(),
                tables\Columns\BooleanColumn::make('date_valide')->sortable(),
                tables\Columns\TextColumn::make('entité')->sortable()->searchable(),
                tables\Columns\BadgeColumn::make('etat')
                ->enum([
                    'proposition envoyée au formateur' => 'Proposition envoyée au formateur',
                    ' validée par formateur' => ' Validée par formateur',
               'proposée au population destinée' => 'Proposée au population destinée',
                'valide par cible ' => 'Valide par cible ',
                 'realisée ' => 'Realisée',
                  'reportée' => 'Reportée ',
                    'en cours' => 'En cours ',
                 'non planifiée' => 'Non planifiée ',
                      'annulée' => 'Annulée ',
                ])
                ->colors([
                  
                    'warning' => 'en cours',
                    'success' =>  'realisée ',
                    'danger' => 'annulée',

                ]) 
              
                ->icons([
                    
                    'heroicon-o-document' => 'annulée',
                    'heroicon-o-refresh' => 'en cours',
                    'heroicon-o-truck' => 'realisée ',
                ]),
               
                
                tables\Columns\TextColumn::make('description')->html()->sortable(),
            ])
            ->bulkActions([
                //ExportBulkAction::make()
            ])

            ->filters([
                
                SelectFilter::make('type')
                ->options([
                    'ouverture' => 'Ouverture',
                    'label ecole' => 'Label Ecole',
                    'besoin formation' => 'Besoin Formation',
                    'projet' => 'Projet',
                    'compagne' => 'Compagne',
                    'cdci' => 'CDCI',
                    'nouvelle recrue' => 'Nouvelle recrue',
                ]),
                SelectFilter::make('etat')
                ->options([
                    'proposition envoyée au formateur' => 'Proposition envoyée au formateur',
        ' validée par formateur' => ' Validée par formateur',
        'proposée au population destinée' => 'Proposée au population destinée',
        'valide par cible ' => 'Valide par cible ',
        'realisée ' => 'Realisée',
        'reportée' => 'Reportée ',
        'en cours' => 'En cours ',
        'non planifiée' => 'Non planifiée ',
        'annulée' => 'Annulée ',
                ]),
                SelectFilter::make('formateurs')->relationship('formateurs', 'nom'),
                SelectFilter::make('application')->relationship('application', 'nom')

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
            EvaluationsRelationManager::class,
            FormateursRelationManager::class
        ];
    }
    
    public static function getWidgets():array
    {
        return [
            StatsOverview::class,
        ];
    }
    
    

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFormations::route('/'),
            'create' => Pages\CreateFormations::route('/create'),
            'edit' => Pages\EditFormations::route('/{record}/edit'),
        ];
    }    
}
