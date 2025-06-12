<x-master-layout name="ApplicantRecord" headerName="{{ __('sidebar.applicantRecord') }}">
    <x-form.layout>
        <form action="{{ route('applicantRecords.update', $data['id']) }}" method="post">
            @csrf
            @method('PUT')
            <x-form.grid>
                <x-form.input_group title="applicantRecord.applicant_sr" name="applicant_sr" id="applicant-sr" :value="$data['applicant_sr']" :required="true" />
                <x-form.input_group title="applicantRecord.mesid" name="mesid" id="mesid" :value="$data['mesid']" :required="true" />
                <x-form.input_group title="applicantRecord.email" name="email" id="email" :value="$data['email']" />
                <x-form.input_group title="applicantRecord.current_school" name="current_school" id="current_school" :value="$data['current_school']" />
                <x-form.input_group title="applicantRecord.additional_data1" name="additional_data1" id="additional_data1" :value="$data['additional_data1']" />
                <x-form.input_group title="applicantRecord.additional_data2" name="additional_data2" id="additional_data2" :value="$data['additional_data2']" />
            </x-form.grid>
            <x-form.simple_select title="applicantRecord.exam_type" name="exam_type" id="exam-type" :selected="$data['exam_type']">
                @foreach (App\Enums\ExamType::cases() as $examType)
                    <option value="{{ $examType->value }}" @if($data['exam_type'] == $examType->value) selected @endif>{{ $examType->name }}</option>
                @endforeach
            </x-form.simple_select>
            <x-form.grid>
            <x-form.input_group type="number" title="applicantRecord.sub_1" name="sub_1" labelID="lab-sub-1" placeholder="enter_mark" :value="$data['sub_1']" />
            <x-form.input_group type="number" title="applicantRecord.sub_2" name="sub_2" labelID="lab-sub-2" placeholder="enter_mark" :value="$data['sub_2']" />
            <x-form.input_group type="number" title="applicantRecord.sub_3" name="sub_3" labelID="lab-sub-3" placeholder="enter_mark" :value="$data['sub_3']" />
            <x-form.input_group type="number" title="applicantRecord.sub_4" name="sub_4" labelID="lab-sub-4" placeholder="enter_mark" :value="$data['sub_4']" />
            <x-form.input_group type="number" title="applicantRecord.sub_5" name="sub_5" labelID="lab-sub-5" placeholder="enter_mark" :value="$data['sub_5']" />
            <x-form.input_group type="number" title="applicantRecord.sub_6" name="sub_6" labelID="lab-sub-6" placeholder="enter_mark" :value="$data['sub_6']" />            
            </x-form.grid>
            <x-form.grid>
                <x-form.input_group type="number" title="applicantRecord.program_score" name="program_score" id="program_score" :value="$data['program_score']" placeholder="enter_mark" />
                <x-form.input_group type="number" title="applicantRecord.essay_score" name="essay_score" id="essay_score" :value="$data['essay_score']" />
                <x-form.input_group type="number" title="applicantRecord.mental_score" name="mental_score" id="mental_score" :value="$data['mental_score']" />
                <x-form.simple_select title="applicantRecord.activity_type" name="activity_type" id="activity_type" :selected="$data['activity_type']">
                    @foreach (App\Enums\ActivityType::cases() as $activityType)
                        <option value="{{ $activityType->value }}" @if($data['activity_type'] == $activityType->value) selected @endif>{{ $activityType->name }}</option>
                    @endforeach
                </x-form.simple_select>
                <x-form.input_group type="number" title="applicantRecord.month" name="month" id="month" :value="$data['month']" />
                <x-form.input_group type="number" title="applicantRecord.activity_score" name="activity_score" id="activity_score" :value="$data['activity_score']" />
            </x-form.grid>
            <x-form.submit :operate="__('messages.update')" :cancel="__('messages.cancel')" url="applicantRecords.index" />
        </form>
    </x-form.layout>
    @vite([
        'resources/js/common/fieldSetToggler.js'
    ])
</x-master-layout>
