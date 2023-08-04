<?php

namespace App\Http\Livewire;

use App\Models\Files;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ViewFiles extends Component
{
    public $photos, $videos;

    public function mount()
    {
        $this->photos = Files::query()
            ->where('user_id', Auth::user()->id)
            ->where('type','photo')
            ->get();

        $this->videos = Files::query()
            ->where('user_id', Auth::user()->id)
            ->where('type','video')
            ->get();
    }

    public function render()
    {
        return view('livewire.view-files');
    }
}
