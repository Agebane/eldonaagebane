<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Setting;

class AuthorFooter extends Component
{
    
    public $settings;

    public function mount(){
        $this->settings =Setting::find(1);
    }
    
    public function render()
    {
        return view('livewire.author-footer');
    }
}
