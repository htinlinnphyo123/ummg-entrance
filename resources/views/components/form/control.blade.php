@props(['id'=>null])
<div @if($id) id="{{ $id }}" @endif>
    {{ $slot }}
</div>