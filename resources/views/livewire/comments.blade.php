<div>
    <h1 class="text-3xl">Comments</h1>
    @if($errors->any())
    @foreach($errors->all() as $error)
    <span class="text-danger text-xs">{{ $error }}</span>
    <br>
    @endforeach
    @endif

    <section>
        @if($image)
        <img class="my-3" src={{$image}} width="200" />
        <br>

        @endif
        <input type="file" id="image" wire:change="$emit('fileChoosen')">
    </section>

    <form wire:submit.prevent="addComment" class="my-4 flex">
        <input type="text" class="w-full rounded border shadow p-2 mr-2 my-2" placeholder="What's in your mind." wire:model.debounce.500ms="comment">
        <div class="py-2">
            <button type="submit" class="p-2 bg-blue-500 w-20 rounded shadow text-white">Add</button>
        </div>
    </form>
    @if(session()->has('message'))
    <div class="alert alert-success shadow p-2">
        {{session()->get('message')}}
    </div>
    @endif

    @foreach($comments as $comment)
    <div class="rounded border shadow p-3 my-2">
        <div class="flex justify-between my-2">
            <div class="flex">
                <p class="font-bold text-lg">{{$comment->creator->name}}</p>

                <p class="mx-3 py-1 text-xs text-gray-500 font-semibold">{{$comment->created_at->diffForHumans()}}
                </p>
            </div>
            <i class="fas fa-times text-danger" wire:click="remove({{$comment->id}})" style="cursor:pointer"></i>
        </div>
        <p class="text-gray-800">{{$comment->body}}</p>
        <br>
        <div>
            @if($comment->image)
            <img style="object-fit:contain;width:100%" src="/storage/{{$comment->image}}" alt="">
            @else
            <p class="p-2 bg-warning">No image</p>
            @endif
        </div>
    </div>
    @endforeach
    <div>
        {{$comments->links('pagination-links')}}

    </div>
</div>

<script>
    window.livewire.on('fileChoosen', () => {
        let inputField = document.getElementById('image')
        let file = inputField.files[0]
        let reader = new FileReader();
        reader.onloadend = () => {
            window.livewire.emit('fileUpload', reader.result)
        }
        reader.readAsDataURL(file);
    })
</script>