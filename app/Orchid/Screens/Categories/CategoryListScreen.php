<?php

namespace App\Orchid\Screens\Categories;

use App\Models\Category;
use App\Orchid\Layouts\Categories\CategoryListLayout;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class CategoryListScreen extends Screen
{
     /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'categories' => Category::paginate()
        ];
    }

    /**
     * The name is displayed on the user's screen and in the headers
     */
    public function name(): ?string
    {
        return 'Product category';
    }
    
    /**
     * The description is displayed on the user's screen under the heading
     */
    public function description(): ?string
    {
        return "All product categories";
    }

    /**
     * Button commands.
     *
     * @return Link[]
     */
    public function commandBar(): array
    {
        return [
            Link::make('Create new')
                ->icon('pencil')
                ->route('platform.category.edit')
        ];
    }

    /**
     * Views.
     *
     * @return Layout[]
     */
    public function layout(): array
    {
        return [
            CategoryListLayout::class
        ];
    }
}
