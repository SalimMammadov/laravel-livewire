<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;
use Intervention\Image\ImageManagerStatic;
use Illuminate\Support\Str;

class Comments extends Component
{
    use WithPagination;

    // public $comments;
    public $comment;
    public $image;
    public $tid;
    // public function mount()
    // {
    //     $commentFromDb = Comment::paginate(2);
    //     $this->comments = $commentFromDb;
    // }
    protected $listeners = [
        'fileUpload'     => 'handleFileUpload',
        'ticketSelected'
    ];

    public function hydrateTid()
    {
        $this->gotoPage(1);
    }


    public function ticketSelected($t_id)
    {
        $this->tid = $t_id;
    }

    public function handleFileUpload($imageData)
    {
        $this->image = $imageData;
    }
    public function addComment()
    {
        $this->validate(['comment' => 'required']);
        $image = $this->storeImage();
        $newComment = new Comment;
        $newComment->body = $this->comment;
        $newComment->user_id = 1;
        $newComment->image = $image;
        $newComment->support_ticket_id = $this->tid;
        $newComment->save();

        // $this->comments->prepend($newComment);
        $this->comment =  "";
        $this->image = "";
        session()->flash('message', 'Added ! 😛');
    }

    public function storeImage()
    {
        if (!$this->image) return null;
        $img = ImageManagerStatic::make($this->image)->encode('jpg');
        $name = Str::random() . '.jpg';
        Storage::disk('public')->put($name, $img);
        return $name;
    }


    public function remove($id)
    {
        $deletedComment = Comment::find($id);
        $deletedComment->delete();
        // $this->comments = $this->comments->where('id', '!=', $id);
    }

    public function updated($field)
    {
        $this->validateOnly($field, ['comment' => 'required|max:10']);
    }


    public function render()
    {
        return view('livewire.comments', [
            'comments' => Comment::where('support_ticket_id', $this->tid)->latest()->paginate(2)
        ]);
    }
}
