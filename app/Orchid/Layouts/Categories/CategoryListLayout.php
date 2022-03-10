<?php

namespace App\Orchid\Layouts\Categories;

use App\Models\Category;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class CategoryListLayout extends Table
{
     /**
     * Data source.
     *
     * @var string
     */
    public $target = 'categories';

    /**
     * @return TD[]
     */
    public function columns(): array
    {
        return [
            TD::make('name', 'Title')
                ->render(function (Category $category) {
                    return Link::make($category->title)
                        ->route('platform.category.edit', $category);
                }),

            TD::make('created_at', 'Created'),
            TD::make('updated_at', 'Last edit'),
        ];
    }
}
