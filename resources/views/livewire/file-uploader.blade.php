<div>

    <br>
    <input type="file" multiple wire:model="photos">
    @error('photos.*') <span class="text-danger">{{ $message }}</span> @enderror
    <button wire:loading.remove wire:click.prevent="save" class="w-full p-2 text-white rounded shadow-lg" style="background-image: linear-gradient( 65.4deg,  rgba(56,248,249,1) -9.1%, rgba(213,141,240,1) 48%, rgba(249,56,152,1) 111.1% );">Save</button>
    <button wire:loading wire:target="save" class="w-full p-2 text-white rounded shadow-lg" style="background-image: linear-gradient( 65.4deg,  rgba(56,248,249,1) -9.1%, rgba(213,141,240,1) 48%, rgba(249,56,152,1) 111.1% );">
        <i class="fas fa-spinner fa-spin text-2xl"></i>
    </button>
    <br>
    <br>

    <!-- <div wire:loading wire:target="photo" class="text-success">Uploading...</div>
    <div wire:loading wire:target="save" class="text-success">Storing...</div> -->

    @if(session()->has('success'))
    <div class="alert alert-success">{{session()->get('success')}}</div>
    @endif


    @if ($photos)
    <div class="card card-secondary">
        @foreach($photos as $photo)
        <div wire:key="{{$loop->index}}" class="flex justify-content-center my-2 bg-info p-3">
            <img width="200" height="150" src="{{ $photo->temporaryUrl() }}">
            <i class=" ml-2 fas fa-times-circle text-gray-700 fa-2x float-right cursor-pointer" wire:click="remove({{$loop->index}})"></i>
        </div>
        @endforeach
    </div>

    @endif
</div>