<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\File;
use Auth;
use App\Models\Files;

class UploadFiles extends Component
{
    use WithFileUploads;

    public $photos = [];
    public $videos = [];

    public function updatedPhotos()
    {
        $this->validate([
           'photos.*' => 'mimes:jpg,bmp,png,jpeg|max:2000000', // 2GB Max
        ]);
    }

    public function updatedVideos()
        {
            $this->validate([
               'videos.*' => 'mimes:mp4,mov,avi|max:2000000',
            ]);
        }

    public function save()
    {
        try{
            $path = str_replace(' ', '_', Auth::user()->name);

            foreach ($this->photos as $photo) {
                $filename = $photo->store('photos/'.$path);

                Files::create([
                    'name' => $photo->getClientOriginalName(),
                    'hash_name' => $filename,
                    'path' => 'photos/'.$path,
                    "type" => "photo",
                    'user_id' => Auth::user()->id
                ]);
            }
            foreach ($this->videos as $video) {
                $filename = $video->store('videos/'.$path);

                Files::create([
                    'name' => $video->getClientOriginalName(),
                    'hash_name' => $filename,
                    'path' => 'videos/'.$path,
                    'type' => "video",
                    'user_id' => Auth::id()
                ]);
            }

            $this->photos = [];
            $this->videos = [];

            $dossier = storage_path().'/app/livewire-tmp';
            File::deleteDirectory($dossier);

            $this->dispatchBrowserEvent('alert',
                    ['type' => 'success',  'message' => 'Les fichiers ont bien été sauvegardés']);

            session()->flash('message', 'Les fichiers ont bien été sauvegardés');

        } catch (\Exception $e) {
        dd($e);
            $this->dispatchBrowserEvent('alert',
                    ['type' => 'error',  'message' => "Une erreur est survenue"]);
        }
    }

    public function render()
    {
        return view('livewire.upload-files');
    }
}
