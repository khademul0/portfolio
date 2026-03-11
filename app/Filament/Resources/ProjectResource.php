<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Filament\Resources\ProjectResource\RelationManagers;
use App\Models\Project;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;
    protected static ?string $recordTitleAttribute = 'title';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('project_category_id')
                    ->relationship('category', 'name')
                    ->required(),
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('slug')
                    ->maxLength(255)
                    ->helperText('Leave empty to auto-generate from title.'),
                Forms\Components\TextInput::make('excerpt')
                    ->maxLength(255),
                Forms\Components\Textarea::make('description')
                    ->columnSpanFull(),
                Forms\Components\FileUpload::make('cover_image')
                    ->image()
                    ->directory('projects/covers'),
                Forms\Components\FileUpload::make('gallery_images')
                    ->multiple()
                    ->image()
                    ->directory('projects/gallery'),
                Forms\Components\TagsInput::make('tech_stack')
                    ->separator(','),
                Forms\Components\TextInput::make('live_url')
                    ->url()
                    ->maxLength(255),
                Forms\Components\TextInput::make('github_url')
                    ->url()
                    ->maxLength(255),
                Forms\Components\Toggle::make('is_featured')
                    ->default(false),
                Forms\Components\Toggle::make('is_published')
                    ->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('project_category_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('title'),

                Tables\Columns\TextColumn::make('slug'),

                Tables\Columns\TextColumn::make('excerpt'),

                Tables\Columns\ImageColumn::make('cover_image'),
                Tables\Columns\TextColumn::make('live_url'),

                Tables\Columns\TextColumn::make('github_url'),

                Tables\Columns\IconColumn::make('is_featured')
                    ->boolean(),
                Tables\Columns\IconColumn::make('is_published')
                    ->boolean(),
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
                Tables\Actions\Action::make('delete')
                ->label('Delete')
                ->color('danger')
                ->icon('heroicon-o-trash')
                ->action(function ($record, $livewire) {
                    $record->delete();
                    $livewire->redirect(request()->header('Referer') ?: url()->current());
                }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\BulkAction::make('delete')
                    ->label('Delete Selected')
                    ->color('danger')
                    ->icon('heroicon-o-trash')
                    ->action(function ($records, $livewire) {
                    $records->each->delete();
                    $livewire->redirect(request()->header('Referer') ?: url()->current());
                }),
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
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
        ];
    }
}
