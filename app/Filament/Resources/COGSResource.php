<?php

namespace App\Filament\Resources;

use App\Filament\Resources\COGSResource\Pages;
use App\Models\COGS;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Filters;
use App\Exports\CogsExport;
use Filament\Tables\Actions\Action;
class COGSResource extends Resource
{
    protected static ?string $model = COGS::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form->schema([]);
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

                Tables\Columns\TextColumn::make('quantity_sold')
                    ->label('Quantity Sold'),

                Tables\Columns\TextColumn::make('total_cost')
                    ->label('Total Cost')
                    ->money('IDR'),

                Tables\Columns\TextColumn::make('hpp')
                    ->label('COGS Seliing Product')
                    ->money('IDR')
                    ->getStateUsing(fn($record) => $record->quantity_sold * $record->purchase_price),

                Tables\Columns\TextColumn::make('hpp_total')
                    ->label('Monthly COGS')
                    ->money('IDR')
                    ->getStateUsing(function () {
                        $month = now()->month;
                        $year  = now()->year;

                        $hppData = \App\Services\HppService::hitungHpp($year, $month);

                        return $hppData['hpp'];
                    }),

                Tables\Columns\TextColumn::make('transaction_date')
                    ->label('Date Transaction')

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
//            ->actions([
//     Action::make('Export')
//         ->label('Export to Excel')
//         ->icon('heroicon-o-download')
//         ->action(function () {
//             return Excel::download(new CogsExport(), 'cogs.xlsx');
//         }),
// ])
        ->bulkActions([]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCOGS::route('/'),
        ];
    }
}
