<?php

namespace App\Orchid\Screens\CustomInputs;

use App\Http\Requests\CustomInputRequest;
use App\Models\CustomInput;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Http\Client\Request;
use Illuminate\Http\Request as HttpRequest;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Fields\Upload;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

class CustomInputEditScreen extends Screen
{
     /**
     * @var Post
     */
    public $customInput;

    /**
     * Query data.
     *
     * @param Post $customInput
     *
     * @return array
     */
    public function query(CustomInput $customInput): array
    {
        $customInput->load('attachment');
        return [
            'customInput' => $customInput
        ];
    }

    /**
     * The name is displayed on the user's screen and in the headers
     */
    public function name(): ?string
    {
        return $this->customInput->exists ? 'Edit custom Input' : 'Creating a new custom Input';
    }
    
    /**
     * The description is displayed on the user's screen under the heading
     */
    public function description(): ?string
    {
        return "Product CustomInputs";
    }

    /**
     * Button commands.
     *
     * @return Link[]
     */
    public function commandBar(): array
    {
        return [
            Button::make('Create custom Input')
                ->icon('pencil')
                ->method('createOrUpdate')
                ->canSee(!$this->customInput->exists),

            Button::make('Update')
                ->icon('note')
                ->method('createOrUpdate')
                ->canSee($this->customInput->exists),

            Button::make('Remove')
                ->icon('trash')
                ->method('remove')
                ->canSee($this->customInput->exists),
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
                Input::make('customInput.name')
                    ->title('Title')
                    ->placeholder('Title')
                    ->help('Specify a short descriptive title for this.'),
                Input::make('customInput.label')
                    ->title('Label')
                    ->placeholder('Label')
                    ->help('Specify a short descriptive label for this.'),

                // Input::make('customInput.video')
                //     ->title('Video Link')
                //     ->placeholder('Video Link')
                //     ->help('Specify a short descriptive label for this.'),

                TextArea::make('customInput.description')
                    ->title('Description')
                    ->rows(3)
                    ->maxlength(200)
                    ->placeholder('Brief description for preview'),

                Upload::make('customInput.attachment')->title('Attachments')

            ])
        ];
    }

    /**
     * @param Post    $customInput
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createOrUpdate(CustomInput $customInput, CustomInputRequest $request)
    {
        $customInput->fill($request->get('customInput'))->save();
        $customInput->attachment()->syncWithoutDetaching(
            $request->input('customInput.attachment', [])
        );

        Alert::info('You have successfully saved a custom Input.');

        return redirect()->route('platform.customInput.list');
    }

    /**
     * @param Post $customInput
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function remove(CustomInput $customInput)
    {
        $customInput->delete();

        Alert::info('You have successfully deleted the custom Input.');

        return redirect()->route('platform.customInput.list');
    }
}
