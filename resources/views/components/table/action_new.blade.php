@props(['id', 'field'])
<td class="px-3 py-2">
    <div class="flex gap-2 justify-end items-center">
        <a href="{{ route($field.'.show', $id) }}" 
           class="bg-sky-600 text-white rounded-md px-2 py-1 text-xs">
            <i class="fas fa-eye"></i>
        </a>
        <a href="{{ route($field.'.edit', $id) }}" 
            class="bg-blue-600 text-white rounded-md px-2 py-1 text-xs">
            <i class="fas fa-edit"></i>
        </a>
        {{$slot}}
    </div>
</td>