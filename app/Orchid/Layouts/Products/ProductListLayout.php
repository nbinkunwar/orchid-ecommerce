<?php

namespace App\Orchid\Layouts\Products;

use App\Models\Product;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Input;
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
            ->sort()
            ->filter(Input::make())
                ->render(function (Product $product) {
                    return Link::make($product->name)
                        ->route('platform.product.edit', $product);
                }),

            TD::make('price','Price')->filter(Input::make())->sort(),

            TD::make('product_type','Product Type')->filter(Input::make())->sort(),
            TD::make('status','Status')->filter(Input::make())->sort(),


            TD::make('created_at', 'Created')->sort(),
            TD::make('updated_at', 'Last edit')->sort(),
        ];
    }
}
