<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RemaininStockResource\Pages;
use App\Filament\Resources\RemaininStockResource\RelationManagers;
use App\Models\RemaininStock;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Filters;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RemaininStockResource extends Resource
{
    protected static ?string $model = RemaininStock::class;

    protected static ?string $navigationIcon = 'heroicon-o-archive-box';

    public static function form(Form $form): Form
     {
        return $form
            ->schema([
                Select::make('product_id')
                    ->required()
                    ->searchable()
                    ->preload()
                    ->label('Product')
                    ->relationship('product', 'name'),

                Select::make('category_id')
                    ->label('Category')
                    ->required()
                    ->searchable()
                    ->preload()
                    ->relationship('category', 'name'),

                TextInput::make('sale')
                    ->numeric()
                    ->required()
                    ->label('Sale'),

                TextInput::make('stock')
                    ->numeric()
                    ->required()
                    ->label('Stock'),

                DatePicker::make('transaction_date')
                    ->label('Transaction Date')
                    ->default(now())
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                 Tables\Columns\TextColumn::make('product.name')
                    ->label('Product')
                    ->searchable(),
                    
                Tables\Columns\TextColumn::make('category.name')
                    ->label('Category')
                    ->searchable(),

                Tables\Columns\TextColumn::make('sale')
                    ->label('Sale')
                    ->sortable(),

                Tables\Columns\TextColumn::make('stock')
                    ->label('Stock')
                    ->sortable(),

                Tables\Columns\TextColumn::make('transaction_date')
                    ->date('d M Y')
                    ->sortable(),

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
            'index' => Pages\ListRemaininStocks::route('/'),
            'create' => Pages\CreateRemaininStock::route('/create'),
            'edit' => Pages\EditRemaininStock::route('/{record}/edit'),
        ];
    }
}
