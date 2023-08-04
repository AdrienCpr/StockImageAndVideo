<div>
    <div>
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
    </div>
    <form wire:submit.prevent="save">
        <h1 class="underline underline-offset-2 mb-2 text-2xl font-semibold">Enregistrez vos fichiers :</h1>
        <div class="mb-8">
            <h4>Upload photos :</h4>
            <input type="file"  wire:model="photos" multiple
                   class="block w-full text-sm text-slate-500
                          file:mr-4 file:py-2 file:px-4
                          file:rounded-full file:border-0
                          file:text-sm file:font-semibold
                          file:bg-violet-50 file:text-violet-700
                          hover:file:bg-violet-100
                        "/>
            <div wire:loading wire:target="photos">Uploading...</div>
            @error('photos.*') <span class="error text-red-500">{{ $message }}</span> @enderror

            @if($photos)
               <div class="grid grid-cols-4 gap-4 mt-2">
                   @foreach($photos as $photo)
                       <img class="object-cover h-48 w-48 md:w-96" src="{{ $photo->temporaryUrl() }}">
                   @endforeach
               </div>
            @endif
        </div>

        <div class="mb-8">
            <h4>Upload videos :</h4>
            <input type="file"  wire:model="videos" multiple
                   class="block w-full text-sm text-slate-500
                          file:mr-4 file:py-2 file:px-4
                          file:rounded-full file:border-0
                          file:text-sm file:font-semibold
                          file:bg-violet-50 file:text-violet-700
                          hover:file:bg-violet-100
                        "/>
            <div wire:loading wire:target="videos">Uploading...</div>
            @error('videos.*') <span class="error text-red-500">{{ $message }}</span> @enderror
        </div>

        <div>
            <button class="rounded-full mt-4 bg-indigo-500 hover:bg-indigo-800 text-white py-2 px-4" type="submit">Sauvegarder</button>
        </div>
    </form>
</div>
