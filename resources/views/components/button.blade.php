<button {{ $attributes->merge(['class' => 'btn btn-soft justify-center']) }}>
    <span class="button-text">{{ $slot }}</span>
    <span class="loading loading-spinner loading-xs hidden"></span>
</button>
