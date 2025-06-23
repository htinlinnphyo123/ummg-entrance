@props(['field', 'limit' => 40, 'style' => null, 'image' => null, 'imageStyle' => null])
<td scope="row" class="px-6 py-4 {{ $style }} text-black font-bold">
    @if ($image)
        <img src="{{ $field }}" alt="" class="{{ $imageStyle }}">
    @else
        {!! $field !!}
    @endif
</td>
