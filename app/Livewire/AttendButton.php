<?php

namespace App\Livewire;

use App\Models\Event;
use Livewire\Component;

class AttendButton extends Component
{

    public $eventId;
    public $text = "Ik ben er bij!";

    public function mount($eventId = null){
        $this->eventId = $eventId;
    }

    public function render()
    {
        return view('livewire.attend-button');
    }

    public function upAttendees(){
        if(!isset($this->eventId) || $this->text == "Zien wij je dan!") return;

        $event = Event::find($this->eventId);

        if(!isset($event->registered_people))
            $event->registered_people = 1;
        else
            $event->registered_people++;

        $event->save();
        $this->text = "Zien wij je dan!";
    }
}
