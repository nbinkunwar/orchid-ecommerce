<?php

namespace App\Orchid\Layouts\Products;

use App\Models\Product;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class ProductListLayout extends Table
{
     /**
     * Data source.
     *
     * @var string
     */
    public $target = 'products';

    /**
     * @return TD[]
     */
    public function columns(): array
    {
        return [
            TD::make('name', 'Title')
                ->render(function (Product $product) {
                    return Link::make($product->title)
                        ->route('platform.product.edit', $product);
                }),

            TD::make('created_at', 'Created'),
            TD::make('updated_at', 'Last edit'),
        ];
    }
}
