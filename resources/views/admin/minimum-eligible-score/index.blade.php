<x-master-layout name="MinimumEligibleScore" headerName="{{ __('sidebar.minimumEligibleScore') }}">
   <main class="h-full overflow-y-auto">
        <div class="container px-1 md:px-6 mx-auto grid">
            <div class="container md:flex justify-start md:justify-between items-start mx-auto mt-5">
                <x-common.search keyword="{{ request()->keyword }}" />
            </div>
            <x-table.wrapper>
                <x-table.header :fields="['min_education','min_program','min_activity','min_essay','min_mental']" />
                <x-table.body :data="$data">
                    @foreach ($data['data'] as $record)
                        <x-table.body_row>
                            <x-table.body_column :field="$record['min_education']" />
                            <x-table.body_column :field="$record['min_program']" />
                            <x-table.body_column :field="$record['min_activity']" />
                            <x-table.body_column :field="$record['min_essay']" />
                            <x-table.body_column :field="$record['min_mental']" />
                            <td class="px-3 py-0.5 me-2 text-end">
                                <a href="{{ route('minimumEligibleScores.edit', $record['id']) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded">
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
