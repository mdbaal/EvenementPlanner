<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EventResource\Pages;
use App\Filament\Resources\EventResource\RelationManagers;
use App\Models\Event;
use Filament\Forms;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EventResource extends Resource
{
    protected static ?string $model = Event::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
               TextInput::make("title")
                    ->maxLength(200)
                    ->required(),
                Textarea::make("excerpt")
                    ->maxLength(500)
                    ->required(),
                Textarea::make('description')
                    ->required(),
                FileUpload::make('image_url')
                    ->required()
                    ->image()
                    ->directory("event-images")
                    ->visibility('private'),
                DateTimePicker::make('event_start')
                    ->required()
                    ->format('d/m/Y')
                    ->displayFormat('d/m/Y H-i')
                    ->seconds(false)
                    ->weekStartsOnMonday()
                    ->closeOnDateSelection(),
                DateTimePicker::make('event_end')
                    ->format('d/m/Y')
                    ->displayFormat('d/m/Y H-i')
                    ->seconds(false)
                    ->weekStartsOnMonday()
                    ->closeOnDateSelection(),
                TextInput::make("location")
                    ->required()
                    ->maxLength(200),
                TextInput::make("entry_fee")
                    ->required()
                    ->numeric()
                    ->default(0),
                Hidden::make("company_id")
                    ->required()
                    ->default(auth()->user()->company_id), //TODO: Move this to resource create event to prevent altering company id
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make("title")->label("Titel")->searchable(),
                TextColumn::make("excerpt")->label("Samenvatting"),
                TextColumn::make("description")->label("Beschrijving"),
                ImageColumn::make("image_url")->label("Afbeelding"),
                TextColumn::make('event_start')->label("Start Datum")->searchable(),
                TextColumn::make('event_end')->label("Eind Datum")->searchable(),
                TextColumn::make('location')->label("Locatie")->searchable(),
                TextColumn::make('entry_fee')->label("Entree Prijs")->prefix("€"),
                TextColumn::make('registered_people')->label("Aantal Mensen"),
                TextColumn::make('company.name')->label("Georganisseerd Door"),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                    ->requiresConfirmation(),
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
            'index' => Pages\ListEvents::route('/'),
            'create' => Pages\CreateEvent::route('/create'),
            'edit' => Pages\EditEvent::route('/{record}/edit'),
        ];
    }
}
