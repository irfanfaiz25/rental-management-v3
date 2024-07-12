<div class="min-h-screen bg-[#1a1a1a] flex flex-col justify-center sm:py-12">
    <div class="p-10 xs:p-0 mx-auto md:w-full md:max-w-md">
        <div class="flex justify-center mb-2">
            <img src="{{ asset('img/Logo.png') }}" alt="logo" width="60">
        </div>
        <div class="bg-[#252525] shadow w-full rounded-lg divide-y divide-gray-200">
            <div class="px-5 py-16">
                <form wire:submit.prevent='login'>
                    <label class="font-semibold text-sm text-gray-50 pb-1 block">Username</label>
                    <input wire:model='username' type="text"
                        class="border rounded-lg px-3 py-2 mt-1 mb-5 text-sm w-full bg-[#373737] text-gray-50" />
                    <label class="font-semibold text-sm text-gray-50 pb-1 block">Password</label>
                    <input wire:model='password' type="password"
                        class="border rounded-lg px-3 py-2 mt-1 mb-5 text-sm w-full bg-[#373737] text-gray-50" />
                    <button type="submit"
                        class="transition duration-200 bg-green-500 hover:bg-green-600 focus:bg-green-700 focus:shadow-sm focus:ring-4 focus:ring-blue-500 focus:ring-opacity-50 text-white w-full py-2.5 rounded-lg text-sm shadow-sm hover:shadow-md font-semibold text-center inline-block">
                        <span class="inline-block mr-2">Login</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            class="w-4 h-4 inline-block">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </button>
                </form>
                @if (session('invalid'))
                    <div id="alert-notification"
                        class="mb-3 mt-3 px-8 py-6 bg-red-500 text-white flex justify-between rounded">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="28" height="28"
                                fill="currentColor">
                                <path
                                    d="M12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22ZM12 20C16.4183 20 20 16.4183 20 12C20 7.58172 16.4183 4 12 4C7.58172 4 4 7.58172 4 12C4 16.4183 7.58172 20 12 20ZM11.0026 16L6.75999 11.7574L8.17421 10.3431L11.0026 13.1716L16.6595 7.51472L18.0737 8.92893L11.0026 16Z">
                                </path>
                            </svg>
                            <p class="pl-3">{{ session('invalid') }}</p>
                        </div>
                        <button onclick="hideAlert()" class="text-red-100 hover:text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
