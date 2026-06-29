<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Filament\Resources\PostResource\RelationManagers;
use App\Models\Post;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\Builder;
use Filament\Forms\Components\Builder\Block;
use AmidEsfahani\FilamentTinyEditor\TinyEditor;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $modelLabel = 'Blog';
    protected static ?string $pluralModelLabel = 'Blogs';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->columnSpanFull()
                    ->maxLength(255),
                Forms\Components\Select::make('category_id')
                    ->relationship('category', 'name', fn ($query) => $query->where('type', 'post'))
                    ->label('Category')
                    ->searchable()
                    ->preload(),
                TinyEditor::make('description')
                    ->label('Description')
                    ->fileAttachmentsDisk('public')
                    ->fileAttachmentsVisibility('public')
                    ->fileAttachmentsDirectory('uploads')
                    ->profile('default')
                    ->columnSpanFull(),
                Forms\Components\FileUpload::make('image')
                    ->image(),
                Builder::make('content')
                    ->blocks([
                        Block::make('paragraph')
                            ->label('Paragraph')
                            ->icon('heroicon-m-bars-3-bottom-left')
                            ->schema([
                                Forms\Components\TextInput::make('topic')
                                    ->label('Topic'),
                                Forms\Components\TextInput::make('title')
                                    ->label('Title'),
                                TinyEditor::make('content')
                                    ->label('Content')
                                    ->fileAttachmentsDisk('public')
                                    ->fileAttachmentsVisibility('public')
                                    ->fileAttachmentsDirectory('uploads')
                                    ->profile('default')
                                    ->required(),
                            ]),
                        Block::make('image')
                            ->label('Image')
                            ->icon('heroicon-m-photo')
                            ->schema([
                                Forms\Components\FileUpload::make('image')
                                    ->label('Image Upload')
                                    ->image()
                                    ->required(),
                            ]),
                        Block::make('quote')
                            ->label('Quote')
                            ->icon('heroicon-m-chat-bubble-bottom-center-text')
                            ->schema([
                                TinyEditor::make('content')
                                    ->label('Quote Content')
                                    ->fileAttachmentsDisk('public')
                                    ->fileAttachmentsVisibility('public')
                                    ->fileAttachmentsDirectory('uploads')
                                    ->profile('default')
                                    ->required(),
                                Forms\Components\FileUpload::make('author_image')
                                    ->label('Author Image')
                                    ->avatar()
                                    ->image(),
                                Forms\Components\TextInput::make('author_name')
                                    ->label('Author Name'),
                                Forms\Components\TextInput::make('author_position')
                                    ->label('Author Position'),
                            ]),
                    ])
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('image'),
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
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
