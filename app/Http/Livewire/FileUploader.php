<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

class FileUploader extends Component
{
    use WithFileUploads;

    public $photos = [];

    // public function updatedPhoto()
    // {
    //     $this->validate([
    //         'photo' => 'image|max:10240', // 1MB Max
    //     ]);
    // }

    public function save()
    {
        $this->validate([
            'photos.*' => 'image|max:10240', // 1MB Max
        ]);
        if ($this->photos) {
            foreach ($this->photos as $photo) {
                $photo->store('photos');
                session()->flash('success', 'File Uploaded !');
            }
        }
        $this->photos = [];
    }

    public function remove($index)
    {
        array_splice($this->photos, $index, 1);
    }

    public function render()
    {
        return view('livewire.file-uploader');
    }
}
