<?php

namespace App\Http\Livewire\Text;

use App\Identifier\IdentifierContract;
use App\Models\Text;
use Livewire\Component;
use Livewire\WithFileUploads;

class UploadTextModalForm extends Component
{
    use WithFileUploads;

    /**
     * Determines if the modal should be shown to the user.
     *
     * @var boolean
     */
    public $showModal = true;

    /**
     * The name of the text file.
     *
     * @var string
     */
    public $name;

    /**
     * The text that should be saved.
     *
     * @var string
     */
    public $text;

    /**
     * The file that should have its contents stored in the text property.
     *
     * @var string
     */
    public $file;

    /**
     * Handle state changes when the model is toggeled.
     *
     * @param  bool $state
     * @return void
     */
    public function updatedShowModal($state)
    {
        if (!$state) {
            $this->reset('text');
            $this->reset('file');
        }
    }

    /**
     * Sets the contents of the uploaded file to the text property.
     *
     * @param  \Livewire\TemporaryUploadedFile  $uploadedFile
     * @return void
     */
    public function updatedFile($uploadedFile)
    {
        $this->resetErrorBag();

        $content = $uploadedFile->get();

        // We're preforming a JSON encoding on the contents of the uploaded file
        // to check if the file is in a valid UTF-8 format, if the encoding
        // fails it's most likely because the uploaded files doesn't
        // contain text, such as images, PDFs, or executables.
        if (!json_encode($content)) {
            return $this->addError('file', 'Invalid text file provided');
        }

        $this->text = $content;
        $this->name = $uploadedFile->getClientOriginalName();

        $this->reset('file');
    }

    /**
     * Handles validation the text and saving the model.
     *
     * @return void
     */
    public function save()
    {
        $this->validate([
            'name' => ['required', 'string', 'min:3'],
            'text' => ['required', 'string', 'min:3'],
        ]);

        $parts = explode('.', $this->name);
        if (count($parts) > 1) {
            array_shift($parts);
        }

        $text = Text::create([
            'user_id' => auth()->user()->id,
            'name' => app(IdentifierContract::class)->generate(),
            'original_name' => $this->name,
            'extension' => strtolower(join('.', $parts)),
            'content' => $this->text,
        ]);

        session()->flash('upload-url', $text->resource_url);

        $this->reset('name');
        $this->reset('text');
    }

    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('text.upload-text-modal-form');
    }
}
