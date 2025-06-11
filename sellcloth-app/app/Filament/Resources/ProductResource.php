<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    protected static ?string $navigationLabel = 'Sản phẩm';

    protected static ?string $modelLabel = 'sản phẩm';

    protected static ?string $pluralModelLabel = 'sản phẩm';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Thông tin cơ bản')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Tên sản phẩm')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(
                                fn(string $context, $state, Forms\Set $set) =>
                                $context === 'create' ? $set('slug', \Illuminate\Support\Str::slug($state)) : null
                            ),
                        Forms\Components\TextInput::make('slug')
                            ->label('Slug (URL)')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),
                        Forms\Components\Select::make('category_id')
                            ->label('Danh mục')
                            ->relationship('category', 'name')
                            ->required()
                            ->searchable()
                            ->preload(),
                        Forms\Components\Textarea::make('description')
                            ->label('Mô tả sản phẩm')
                            ->columnSpanFull()
                            ->rows(3),
                    ])->columns(2),

                Forms\Components\Section::make('Giá và tồn kho')
                    ->schema([
                        Forms\Components\TextInput::make('price')
                            ->label('Giá gốc (VNĐ)')
                            ->required()
                            ->numeric()
                            ->prefix('₫')
                            ->step(1000),
                        Forms\Components\TextInput::make('sale_price')
                            ->label('Giá khuyến mãi (VNĐ)')
                            ->numeric()
                            ->prefix('₫')
                            ->step(1000),
                        Forms\Components\TextInput::make('stock_quantity')
                            ->label('Số lượng tồn kho')
                            ->required()
                            ->numeric()
                            ->default(0),
                    ])->columns(3),

                Forms\Components\Section::make('Thuộc tính sản phẩm')
                    ->schema([
                        Forms\Components\TagsInput::make('sizes')
                            ->label('Kích cỡ')
                            ->placeholder('S, M, L, XL...')
                            ->separator(','),
                        Forms\Components\TagsInput::make('colors')
                            ->label('Màu sắc')
                            ->placeholder('Đen, Trắng, Xám...')
                            ->separator(','),
                        Forms\Components\FileUpload::make('images')
                            ->label('Hình ảnh')
                            ->image()
                            ->multiple()
                            ->directory('products')
                            ->columnSpanFull(),
                    ])->columns(2),

                Forms\Components\Section::make('Trạng thái')
                    ->schema([
                        Forms\Components\Toggle::make('is_active')
                            ->label('Kích hoạt')
                            ->default(true),
                        Forms\Components\Toggle::make('is_featured')
                            ->label('Sản phẩm nổi bật')
                            ->default(false),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('images')
                    ->label('Hình ảnh')
                    ->circular()
                    ->stacked()
                    ->limit(3),
                Tables\Columns\TextColumn::make('name')
                    ->label('Tên sản phẩm')
                    ->searchable()
                    ->sortable()
                    ->weight(\Filament\Support\Enums\FontWeight::Medium),
                Tables\Columns\TextColumn::make('category.name')
                    ->label('Danh mục')
                    ->badge()
                    ->sortable(),
                Tables\Columns\TextColumn::make('price')
                    ->label('Giá gốc')
                    ->money('VND')
                    ->sortable(),
                Tables\Columns\TextColumn::make('sale_price')
                    ->label('Giá KM')
                    ->money('VND')
                    ->sortable()
                    ->placeholder('Không có'),
                Tables\Columns\TextColumn::make('stock_quantity')
                    ->label('Tồn kho')
                    ->numeric()
                    ->sortable()
                    ->badge()
                    ->color(fn(string $state): string => match (true) {
                        $state > 50 => 'success',
                        $state > 10 => 'warning',
                        default => 'danger',
                    }),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Kích hoạt')
                    ->boolean(),
                Tables\Columns\IconColumn::make('is_featured')
                    ->label('Nổi bật')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Ngày tạo')
                    ->dateTime('d/m/Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category')
                    ->label('Danh mục')
                    ->relationship('category', 'name'),
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Trạng thái')
                    ->boolean()
                    ->trueLabel('Đang kích hoạt')
                    ->falseLabel('Không kích hoạt'),
                Tables\Filters\TernaryFilter::make('is_featured')
                    ->label('Sản phẩm nổi bật')
                    ->boolean()
                    ->trueLabel('Nổi bật')
                    ->falseLabel('Thường'),
                Tables\Filters\Filter::make('low_stock')
                    ->label('Tồn kho thấp')
                    ->query(fn(Builder $query): Builder => $query->where('stock_quantity', '<=', 10)),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->label('Xem'),
                Tables\Actions\EditAction::make()
                    ->label('Sửa'),
                Tables\Actions\DeleteAction::make()
                    ->label('Xóa'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->label('Xóa được chọn'),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
