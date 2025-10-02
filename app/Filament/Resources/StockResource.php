<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StockResource\Pages;
use App\Models\Stock;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Filters;
use Illuminate\Database\Eloquent\Builder;

class StockResource extends Resource
{
    protected static ?string $model = Stock::class;

    protected static ?string $navigationIcon = 'heroicon-o-cube';

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

                TextInput::make('onHand')
                    ->numeric()
                    ->required()
                    ->label('Current Stock'),

                TextInput::make('current_stock')
                    ->numeric()
                    ->required()
                    ->label('Initial On Hand'),


                TextInput::make('price')
                    ->numeric()
                    ->prefix('Rp')
                    ->required()
                    ->label('Price'),

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

                Tables\Columns\TextColumn::make('current_stock')
                    ->label('Initial On Hand')
                    ->sortable(),

                Tables\Columns\TextColumn::make('onHand')
                    ->label('Current Stock')                  
                    ->sortable(),
               
                Tables\Columns\TextColumn::make('price')
                    ->money('IDR')
                    ->sortable(),

                Tables\Columns\TextColumn::make('transaction_date')
                    ->date('d M Y')
                    ->sortable(),
            ])
            ->filters([
                Filters\SelectFilter::make('product')
                    ->relationship('product', 'name'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStocks::route('/'),
            'create' => Pages\CreateStock::route('/create'),
            'edit' => Pages\EditStock::route('/{record}/edit'),
        ];
    }
}
