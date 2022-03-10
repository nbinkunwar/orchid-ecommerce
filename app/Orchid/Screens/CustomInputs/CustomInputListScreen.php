<?php

namespace App\Orchid\Screens\CustomInputs;

use App\Models\CustomInput;
use App\Orchid\Layouts\CustomInputs\CustomInputListLayout;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class CustomInputListScreen extends Screen
{
     /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'customInputs' => CustomInput::paginate()
        ];
    }

    /**
     * The name is displayed on the user's screen and in the headers
     */
    public function name(): ?string
    {
        return 'Product customInput';
    }
    
    /**
     * The description is displayed on the user's screen under the heading
     */
    public function description(): ?string
    {
        return "All product customInputs";
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
                ->route('platform.customInput.edit')
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
            CustomInputListLayout::class
        ];
    }
}
