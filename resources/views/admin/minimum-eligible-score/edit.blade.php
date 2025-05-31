<x-master-layout name="MinimumEligibleScore" headerName="{{ __('sidebar.minimumEligibleScore') }}">
    <x-form.layout>
        <form action="{{ route('minimumEligibleScores.update', $data['id']) }}" method="post">
            @csrf
            @method('PUT')
            <x-form.grid>
                <x-form.input_group type="number" title="minimumEligibleScore.min_education" name="min_education" id="min_education" :value="$data['min_education']" :required="true" />
                <x-form.input_group type="number" title="minimumEligibleScore.min_program" name="min_program" id="min_program" :value="$data['min_program']" :required="true" />
                <x-form.input_group type="number" title="minimumEligibleScore.min_activity" name="min_activity" id="min_activity" :value="$data['min_activity']" :required="true" />
                <x-form.input_group type="number" title="minimumEligibleScore.min_essay" name="min_essay" id="min_essay" :value="$data['min_essay']" :required="true" />
                <x-form.input_group type="number" title="minimumEligibleScore.min_mental" name="min_mental" id="min_mental" :value="$data['min_mental']" :required="true" />

            </x-form.grid>
            <x-form.submit :operate="__('messages.update')" :cancel="__('messages.cancel')" url="minimumEligibleScores.index" />
        </form>
    </x-form.layout>
</x-master-layout>
