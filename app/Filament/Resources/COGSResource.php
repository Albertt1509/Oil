<?php

namespace App\Filament\Resources;

use App\Filament\Resources\COGSResource\Pages;
use App\Models\COGS;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\Select;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Filters;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use pxlrbt\FilamentExcel\Actions\Tables\ExportAction; 

class COGSResource extends Resource
{
    protected static ?string $model = COGS::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Select::make('product_id')
                ->relationship('product', 'name')
                ->required()
                ->searchable()
                ->preload()
                ->label('Product'),

            Forms\Components\TextInput::make('purchase_price')
                ->label('Purchase Price')
                ->numeric()
                ->prefix('Rp')
                ->required()
                ->reactive(),

            Forms\Components\TextInput::make('selling_price')
                ->label('Selling Price')
                ->numeric()
                ->prefix('Rp')
                ->required()
                ->reactive(),

            Forms\Components\TextInput::make('quantity_sold')
                ->label('Quantity Sold')
                ->numeric()
                ->required()
                ->reactive(),

            Forms\Components\DatePicker::make('transaction_date')
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
                ->label('Product'),

            Tables\Columns\TextColumn::make('purchase_price')
                ->label('Purchase Price')
                ->money('IDR'),

            Tables\Columns\TextColumn::make('selling_price')
                ->label('Selling Price')
                ->money('IDR'),

            Tables\Columns\TextColumn::make('quantity_sold')
                ->label('Quantity Sold'),

            Tables\Columns\TextColumn::make('total_selling')
                ->label('Total Selling')
                ->money('IDR')
                ->getStateUsing(fn($record) => $record->selling_price * $record->quantity_sold),

            Tables\Columns\TextColumn::make('total_selling')
                ->label('Total Selling')
                ->money('IDR')
                ->summarize([
                    Tables\Columns\Summarizers\Sum::make()
                        ->label('Grand Total Selling'),
                ]),

            Tables\Columns\TextColumn::make('profit_per_unit')
                ->label('Profit / Unit')
                ->money('IDR'),

            Tables\Columns\TextColumn::make('total_profit')
                ->label('Total Profit')
                ->money('IDR')
                ->summarize([
                    Tables\Columns\Summarizers\Sum::make()
                        ->label('Grand Total Profit'),
                ]),

            Tables\Columns\TextColumn::make('transaction_date')
                ->label('Transaction Date')
                ->date(),
        ])
        ->filters([
            Filters\SelectFilter::make('month')
                ->label('Filter by Month')
                ->options(function () {
                    return \App\Models\COGS::query()
                        ->selectRaw("DATE_FORMAT(transaction_date, '%Y-%m') as ym, DATE_FORMAT(transaction_date, '%M %Y') as label")
                        ->distinct()
                        ->orderBy('ym', 'desc')
                        ->pluck('label', 'ym')
                        ->toArray();
                })
                ->query(function (Builder $query, array $state) {
                    if (!empty($state['value'])) {
                        [$year, $month] = explode('-', $state['value']);
                        $query->whereYear('transaction_date', $year)
                              ->whereMonth('transaction_date', $month);
                    }
                }),
        ])
        ->actions([
            Tables\Actions\ViewAction::make(),
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
        ])
        ->bulkActions([
            ExportBulkAction::make() 
        ])
->headerActions([
    ExportAction::make('export_all')
        ->label('Export All Data')
        // ->withFilename('cogs-data-' . now()->format('Y-m-d')) // ✅ pakai withFilename
        // ->defaultFormat('xlsx') // bisa 'xlsx', 'csv', 'ods'
        // ->formats(['xlsx', 'csv']), // user bisa pilih format
]);

}


    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCOGS::route('/'),
            'create' => Pages\CreateCOGS::route('/create'),
            'edit' => Pages\EditCOGS::route('/{record}/edit'),
        ];
    }
}
