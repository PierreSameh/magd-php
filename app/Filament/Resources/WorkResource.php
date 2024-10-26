<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WorkResource\Pages;
use App\Filament\Resources\WorkResource\RelationManagers;
use App\Models\Work;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\FontWeight;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\KeyValue;

class WorkResource extends Resource
{
    protected static ?string $model = Work::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';

    protected static ?string $navigationLabel = 'Our Work';



    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required(),
                Forms\Components\FileUpload::make('image')
                    ->image()
                    ->disk('public')
                    ->directory('work')
                    ->required(),
                Forms\Components\Textarea::make('description')
                    ->required()
                    ->columnSpanFull(),
                KeyValue::make('data')
                    ->columnSpanFull()
                    ->label('More Details')
                    ->helperText('Add location, sector and client in this field.')
                    ->addButtonLabel('Add More'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\Layout\Grid::make()
                ->columns(1)
                ->schema([
                    Tables\Columns\Layout\Stack::make([
                        Tables\Columns\ImageColumn::make('image')
                            ->height(120)
                            ->width(180)
                            ->extraImgAttributes([
                                'class' => 'rounded-md',
                            ]),
                        Tables\Columns\TextColumn::make('title')
                            ->weight(FontWeight::Medium)
                            ->searchable(),
                        Tables\Columns\TextColumn::make('created_at')
                            ->dateTime()
                            ->sortable(),
                    ])->extraAttributes(['class' => 'space-y-2'])
                ])
            ])
            ->contentGrid([
                'md' => 2,
                "xl" => 3
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListWorks::route('/'),
            'create' => Pages\CreateWork::route('/create'),
            'view' => Pages\ViewWork::route('/{record}'),
            'edit' => Pages\EditWork::route('/{record}/edit'),
        ];
    }
}
