<?php

namespace App\Orchid\Layouts\CustomInputs;

use App\Models\CustomInput;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class CustomInputListLayout extends Table
{
     /**
     * Data source.
     *
     * @var string
     */
    public $target = 'customInputs';

    /**
     * @return TD[]
     */
    public function columns(): array
    {
        return [
            TD::make('name', 'Title')
                ->render(function (CustomInput $customInput) {
                    return Link::make($customInput->title)
                        ->route('platform.customInput.edit', $customInput);
                }),
            TD::make('label','Label'),

            TD::make('created_at', 'Created'),
            TD::make('updated_at', 'Last edit'),
        ];
    }
}
