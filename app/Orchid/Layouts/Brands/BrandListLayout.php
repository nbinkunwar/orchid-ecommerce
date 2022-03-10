<?php

namespace App\Orchid\Layouts\Brands;

use App\Models\Brand;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class BrandListLayout extends Table
{
     /**
     * Data source.
     *
     * @var string
     */
    public $target = 'brands';

    /**
     * @return TD[]
     */
    public function columns(): array
    {
        return [
            TD::make('name', 'Title')
                ->render(function (Brand $brand) {
                    return Link::make($brand->title)
                        ->route('platform.brand.edit', $brand);
                }),

            TD::make('created_at', 'Created'),
            TD::make('updated_at', 'Last edit'),
        ];
    }
}
