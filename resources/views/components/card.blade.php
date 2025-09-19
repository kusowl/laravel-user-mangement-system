@props(['title' => '', 'body' => ''])
<div class="card bg-base-100 shadow-sm">
    <article class="card-body">
        <div class="text-lg font-bold text-center">{{ $title }}</div>
        <div class="body text-sm">{{ $body }}</div>
    </article>
</div>
