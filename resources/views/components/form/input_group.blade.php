@props([
    'title', 
    'type' => 'text', 
    'name', 
    'value' => null,
    'id' => null, 
    'containerId' => null,
    'required' => false, 
    'playEye' => false,
    'placeholder'=> null,
    'helperText' => null,
    'ajaxError' => null,
    'class' => '',
    'customAttributes' => [], 
    'disabled' => false,
    'labelID' => null,
])
<x-form.control :id="$containerId">
    <x-form.label :title="$title" :required="$required" :labelID="$labelID"/>
    <div class="{{ $playEye ? 'relative' : '' }}">
        <x-form.input :type="$type" name="{{ $name }}" :id="$id" value="{{ $value }}" :placeholder="$placeholder" :disabled="$disabled" :customAttributes="$customAttributes" />
        @if ($playEye)
            <x-common.loginEyes togglePassword="togglePassword" showEyes="showEyes" removeEyes="removeEyes" />
        @endif
    </div>
    <x-form.helper_text message="{{ $helperText }}" />
    <x-form.error :field="$name" />
    {{ $ajaxError }}
</x-form.control>
