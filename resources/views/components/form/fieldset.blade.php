@props(['title','openTag'=>true])
<div class="relative border border-gray-200 rounded-lg shadow-md hover:shadow-xl my-4 lg:my-12">
    <div class="flex items-center justify-between px-4 py-2 cursor-pointer fieldset-header">
        <p class="bg-gray-50 dark:bg-gray-600 dark:text-white px-2 text-md select-none">{{ __($title) }}</p>
        <button type="button" class="text-gray-500">
            <svg class="w-5 h-5 chevron-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
        </button>
    </div>
    <div class="p-4 fieldset-content {{ $openTag==false ? 'hidden' : '' }}">
        {{ $slot }}
    </div>
</div>