<x-master-layout name="EducationEligibleScore" headerName="{{ __('sidebar.educationEligibleScore') }}">
    <x-form.layout>
        <x-common.url_back_button />
        <br><br>
        <x-show.grid :isBackground='true'>
            <x-show.text_group title="educationEligibleScore.id" :data="$data['id']" />
            <x-show.text_group title="educationEligibleScore.name" :data="$data['name']" />
        </x-show.grid>
    </x-form.layout>
</x-master-layout>
