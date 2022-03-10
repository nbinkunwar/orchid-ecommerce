<?php

namespace App\Orchid\Screens\Brands;

use App\Models\Brand;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Http\Client\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

class BrandEditScreen extends Screen
{
     /**
     * @var Post
     */
    public $brand;

    /**
     * Query data.
     *
     * @param Post $brand
     *
     * @return array
     */
    public function query(Brand $brand): array
    {
        return [
            'brand' => $brand
        ];
    }

    /**
     * The name is displayed on the user's screen and in the headers
     */
    public function name(): ?string
    {
        return $this->brand->exists ? 'Edit brand' : 'Creating a new brand';
    }
    
    /**
     * The description is displayed on the user's screen under the heading
     */
    public function description(): ?string
    {
        return "Product Brands";
    }

    /**
     * Button commands.
     *
     * @return Link[]
     */
    public function commandBar(): array
    {
        return [
            Button::make('Create brand')
                ->icon('pencil')
                ->method('createOrUpdate')
                ->canSee(!$this->brand->exists),

            Button::make('Update')
                ->icon('note')
                ->method('createOrUpdate')
                ->canSee($this->brand->exists),

            Button::make('Remove')
                ->icon('trash')
                ->method('remove')
                ->canSee($this->brand->exists),
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
            Layout::rows([
                Input::make('brand.name')
                    ->title('Title')
                    ->placeholder('Brand Title')
                    ->help('Specify a short descriptive title for this brand.'),

                TextArea::make('brand.description')
                    ->title('Description')
                    ->rows(3)
                    ->maxlength(200)
                    ->placeholder('Brief description for preview'),

                Quill::make('brand.body')
                    ->title('Main text'),

            ])
        ];
    }

    /**
     * @param Post    $brand
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createOrUpdate(Brand $brand, Request $request)
    {
        $brand->fill($request->get('brand'))->save();

        Alert::info('You have successfully created an brand.');

        return redirect()->route('platform.brand.list');
    }

    /**
     * @param Post $brand
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function remove(Brand $brand)
    {
        $brand->delete();

        Alert::info('You have successfully deleted the brand.');

        return redirect()->route('platform.brand.list');
    }
}
