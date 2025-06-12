<x-master-layout name="ApplicantRecord" headerName="{{ __('sidebar.applicantRecord') }}">
    <x-form.layout>
        <x-common.url_back_button />
        <br><br>
        <x-show.grid>
            <x-show.text_group title="applicantRecord.applicant_sr" :data="$data['applicant_sr']" />
            <x-show.text_group title="applicantRecord.mesid" :data="$data['mesid']" />
        @php
            $examType = $data['exam_type'];
            if ($examType === 'BEHS' || $examType === 'BECA') {
                $sub1 = 'Myanmar';
                $sub2 = 'English';
                $sub3 = 'Math';
                $sub4 = 'Physics';
                $sub5 = 'Chemistry';
                $sub6 = 'Biology';
            } elseif ($examType === 'GED') {
                $sub1 = 'Social';
                $sub2 = 'RLA';
                $sub3 = 'Maths';
                $sub4 = 'Science';
            } elseif( $examType=== 'IGCSE') {
                $sub1 = 'English';
                $sub2 = 'Math';
                $sub3 = 'Physics';
                $sub4 = 'Chemistry';
                $sub5 = 'Biology';
                $sub6 = 'X';
            }
        @endphp
            <x-show.text_group title="applicantRecord.exam_type" :data="$data['exam_type']" />
            <x-show.text_group :title="$sub1" :data="$data['sub_1']" />
            <x-show.text_group :title="$sub2" :data="$data['sub_2']" />
            <x-show.text_group :title="$sub3" :data="$data['sub_3']" />
            <x-show.text_group :title="$sub4" :data="$data['sub_4']" />
            @if ($examType!=='GED')
                <x-show.text_group :title="$sub5" :data="$data['sub_5']" />
                <x-show.text_group :title="$sub6" :data="$data['sub_6']" />        
            @endif
            <x-show.text_group title="applicantRecord.total_edu_marks" :data="$data['total_edu_marks']" />
            <x-show.text_group title="applicantRecord.program_score" :data="$data['program_score']" />
            <x-show.text_group title="applicantRecord.essay_score" :data="$data['essay_score']" />
            <x-show.text_group title="applicantRecord.mental_score" :data="$data['mental_score']" />
            <x-show.text_group title="applicantRecord.activity_type" :data="$data['activity_type']" />
            <x-show.text_group title="applicantRecord.month" :data="$data['month']" />
            <x-show.text_group title="applicantRecord.activity_score" :data="$data['activity_score']" />
            <x-show.text_group title="applicantRecord.email" :data="$data['email']" />
            <x-show.text_group title="applicantRecord.current_school" :data="$data['current_school']" />
            <x-show.text_group title="applicantRecord.additional_data1" :data="$data['additional_data1']" />
            <x-show.text_group title="applicantRecord.additional_data2" :data="$data['additional_data2']" />
        </x-show.grid>
    </x-form.layout>
</x-master-layout>
