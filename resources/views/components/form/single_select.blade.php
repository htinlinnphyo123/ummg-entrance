@props(['title', 'required' => false, 'name','id'=>null])
<x-form.control>
    <x-form.label :title="$title" :required="$required" />
    <select
        class="" name="{{ $name }}" id="{{ $id }}">
        <option value="">Choose</option>
        {{ $slot }}
    </select>
    <x-form.error :field="$name" />

</x-form.control>
