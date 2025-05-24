<x-master-layout name="SingleEduEligibleMark" headerName="{{ __('sidebar.singleEduEligibleMark') }}">
    <x-form.layout>
        <x-common.url_back_button />
        <br><br>
        <x-show.grid :isBackground='true'>
            <x-show.text_group title="singleEduEligibleMark.id" :data="$data['id']" />
            <x-show.text_group title="singleEduEligibleMark.name" :data="$data['name']" />
        </x-show.grid>
    </x-form.layout>
</x-master-layout>
