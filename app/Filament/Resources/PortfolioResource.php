<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PortfolioResource\Pages;
use App\Models\Portfolio;
use Filament\Forms;
use Filament\Forms\Form;
use AmidEsfahani\FilamentTinyEditor\TinyEditor;
use App\Filament\Resources\PortfolioResource\RelationManagers;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PortfolioResource extends Resource
{
    protected static ?string $model = Portfolio::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Content';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Basic Info')->schema([
                    Forms\Components\TextInput::make('company_name')->required()->maxLength(255),
                    Forms\Components\TextInput::make('project_name')->required()->maxLength(255),
                    Forms\Components\FileUpload::make('main_picture')
                        ->image()
                        ->directory('portfolios')
                        ->columnSpanFull(),
                    Forms\Components\TextInput::make('duration')->maxLength(255),
                    Forms\Components\TextInput::make('scope')->maxLength(255),
                    Forms\Components\TextInput::make('team_size')->numeric(),
                ])->columns(2),

                Forms\Components\Section::make('Case Study')->schema([
                    TinyEditor::make('challenge')->profile('default')->columnSpanFull()->label('The Challenge'),
                    TinyEditor::make('solution')->profile('default')->columnSpanFull()->label('The Solution'),
                    TinyEditor::make('result')->profile('default')->columnSpanFull()->label('The Result'),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('main_picture'),
                Tables\Columns\TextColumn::make('company_name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('project_name')->searchable(),
                Tables\Columns\TextColumn::make('duration'),
                Tables\Columns\TextColumn::make('team_size')->numeric()->sortable(),
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
            RelationManagers\ImagesRelationManager::class,
            RelationManagers\EngagementsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPortfolios::route('/'),
            'create' => Pages\CreatePortfolio::route('/create'),
            'edit' => Pages\EditPortfolio::route('/{record}/edit'),
        ];
    }
}
