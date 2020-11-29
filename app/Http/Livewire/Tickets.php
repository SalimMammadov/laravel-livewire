<?php

namespace App\Http\Livewire;

use App\Models\Ticket;
use Livewire\Component;
use Livewire\WithPagination;

class Tickets extends Component
{

    use WithPagination;

    public $active;

    protected $listeners = ['ticketSelected'];

    public function ticketSelected($ticketId)
    {
        $this->active = $ticketId;
    }


    public function render()
    {
        return view('livewire.tickets', [
            'tickets' => Ticket::all()
        ]);
    }
}
