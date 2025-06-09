@props(['title','required'=>false,'for'=>null,'labelID'=>null])
<label class="pb-2 pt-2 text-sm text-gray-900 dark:text-white font-mono select-none" 
    for="{{ $for ?? $title }}" id="{{ $labelID }}">
    {{ __($title) }}
    @if($required)
        <sup class="text-red-600">*</sup>
    @endif
</label>
