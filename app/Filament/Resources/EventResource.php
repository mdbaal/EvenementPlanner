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
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
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
