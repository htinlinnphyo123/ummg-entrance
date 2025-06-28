<x-master-layout name="ApplicantRecord" headerName="{{ __('sidebar.applicantRecord') }}">
   <main class="h-full overflow-y-auto">
        <div class="container px-1 md:px-6 mx-auto grid">
            <div class="container md:flex justify-start md:justify-between items-start mx-auto mt-5">
                <x-common.search keyword="{{ request()->keyword }}" />
                <x-common.create_button route="applicantRecords.create" permission="create applicantRecords" />
            </div>
            <div class="mt-4 flex gap-4">
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
                <form method="GET" action="{{ route('applicantRecords.index') }}" class="flex flex-col md:flex-row items-center gap-2">
                    <button type="submit" name="sort_eligible" value="{{ request('sort_eligible') == 'eligible' ? '' : 'eligible' }}" class="px-4 py-2 text-sm font-medium text-white bg-blue-500 rounded hover:bg-blue-600" onclick="storeFilters()">
                        {{ request('sort_eligible') == 'eligible' ? 'Sort By Total Score' : 'Sort By Eligible' }}
                    </button>
                    <button type="submit" name="sort_taken" value="{{ request('sort_taken') == 'taken' ? '' : 'taken' }}" class="px-4 py-2 text-sm font-medium text-white bg-green-500 rounded hover:bg-green-600" onclick="storeFilters()">
                        {{ request('sort_taken') == 'taken' ? 'Sort By Default' : 'Sort By Taken' }}
                    </button>
                </form>
                <form method="GET" action="{{ route('applicantRecords.index') }}" class="flex flex-col md:flex-row items-center gap-2">
                    <button type="submit" name="sort_applicant_id" value="{{ request('sort_applicant_id') == 'asc' ? 'desc' : 'asc' }}" class="px-4 py-2 text-sm font-medium text-white bg-purple-500 rounded hover:bg-purple-600" onclick="storeFilters()">
                        Sort By Applicant ID
                    </button>
                </form>
            </div>
            @php
                $eligibleCount = $data[1]->eligible_count;
                $manualEligibleCount = $data[1]->manual_eligible_count;
                $notEligibleCount = $data[1]->not_eligible_count;
                $finalTakeCount = $data[1]->final_take_count;
            @endphp
            <div class="grid grid-cols-4 gap-4 mt-4">
                <div class="bg-white rounded-lg shadow p-4">
                    <h3 class="text-lg font-semibold text-gray-700">Eligible</h3>
                    <p class="text-3xl font-bold text-green-500">{{ $eligibleCount }}</p>
                </div>
                <div class="bg-white rounded-lg shadow p-4">
                    <h3 class="text-lg font-semibold text-gray-700">Manual Eligible</h3>
                    <p class="text-3xl font-bold text-blue-500">{{ $manualEligibleCount }}</p>
                </div>
                <div class="bg-white rounded-lg shadow p-4">
                    <h3 class="text-lg font-semibold text-gray-700">Not Eligible</h3>
                    <p class="text-3xl font-bold text-red-500">{{ $notEligibleCount }}</p>
                </div>
                <div class="bg-white rounded-lg shadow p-4">
                    <h3 class="text-lg font-semibold text-gray-700">Final Take</h3>
                    <p class="text-3xl font-bold text-yellow-500">{{ $finalTakeCount }}</p>
                </div>
            </div>
            <x-table.wrapper>
                <x-table.header :fields="['applicant_sr', 'mesid', 'exam_type','is_bio','year', 'total_edu_marks','show_mark','education_score', 'program_score', 'essay_score','activity_score', 'mental_score','total_scores', 'final_eligibility','final_take']" />
                <x-table.body>
                    @foreach ($data[0]['data'] as $record)
                        <x-table.body_row>
                            <x-table.body_column :field="$record['applicant_sr']"  />
                            <x-table.body_column :field="$record['mesid']"  />
                            <x-table.body_column :field="$record['exam_type']"  />
                            <x-table.body_column :field="$record['is_bio'] ? 'Yes' : 'No'"  />
                            <x-table.body_column :field="$record['additional_data1']"  />
                            <x-table.body_column :field="$record['total_edu_marks'] . ' - ' . $record['total_passed_subject']"  />
                            @php
                                $educationEligible = $record['education_eligible'] == 'pass' ? "<span class='text-green-500'>pass</span>" : "<span class='text-red-500'>fail</span>";
                                $essayEligible = $record['essay_eligible'] == 'pass' ? "<span class='text-green-500'>pass</span>" : "<span class='text-red-500'>fail</span>";
                                $mentalEligible = $record['mental_eligible'] == 'pass' ? "<span class='text-green-500'>pass</span>" : "<span class='text-red-500'>fail</span>";
                                $activityEligible = $record['activity_eligible'] == 'pass' ? "<span class='text-green-500'>pass</span>" : "<span class='text-red-500'>fail</span>";
                                $programEligible = $record['program_eligible'] == 'pass' ? "<span class='text-green-500'>pass</span>" : "<span class='text-red-500'>fail</span>";
                                $eduSIngleMark = $record['sub_1'] . ' , ' . $record['sub_2'] . ' , ' . $record['sub_3'] . ' , ' . $record['sub_4'] . ' , ' . $record['sub_5'] . ' , ' . $record['sub_6'];
                            @endphp
                            <td scope="row" class="px-6 py-4">
                                <button type="button" 
                                    class="px-2 py-1 text-xs bg-blue-500 text-white rounded hover:bg-blue-600"
                                    onclick="showMarksModal('{{ $eduSIngleMark }}')"
                                >
                                    View Marks
                                </button>
                            </td>
                            <script>
                                function showMarksModal(marks) {
                                    const modal = document.createElement('div');
                                    modal.className = 'fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50';
                                    
                                    const content = document.createElement('div');
                                    content.className = 'bg-white p-6 rounded-lg shadow-xl';
                                    content.innerHTML = `
                                        <h3 class="text-lg font-semibold mb-4">Subject Marks</h3>
                                        <p class="mb-4">${marks}</p>
                                        <button onclick="this.closest('.fixed').remove()" 
                                            class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600"
                                        >
                                            Close
                                        </button>
                                    `;
                                    
                                    modal.appendChild(content);
                                    document.body.appendChild(modal);
                                }
                            </script>
                            <x-table.body_column :field="($record['education_score'] ?? 0) . '/' . $educationEligible"  />
                            <x-table.body_column :field="$record['program_score'] . '/' . $programEligible"  />
                            <x-table.body_column :field="$record['essay_score'] . '/' . $essayEligible"  />
                            <x-table.body_column :field="$record['activity_score'] . '/' . $activityEligible"  />
                            <x-table.body_column :field="$record['mental_score'] . '/' . $mentalEligible"  />
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
                            <td class="px-6 py-4">
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" class="sr-only peer" 
                                        {{ $record['final_take'] ? 'checked' : '' }}
                                        onchange="updateFinalTake(this, '{{ $record['id'] }}')"
                                    >
                                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                                </label>

                                <script>
                                    function updateFinalTake(checkbox, id) {
                                        fetch(`/applicantRecords/${id}/update-final-take`, {
                                            method: 'PATCH',
                                            headers: {
                                                'Content-Type': 'application/json',
                                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                                            },
                                            body: JSON.stringify({
                                                final_take: checkbox.checked
                                            })
                                        })
                                        .then(response => {
                                            if (!response.ok) {
                                                throw new Error('Network response was not ok');
                                            }
                                            return response.json();
                                        })
                                        .then(response => {
                                            const modal = document.createElement('div');
                                            modal.className = 'fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50';
                                            
                                            const content = document.createElement('div');
                                            content.className = 'bg-white p-6 rounded-lg shadow-xl';
                                            content.innerHTML = `
                                                <div class="flex flex-col items-center">
                                                    <svg class="w-16 h-16 text-green-500 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                    </svg>
                                                    <h3 class="text-lg font-semibold mb-4">Success!</h3>
                                                    <p class="mb-4">Final intake status has been updated successfully.</p>
                                                    <button onclick="this.closest('.fixed').remove()" 
                                                        class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600"
                                                    >
                                                        Close
                                                    </button>
                                                </div>
                                            `;
                                            
                                            modal.appendChild(content);
                                            document.body.appendChild(modal);
                                            
                                            // Auto close after 2 seconds
                                            setTimeout(() => {
                                                modal.remove();
                                            }, 2000);
                                        })
                                        .then(data => {                                            
                                            console.log('Update successful');
                                        })
                                        .catch(error => {
                                            console.error('Error:', error);
                                            checkbox.checked = !checkbox.checked; // Revert checkbox state
                                            alert('Failed to update status');
                                        });
                                    }
                                </script>
                            </td>
                            <x-table.action_new :id="$record['id']" field="applicantRecords">
                                @if ($record['final_eligibility'] === 'Not Eligible' && !$record['manual_eligible'])
                                    <form action="{{ route('applicantRecords.manualEligible', $record['id']) }}" method="POST" class="whitespace-nowrap">
                                        @csrf
                                        <button type="submit" class="text-xs px-2 py-1 bg-green-500 text-white rounded hover:bg-green-600" onclick="return confirm('Are you sure you want to mark this record as manually eligible?')">
                                            Take
                                        </button>
                                    </form>
                                @endif
                                <form action="{{ route('applicantRecords.destroy', $record['id']) }}" method="POST" class="whitespace-nowrap">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-xs px-2 py-1 bg-red-500 text-white rounded hover:bg-red-600" onclick="return confirm('Are you sure you want to delete this record?Application ID - {{ $record['applicant_sr'] }}')">
                                        Delete
                                    </button>
                                </form>
                            </x-table.action_new>
                        </x-table.body_row>
                    @endforeach
                </x-table.body>
            </x-table.wrapper>
            <x-pagination.index route="applicantRecords.index" :meta="$data[0]['meta']" />
        </div>
    </main>
    @vite('resources/js/common/deleteConfirm.js') 
</x-master-layout>
