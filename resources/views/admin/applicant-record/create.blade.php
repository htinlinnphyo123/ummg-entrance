<x-master-layout name="ApplicantRecord" headerName="{{ __('sidebar.applicantRecord') }}">
    <x-form.layout>
        <form action="{{ route('applicantRecords.store') }}" method="post">
            @csrf
            <x-form.grid>
                <x-form.input_group title="applicantRecord.applicant_sr" name="applicant_sr" id="applicant-sr" :required="true" />
                <x-form.input_group title="applicantRecord.mesid" name="mesid" id="mesid" :required="true" />
                <x-form.input_group title="applicantRecord.email" name="email" id="email" />
                <x-form.input_group title="applicantRecord.current_school" name="current_school" id="current_school" />
                <x-form.input_group title="applicantRecord.additional_data1" name="additional_data1" id="additional_data1" />
                <x-form.input_group title="applicantRecord.additional_data2" name="additional_data2" id="additional_data2" />
            </x-form.grid>
            <x-form.simple_select title="applicantRecord.exam_type" name="exam_type" id="exam-type">
                @foreach (App\Enums\ExamType::cases() as $examType)
                    <option value="{{ $examType->value }}">{{ $examType->name }}</option>
                @endforeach
            </x-form.simple_select>
            <x-form.grid>
                @php
                    $id = request()->route('id') || 1;
                    if ($id === 1 || $id === 2 || $id === 5) {
                        $sub1 = 'Myanmar';
                        $sub2 = 'English';
                        $sub3 = 'Math';
                        $sub4 = 'Physics';
                        $sub5 = 'Chemistry';
                        $sub6 = 'Biology';
                    } elseif ($id === 3) {
                        $sub1 = 'Social';
                        $sub2 = 'RLA';
                        $sub3 = 'Maths';
                        $sub4 = 'Science';
                    } else {
                        $sub1 = 'English';
                        $sub2 = 'Math';
                        $sub3 = 'Physics';
                        $sub4 = 'Chemistry';
                        $sub5 = 'Biology';
                        $sub6 = 'X';
                    }
                @endphp
            <x-form.input_group type="number" containerId="container-sub1" title="applicantRecord.sub_1" name="sub_1" labelID="lab-sub-1" placeholder="enter_mark" />
            <x-form.input_group type="number" containerId="container-sub2" title="applicantRecord.sub_2" name="sub_2" labelID="lab-sub-2" placeholder="enter_mark" />
            <x-form.input_group type="number" containerId="container-sub3" title="applicantRecord.sub_3" name="sub_3" labelID="lab-sub-3" placeholder="enter_mark" />
            <x-form.input_group type="number" containerId="container-sub4" title="applicantRecord.sub_4" name="sub_4" labelID="lab-sub-4" placeholder="enter_mark" />
            <x-form.input_group type="number" containerId="container-sub5" title="applicantRecord.sub_5" name="sub_5" labelID="lab-sub-5" placeholder="enter_mark" />
            <x-form.input_group type="number" containerId="container-sub6" title="applicantRecord.sub_6" name="sub_6" labelID="lab-sub-6" placeholder="enter_mark" />            
        </x-form.grid>
        <x-form.grid>
                <x-form.input_group type="number" title="applicantRecord.program_score" name="program_score" id="program_score" placeholder="enter_mark"
                    :customAttributes="['step'=>'0.01']"  />
                <x-form.input_group type="number" title="applicantRecord.essay_score" name="essay_score" id="essay_score" />
                <x-form.input_group type="number" title="applicantRecord.mental_score" name="mental_score" id="mental_score" />
                <x-form.simple_select title="applicantRecord.activity_type" name="activity_type" id="activity_type">
                    @foreach (App\Enums\ActivityType::cases() as $activityType)
                        <option value="{{ $activityType->value }}">{{ $activityType->name }}</option>
                    @endforeach
                </x-form.simple_select>
                <x-form.input_group type="number" title="applicantRecord.month" name="month" id="month" />
                <x-form.input_group type="number" title="applicantRecord.activity_score" name="activity_score" id="activity_score" />
            </x-form.grid>
            <x-form.submit :operate="__('messages.save')" :cancel="__('messages.cancel')" url="applicantRecords.index" />
        </form>
    </x-form.layout>
    @vite([
        'resources/js/common/fieldSetToggler.js'
    ])
</x-master-layout>
