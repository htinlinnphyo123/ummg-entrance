<x-master-layout name="MinimumEligibleScore" headerName="{{ __('sidebar.minimumEligibleScore') }}">
    <x-form.layout>
        <form action="{{ route('minimumEligibleScores.store') }}" method="post">
            @csrf
            <x-form.grid>
                <x-form.input_group title="minimumEligibleScore.name" name="name" id="name" :required="true" />
            </x-form.grid>
            <x-form.submit :operate="__('messages.save')" :cancel="__('messages.cancel')" url="minimumEligibleScores.index" />
        </form>
    </x-form.layout>
</x-master-layout>
