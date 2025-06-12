@props(['isBackground' => false,'class'=>null])
<div class="grid gap-2 md:grid-cols-4 {{ $isBackground ? 'shadow-inner rounded-lg border' : '' }} {{ $class }}">
    {{ $slot }}
</div>
