<x-master-layout name="SingleEduEligibleMark" headerName="{{ __('sidebar.singleEduEligibleMark') }}">
   <main class="h-full overflow-y-auto">
        <div class="container px-1 md:px-6 mx-auto grid">
            <x-table.wrapper>
                <x-table.header :fields="['exam_type','sub_1','sub_2','sub_3','sub_4','sub_5','sub_6']" />
                <x-table.body :data="$data">
                    @foreach ($data['data'] as $record)
                        <x-table.body_row>
                            <x-table.body_column :field="$record['exam_type']" />
                            <x-table.body_column :field="$record['sub_1']" />
                            <x-table.body_column :field="$record['sub_2']" />
                            <x-table.body_column :field="$record['sub_3']" />
                            <x-table.body_column :field="$record['sub_4']" />
                            <x-table.body_column :field="$record['sub_5']" />
                            <x-table.body_column :field="$record['sub_6']" />
                            <td class="px-3 py-0.5 me-2 text-end">
                                <a href="{{ route('singleEduEligibleMarks.edit', $record['id']) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded">
                                    Edit
                                </a>
                            </td>
                        </x-table.body_row>
                    @endforeach
                </x-table.body>
            </x-table.wrapper>
        </div>
    </main>
    @vite('resources/js/common/deleteConfirm.js') 
</x-master-layout>
