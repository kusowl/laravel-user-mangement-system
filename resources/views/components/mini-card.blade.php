@props(['title' => 'title', 'content' => 'content' ])
<div class="card-body bg-base-100 rounded-lg">
    <div class="text-xs pb-2 bg-base-300 rounded-lg px-1 py-2 text-center font-bold">
        {{ $title }}
    </div>

    <div class="text-md text-center">
        {{ $content}}
    </div>
</div>
