<x-master-layout name="EducationEligibleScore" headerName="{{ __('sidebar.educationEligibleScore') }}">
   <main class="h-full overflow-y-auto">
        <div class="container px-1 md:px-6 mx-auto grid">
            <div class="container md:flex justify-start md:justify-between items-start mx-auto mt-5">
                <x-common.create_button route="educationEligibleScores.create" permission="create educationEligibleScores" />
                <div class="flex flex-col md:flex-row gap-2 md:gap-4">
                    <select name="exam_type" id="exam_type" onchange="if(this.value) window.location.href='{{ route('educationEligibleScores.index') }}?exam_type=' + this.value" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <option value="">All Exam Types</option>
                        @foreach(App\Enums\ExamType::getLabel() as $key => $value)
                            <option value="{{ $key }}" {{ request()->exam_type == $key ? 'selected' : '' }}>
                                {{ $value }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <x-table.wrapper>
                <x-table.header :fields="['exam_type','margin_score','eligible_score']" />
                <x-table.body :data="$data">
                    @foreach ($data['data'] as $record)
                        <x-table.body_row>
                            <x-table.body_column :field="$record['exam_type']" limit="20" />
                            <x-table.body_column :field="$record['margin_score']" limit="20" />
                            <x-table.body_column :field="$record['eligible_score']" limit="20" />
                            <td class="px-3 py-0.5 me-2 text-end">
                                <a href="{{ route('educationEligibleScores.edit', $record['id']) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded">
                                    Edit
                                </a>
                            </td>
                        </x-table.body_row>
                    @endforeach
                </x-table.body>
            </x-table.wrapper>
            <x-pagination.index route="educationEligibleScores.index" :meta="$data['meta']" />
        </div>
    </main>
    @vite('resources/js/common/deleteConfirm.js') 
</x-master-layout>
