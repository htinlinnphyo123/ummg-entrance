<x-master-layout name="MinimumEligibleScore" headerName="{{ __('sidebar.minimumEligibleScore') }}">
    <x-form.layout>
        <x-common.url_back_button />
        <br><br>
        <x-show.grid :isBackground='true'>
            <x-show.text_group title="minimumEligibleScore.id" :data="$data['id']" />
            <x-show.text_group title="minimumEligibleScore.name" :data="$data['name']" />
        </x-show.grid>
    </x-form.layout>
</x-master-layout>
