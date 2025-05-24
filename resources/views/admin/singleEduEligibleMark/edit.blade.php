<x-master-layout name="SingleEduEligibleMark" headerName="{{ __('sidebar.singleEduEligibleMark') }}">
    <x-form.layout>
        <form action="{{ route('singleEduEligibleMarks.update', $data['id']) }}" method="post">
            @csrf
            @method('PUT')
            @php
                $id = $data['id'];
                if($id===1 || $id===2){
                    $sub1='Myanmar';$sub2='English';$sub3='Math';$sub4='Physics';$sub5='Chemistry';$sub6='Biology';
                }elseif($id===3){
                    $sub1='Social';$sub2='RLA';$sub3='Maths';$sub4='Science';
                }else{
                    $sub1='English';$sub2='Math';$sub3='Physics';$sub4='Chemistry';$sub5='Biology';$sub6='X';
                }
            @endphp
            <h2 class="text-xl mb-4 font-bold">
                Edit Minimum Marks for The Exam {{ $data['exam_type'] }}
            </h2>
            <x-form.grid>
                <x-form.input_group type="number" :title="$sub1" name="sub_1" :value="$data['sub_1']" />
                <x-form.input_group type="number" :title="$sub2" name="sub_2" :value="$data['sub_2']" />
                <x-form.input_group type="number" :title="$sub3" name="sub_3" :value="$data['sub_3']" />
                <x-form.input_group type="number" :title="$sub4" name="sub_4" :value="$data['sub_4']" />
                @if ($id!==3)                    
                    <x-form.input_group type="number" :title="$sub5" name="sub_5" :value="$data['sub_5']" />
                    <x-form.input_group type="number" :title="$sub6" name="sub_6" :value="$data['sub_6']" />
                @endif
            </x-form.grid>
            <x-form.submit :operate="__('messages.update')" :cancel="__('messages.cancel')" url="singleEduEligibleMarks.index" />
        </form>
    </x-form.layout>
</x-master-layout>
