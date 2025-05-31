<x-master-layout name="EducationEligibleScore" headerName="{{ __('sidebar.educationEligibleScore') }}">
    <x-form.layout>
        <form action="{{ route('educationEligibleScores.update', $data['id']) }}" method="post">
            @csrf
            @method('PUT')
            <p class="text-xl">{{ $data['exam_type'] }}</p>
            <x-form.grid>
                <x-form.input_group title="educationEligibleScore.margin_score" name="margin_score" id="margin_score" :value="$data['margin_score']" :required="true" />
                <x-form.input_group title="educationEligibleScore.eligible_score" name="eligible_score" id="eligible_score" :value="$data['eligible_score']" :required="true" />
            </x-form.grid>
            <x-form.submit :operate="__('messages.update')" :cancel="__('messages.cancel')" url="educationEligibleScores.index" />
        </form>
    </x-form.layout>
</x-master-layout>
