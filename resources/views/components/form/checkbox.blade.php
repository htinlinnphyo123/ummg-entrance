@props([
    'title',
    'name'=>null,
    'required'=>false,
    'id' => null,
    'value'=>1,
    ])
<x-form.control>
    <x-form.label :title="$title" />
    <div class="flex items-center gap-4">
        <div class="flex items-center">
            <input
                @if($value==1) checked @endif
                type="radio" 
                name="{{ $name }}" 
                id="{{ $id }}_true" 
                value="1"
                class="w-4 h-4 me-2 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
            <label for="{{ $id }}_true" class="text-sm font-medium text-gray-900 dark:text-gray-300">True</label>
        </div>
        <div class="flex items-center">
            <input
                @if($value==0) checked @endif
                type="radio" 
                name="{{ $name }}" 
                id="{{ $id }}_false" 
                value="0"
                class="w-4 h-4 me-2 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
            <label for="{{ $id }}_false" class="text-sm font-medium text-gray-900 dark:text-gray-300">False</label>
        </div>
    </div>
    <x-form.error :field="$name" />
</x-form.control>