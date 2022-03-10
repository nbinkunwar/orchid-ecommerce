<?php

namespace App\Orchid\Screens\Categories;

use App\Models\Category;
use Illuminate\Http\Client\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

class CategoryEditScreen extends Screen
{
     /**
     * @var Post
     */
    public $category;

    /**
     * Query data.
     *
     * @param Post $category
     *
     * @return array
     */
    public function query(Category $category): array
    {
        return [
            'category' => $category
        ];
    }

    /**
     * The name is displayed on the user's screen and in the headers
     */
    public function name(): ?string
    {
        return $this->category->exists ? 'Edit category' : 'Creating a new category';
    }
    
    /**
     * The description is displayed on the user's screen under the heading
     */
    public function description(): ?string
    {
        return "Product Categories";
    }

    /**
     * Button commands.
     *
     * @return Link[]
     */
    public function commandBar(): array
    {
        return [
            Button::make('Create category')
                ->icon('pencil')
                ->method('createOrUpdate')
                ->canSee(!$this->category->exists),

            Button::make('Update')
                ->icon('note')
                ->method('createOrUpdate')
                ->canSee($this->category->exists),

            Button::make('Remove')
                ->icon('trash')
                ->method('remove')
                ->canSee($this->category->exists),
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
                Input::make('category.name')
                    ->title('Title')
                    ->placeholder('Category Title')
                    ->help('Specify a short descriptive title for this category.'),

                TextArea::make('category.description')
                    ->title('Description')
                    ->rows(3)
                    ->maxlength(200)
                    ->placeholder('Brief description for preview'),

                Relation::make('category.parent_id')
                    ->title('Parent')
                    ->fromModel(Category::class, 'name'),

                Quill::make('category.body')
                    ->title('Main text'),

            ])
        ];
    }

    /**
     * @param Post    $category
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createOrUpdate(Category $category, Request $request)
    {
        $category->fill($request->get('category'))->save();

        Alert::info('You have successfully created an category.');

        return redirect()->route('platform.category.list');
    }

    /**
     * @param Post $category
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function remove(Category $category)
    {
        $category->delete();

        Alert::info('You have successfully deleted the category.');

        return redirect()->route('platform.category.list');
    }
}
