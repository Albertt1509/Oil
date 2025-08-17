<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Validation\Rule;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Text;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Illuminate\Support\Str;
use Filament\Forms\Set;
use Filament\Tables\Columns;
use Filament\Tables\Filters;


class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make()->schema([
                    Section::make('Product Info')->schema([
                        TextInput::make('name')
                            ->label('Name Product')
                            ->required()
                            ->live(onBlur: true)
                            ->maxLength(255)
                            ->afterStateUpdated(function ($state, Set $set) {
                                $set('slug', Str::slug($state));
                            }),

                        TextInput::make('slug')
                            ->required()
                            ->maxLength(255)
                            ->disabled()
                            ->dehydrated()
                            ->rule(['required', Rule::unique(Product::class, 'slug')->ignore(fn ($record) => $record)]),

                        TextInput::make('price')
                            ->numeric()
                            ->required()
                            ->prefix('IDR')
                            ->columnSpan(1),
                            
                        Select::make('category_id')
                            ->label('Category')
                            ->required()
                            ->searchable()
                            ->preload()
                            ->relationship('category', 'name'),

                        Select::make('brand_id')
                            ->label('Brand')
                            ->required()
                            ->searchable()
                            ->preload()
                            ->relationship('brand', 'name'),

                        MarkdownEditor::make('description')
                            ->label('Description')
                            ->columnSpanFull()
                            ->fileAttachmentsDirectory('products'),
                    ])->columns(2),

                    Section::make('Status Product')->schema([
                        Toggle::make('in_stock')
                            ->required()
                            ->default(true)
                            ->inline(false),

                        Toggle::make('is_active')
                            ->required()
                            ->default(true)
                            ->inline(false),

                        Toggle::make('is_futured')
                            ->required()
                            ->inline(false),

                        Toggle::make('on_sale')
                            ->required()
                            ->inline(false),
                    ])->columns(4),

                    Section::make('Images Product')->schema([
                        FileUpload::make('images')
                            ->multiple()
                            ->directory('Product')
                            ->maxFiles(5)
                            ->reorderable()
                    ]),
                ])->columnSpan(4),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                ->searchable(),
                Tables\Columns\TextColumn::make('category.name')
                ->searchable(),
                Tables\Columns\TextColumn::make('brand.name')
                ->searchable(),
                Tables\Columns\TextColumn::make('price')
                ->money('Rp.')
                ->sortable(),
                Tables\Columns\IconColumn::make('is_active')
                ->boolean(),
                Tables\Columns\IconColumn::make('in_stock')
                ->boolean(),
                Tables\Columns\IconColumn::make('is_featured')
                ->boolean(),
                Tables\Columns\IconColumn::make('on_sale')
                ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                ->dateTime()
                ->sortable()
                ->toggleable(true),
                Tables\Columns\TextColumn::make('updated_at')
                ->dateTime()
                ->sortable()
                ->toggleable(true), 

            ])
            ->filters([
                Filters\SelectFilter::make('category')
                ->relationship('category', 'name'),

                Filters\SelectFilter::make('brand')
                ->relationship('brand', 'name'),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                ])
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            // Tambahkan relasi yang dibutuhkan
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
