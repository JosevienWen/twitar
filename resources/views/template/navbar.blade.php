<nav class="bg-white border-gray-200 px-2 py-2.5 rounded">
    <div class="container flex flex-wrap items-center justify-between mx-auto">
        <a href="/home" class="flex items-center">
            <img src="/images/twitar.png" class="h-8 mr-3" alt="Twitar Logo" />
        </a>

        <div class="flex items-center md:order-2">
            <button id="dropdownDefaultButton" data-dropdown-toggle="dropdownx" class="text-slate-500" type="button">
                <div class="flex flex-row items-center">@<p class="mr-3">{{ Auth::user()->username }}</p>
                    <img class="w-8 h-8 rounded-full" src="{{ asset('img/'. Auth::user()->media ) }}" alt="">
                </div>
            </button>
            <!-- Dropdown menu -->
            <div id="dropdownx"
                class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
                    <li>
                        <a href="/home"
                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                            Home</a>
                    </li>
                    <li>
                        <a href="/profile/{{ Auth::user()->id }}"
                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                            Profile</a>
                    </li>
                    <li>
                        <form class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                            method="POST" action="/logout">
                            @csrf

                            <button class="btn btn-outline-danger" type="submit">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>

        <form action="/search" action="get">
            <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-search">
                <div class="relative hidden md:block">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-500" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Search icon</span>
                    </div>
                    <input type="text" id="search" name="search"
                        class="block w-80 p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Search by tags...">
                </div>
            </div>
        </form>
    </div>
</nav>