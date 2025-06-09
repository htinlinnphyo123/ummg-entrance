<x-master-layout name="ApplicantRecord" headerName="{{ __('sidebar.applicantRecord') }}">
   <main class="h-full overflow-y-auto">
        <div class="container px-1 md:px-6 mx-auto grid">
            <div class="container md:flex justify-start md:justify-between items-start mx-auto mt-5">
                <x-common.search keyword="{{ request()->keyword }}" />
                <x-common.create_button route="applicantRecords.create" permission="create applicantRecords" />
            </div>
            <div class="mt-4 mb-4">
                <form method="GET" action="{{ route('applicantRecords.index') }}" class="flex flex-col md:flex-row items-center gap-2">
                    <label for="exam_type" class="text-sm font-medium">{{ __('table.exam_type') }}:</label>
                    <select name="exam_type" id="exam_type" class="form-select rounded border-gray-300" onchange="this.form.submit()">
                        <option value="">All</option>
                        @foreach (App\Enums\ExamType::cases() as $type)
                            <option value="{{ $type->value }}" {{ request('exam_type') == $type->value ? 'selected' : '' }}>
                                {{ $type->name }}
                            </option>
                        @endforeach
                    </select>
                </form>
            </div>
            <x-table.wrapper>
                <x-table.header :fields="['applicant_sr', 'mesid', 'exam_type', 'total_edu_marks','education_score','essay_score', 'mental_score', 'activity_score', 'program_score', 'total_scores', 'final_eligibility']" />
                <x-table.body>
                    @foreach ($data['data'] as $record)
                        <x-table.body_row>
                            <x-table.body_column :field="$record['applicant_sr']"  />
                            <x-table.body_column :field="$record['mesid']"  />
                            <x-table.body_column :field="$record['exam_type']"  />
                            <x-table.body_column :field="$record['total_edu_marks']"  />
                            @php
                                $educationEligible = $record['education_eligible'] == 'pass' ? '<span class="text-green-500">pass</span>' : '<span class="text-red-500">fail</span>';
                                $essayEligible = $record['essay_eligible'] == 'pass' ? '<span class="text-green-500">pass</span>' : '<span class="text-red-500">fail</span>';
                                $mentalEligible = $record['mental_eligible'] == 'pass' ? '<span class="text-green-500">pass</span>' : '<span class="text-red-500">fail</span>';
                                $activityEligible = $record['activity_eligible'] == 'pass' ? '<span class="text-green-500">pass</span>' : '<span class="text-red-500">fail</span>';
                                $programEligible = $record['program_eligible'] == 'pass' ? '<span class="text-green-500">pass</span>' : '<span class="text-red-500">fail</span>';
                            @endphp
                            <x-table.body_column :field="$record['education_score'] ?? 0 . '/' . $record['education_eligible']"  />
                            <x-table.body_column :field="$record['essay_score'] . '/' . $essayEligible"  />
                            <x-table.body_column :field="$record['mental_score'] . '/' . $mentalEligible"  />
                            <x-table.body_column :field="$record['activity_score'] . '/' . $activityEligible"  />
                            <x-table.body_column :field="$record['program_score'] . '/' . $programEligible"  />
                            <x-table.body_column :field="$record['total_scores']"  />
                            @php
                                if($record['manual_eligible']){
                                    $finalEligibilityColor = 'text-blue-500';
                                } elseif ($record['final_eligibility'] == 'Not Eligible') {
                                    $finalEligibilityColor = 'text-red-500';
                                } elseif ($record['final_eligibility'] == 'Eligible') {
                                    $finalEligibilityColor = 'text-green-500';
                                }
                            @endphp
                            <x-table.body_column :style="$finalEligibilityColor" :field="$record['manual_eligible'] ? 'Take' : $record['final_eligibility']"  />
                            <x-table.action_new :id="$record['id']" field="applicantRecords">
                                @if ($record['final_eligibility'] === 'Not Eligible' && !$record['manual_eligible'])
                                    <form action="{{ route('applicantRecords.manualEligible', $record['id']) }}" method="POST" class="whitespace-nowrap">
                                        @csrf
                                        <button type="submit" class="text-xs px-2 py-1 bg-green-500 text-white rounded hover:bg-green-600" onclick="return confirm('Are you sure you want to mark this record as manually eligible?')">
                                            Take
                                        </button>
                                    </form>
                                @endif
                            </x-table.action_new>
                        </x-table.body_row>
                    @endforeach
                </x-table.body>
            </x-table.wrapper>
            <x-pagination.index route="applicantRecords.index" :meta="$data['meta']" />
        </div>
    </main>
    @vite('resources/js/common/deleteConfirm.js') 
</x-master-layout>
