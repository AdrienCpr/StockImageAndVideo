<div>
    <div class="grid grid-cols-4 gap-4 mt-2">
        @foreach($this->photos as $photo)
            <img class="object-cover h-48 w-48 md:w-96" src="{{ public_path().'/storage/'.$photo->hash_name }}">
        @endforeach
    </div>

    <div class="grid grid-cols-4 gap-4 mt-2">
        @foreach($this->videos as $video)
            <img class="object-cover h-48 w-48 md:w-96" src="{{ public_path().$video->path }}">
        @endforeach
    </div>
</div>
