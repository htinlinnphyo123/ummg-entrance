<header class="z-10 py-4 bg-white shadow-md dark:bg-gray-800">
    <div class="flex flex-row">
        <div>
            <button class="p-1 mr-5 ml-2 rounded-md focus:outline-none focus:shadow-outline-purple dark:text-white"
                aria-label="Menu" id="">
                <svg id="menuShowHide" class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" class="" id="menuHide"
                        d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                        clip-rule="evenodd">
                    </path>
                    <path clip-rule="evenodd" fill-rule="evenodd" class="hidden" id="menuShow"
                        d="M5.47 5.47a.75.75 0 011.06 0L12 10.94l5.47-5.47a.75.75 0 111.06 1.06L13.06 12l5.47 5.47a.75.75 0 11-1.06 1.06L12 13.06l-5.47 5.47a.75.75 0 01-1.06-1.06L10.94 12 5.47 6.53a.75.75 0 010-1.06z">
                    </path>
                </svg>
            </button>
        </div>
        <div
            class="container flex items-center justify-between h-full md:pr-6 mx-auto text-purple-600 dark:text-purple-300">
            <!-- Mobile hamburger -->
            <!-- Search input -->
            <div class="items-center font-semibold text-gray-600 md:text-3xl dark:text-white" id="headerName">
                {{ $headerName }}
            </div>
            <ul class="flex items-center justify-between sm:justify-end flex-shrink-0 space-x-6 md:mt-1 me-2">
                <!-- Profile menu -->

                {{-- id="dropdownDefaultButton" data-dropdown-toggle="dropdown" --}}
                <li class="flex">
                    <div class="text-gray-600 dark:text-gray-300" id="greetings"></div>
                </li>

                <script>
                    const greetingsElement = document.getElementById('greetings');
                    const currentHour = new Date().getHours();
                    
                    let greeting = '';
                    if (currentHour >= 5 && currentHour < 12) {
                        greeting = 'Good Morning';
                    } else if (currentHour >= 12 && currentHour < 18) {
                        greeting = 'Good Afternoon';
                    } else {
                        greeting = 'Good Night';
                    }
                    
                    greetingsElement.textContent = greeting;
                </script>
            </ul>
        </div>
    </div>
    <input type="hidden" value="{{ __('messages.are_you_sure') }}" id="r-u-sure">
    <input type="hidden" value="{{ __('messages.login_again') }}" id="login-again">
    <input type="hidden" value="{{ __('messages.yes_logout') }}" id="yes-logout">
    <input type="hidden" value="{{ __('messages.cancel') }}" id="cancel">
    @vite('resources/js/common/logoutConfirm.js')
</header>