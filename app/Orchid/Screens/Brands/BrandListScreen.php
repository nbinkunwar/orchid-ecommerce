<?php

namespace App\Orchid\Screens\Brands;

use App\Models\Brand;
use App\Orchid\Layouts\Brands\BrandListLayout;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class BrandListScreen extends Screen
{
     /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'brands' => Brand::paginate()
        ];
    }

    /**
     * The name is displayed on the user's screen and in the headers
     */
    public function name(): ?string
    {
        return 'Product brand';
    }
    
    /**
     * The description is displayed on the user's screen under the heading
     */
    public function description(): ?string
    {
        return "All product brands";
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
                ->route('platform.brand.edit')
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
            BrandListLayout::class
        ];
    }
}
