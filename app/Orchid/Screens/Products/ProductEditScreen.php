<?php

namespace App\Orchid\Screens\Products;

use App\Models\Product;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Http\Client\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\Relation as FieldsRelation;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

class ProductEditScreen extends Screen
{
     /**
     * @var Post
     */
    public $product;

    /**
     * Query data.
     *
     * @param Post $product
     *
     * @return array
     */
    public function query(Product $product): array
    {
        return [
            'product' => $product
        ];
    }

    /**
     * The name is displayed on the user's screen and in the headers
     */
    public function name(): ?string
    {
        return $this->product->exists ? 'Edit product' : 'Creating a new product';
    }
    
    /**
     * The description is displayed on the user's screen under the heading
     */
    public function description(): ?string
    {
        return "Product Products";
    }

    /**
     * Button commands.
     *
     * @return Link[]
     */
    public function commandBar(): array
    {
        return [
            Button::make('Create product')
                ->icon('pencil')
                ->method('createOrUpdate')
                ->canSee(!$this->product->exists),

            Button::make('Update')
                ->icon('note')
                ->method('createOrUpdate')
                ->canSee($this->product->exists),

            Button::make('Remove')
                ->icon('trash')
                ->method('remove')
                ->canSee($this->product->exists),
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
                Input::make('product.name')
                    ->title('Title')
                    ->placeholder('Product Title')
                    ->help('Specify a short descriptive title for this product.'),

                TextArea::make('product.description')
                    ->title('Description')
                    ->rows(3)
                    ->maxlength(200)
                    ->placeholder('Brief description for preview'),
                Select::make('product.product_type')
                ->title('Product Type')
                ->options([
                    'simple'=>'Simple',
                    'bundle'=>'Bundled'
                ]),

                Select::make('product.attributes')
                ->title('Product Sizes')
                ->options([
                    's'=>'S',
                    'l'=>'L',
                    'xl'=>'XL',
                    '2xl'=>'2XL'
                ])->multiple(),

                FieldsRelation::make('product.bundles')
                ->fromModel(Product::class,'name')
                ->multiple()->title('Choose Products To Bundle')->canSee($this->product->product_type=='bundle'),

                Input::make('product.price')
                ->title('Price')
                ->type('number'),

                Input::make('product.special_price')
                ->title('Discounted Price')
                ->type('number'),

                Quill::make('product.body')
                    ->title('Main text'),

            ])
        ];
    }

    /**
     * @param Post    $product
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createOrUpdate(Product $product, Request $request)
    {
        $product->fill($request->get('product'))->save();

        Alert::info('You have successfully created an product.');

        return redirect()->route('platform.product.list');
    }

    /**
     * @param Post $product
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function remove(Product $product)
    {
        $product->delete();

        Alert::info('You have successfully deleted the product.');

        return redirect()->route('platform.product.list');
    }
}
