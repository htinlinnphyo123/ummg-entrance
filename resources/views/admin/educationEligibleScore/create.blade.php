<x-master-layout name="EducationEligibleScore" headerName="{{ __('sidebar.educationEligibleScore') }}">
    <x-form.layout>
        <form action="{{ route('educationEligibleScores.store') }}" method="post">
            @csrf
            <x-form.grid>
                <x-form.input_group title="educationEligibleScore.name" name="name" id="name" :required="true" />
            </x-form.grid>
            <x-form.submit :operate="__('messages.save')" :cancel="__('messages.cancel')" url="educationEligibleScores.index" />
        </form>
    </x-form.layout>
</x-master-layout>
