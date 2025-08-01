@props(['route'])
<x-dropdown.wrapper title="Choose" toggleDiv="pageCount">
    <x-dropdown.item name="number.20" link="{{ changeParam($route,['paginate'=>20]) }}" />
    <x-dropdown.item name="number.50" link="{{ changeParam($route,['paginate'=>50]) }}" />
    <x-dropdown.item name="number.100" link="{{ changeParam($route,['paginate'=>100]) }}" />
    <x-dropdown.item name="number.200" link="{{ changeParam($route,['paginate'=>200]) }}" />
    <x-dropdown.item name="number.300" link="{{ changeParam($route,['paginate'=>300]) }}" />
</x-common.dropdown>