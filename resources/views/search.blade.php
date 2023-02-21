@extends('./template/template')
@include('.template/navbar')

@section('title')
Twitar
@endsection

@section('content')
<div class="flex items-center mt-8">
    <div class="mx-auto w-2/5">

        <div class="flex flex-row justify-between">
            <p class=" text-3xl">Results</p>
        </div>

        {{-- kondisi untuk menghitung objectnya tidak 0 --}}
        @if (count($data)!==0)
        @foreach ($data as $item)

        {{-- post --}}
        <div class="flex flex-col">
            <div class="flex flex-row justify-between items-center mt-5 mb-5">
                <div class="flex flex-row items-center">
                    <img class="w-14 h-14 rounded-full border" src="{{ asset('img/'. $item -> user -> media ) }}"
                        alt="">
                    <div class="flex flex-col ml-5">
                        <div class="flex flex-row">
                            <p>@
                            <p>{{ $item -> user -> username }}</p>
                            </p>
                        </div>
                        <p class="text-sm text-slate-500">{{ $item->created_at }}</p>
                    </div>
                </div>

                @if (Auth::id()==$item->user->id)
                <button id="dropdownDefaultButton" data-dropdown-toggle="tweets{{ $item->id }}" class="text-slate-500"
                    type="button"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-slate-500">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M6.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM12.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM18.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                    </svg></button>
                <!-- Dropdown menu -->
                <div id="tweets{{ $item->id }}"
                    class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
                        <li>
                            <a href="/edittweets/{{ $item->id }}"
                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Edit
                                Posts</a>
                        </li>
                        <li>
                            <a href="/destroytweets/{{ $item->id }}"
                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Delete
                                Posts</a>
                        </li>
                    </ul>
                </div>
                @else

                @endif
            </div>
            <p class="text-lg mb-2 truncate">{{ $item->tweets }}</p>
            <img src="{{ asset('img/'. $item->media ) }}" class="w-full h-[500px] border mb-5" alt="">

            <p class="text-sm mb-2 text-slate-300">Tags : {{ $item->tags }}</p>



            {{-- jika comments = 0 tidak akan muncul apa apa, tetapi jika ada comments akan muncul yang di else --}}
            @if (count($item->comments)==0)

            @else
            <div class="flex flex-row justify-between mb-5 mt-5">
                <p class=" text-3xl">Comments</p>
            </div>

            @endif


            @foreach ($item->comments as $item1)
            {{-- comment --}}
            <div class="flex flex-col mt-5">
                <div class="flex flex-row justify-between items-start">
                    <div class="flex flex-row items-start">
                        <img class="w-14 h-14 rounded-full border" src="{{ asset('img/'. $item1->user->media ) }}"
                            alt="">
                        <div class="flex flex-col ml-5">
                            <div class="flex flex-row">
                                <p>@
                                <p>{{ $item1 -> user -> username }}</p>
                                </p>
                            </div>
                            <p class="text-sm text-slate-500">{{ $item1->created_at }}</p>
                            <p class="text-lg mt-3">{{ $item1->comment }}</p>
                            <img src="{{ asset('img/'. $item1->media ) }}" class="w-full h-[400px] border mb-5" alt="">
                            <p class="text-sm mb-2 text-slate-300">Tags : {{ $item1->tags }}</p>
                        </div>
                    </div>

                    @if (Auth::id()==$item1->user->id)
                    <button id="dropdownDefaultButton" data-dropdown-toggle="comment{{ $item1->id }}"
                        class="text-slate-500" type="button"><svg xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-slate-500">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M6.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM12.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM18.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                        </svg></button>
                    <!-- Dropdown menu -->
                    <div id="comment{{ $item1->id }}"
                        class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                            aria-labelledby="dropdownDefaultButton">
                            <li>
                                <a href="/editcomment/{{ $item1->id }}"
                                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Edit
                                    Comment</a>
                            </li>
                            <li>
                                <a href="/destroycomment/{{ $item1->id }}"
                                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Delete
                                    Comment</a>
                            </li>
                        </ul>
                    </div>
                    @else
                    @endif
                </div>
                @endforeach
                <hr class="mt-5 mb-5">
            </div>
            @endforeach

            {{-- jika post tidak ada tags yang tersedia post maka akan menampilkan comment saja --}}
            @else
            @foreach ($data2 as $item2)

            {{-- comment --}}
            <div class="flex flex-col mt-5">
                <div class="flex flex-row justify-between items-start">
                    <div class="flex flex-row items-start">
                        <img class="w-14 h-14 rounded-full border" src="{{ asset('img/'. $item2->user->media ) }}"
                            alt="">
                        <div class="flex flex-col ml-5">
                            <div class="flex flex-row">
                                <p>@
                                <p>{{ $item2 -> user -> username }}</p>
                                </p>
                            </div>
                            <p class="text-sm text-slate-500">{{ $item2->created_at }}</p>
                            <p class="text-lg mt-3 truncate">{{ $item2->comment }}</p>
                            <img src="{{ asset('img/'. $item2->media ) }}" class="w-full h-[400px] border mb-5" alt="">
                            <p class="text-sm mb-2 text-slate-300">Tags : {{ $item2->tags }}</p>
                        </div>
                    </div>

                    @if (Auth::id()==$item2->user->id)
                    <button id="dropdownDefaultButton" data-dropdown-toggle="comment{{ $item2->id }}"
                        class="text-slate-500" type="button"><svg xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-slate-500">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M6.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM12.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM18.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                        </svg></button>
                    <!-- Dropdown menu -->
                    <div id="comment{{ $item2->id }}"
                        class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                            aria-labelledby="dropdownDefaultButton">
                            <li>
                                <a href="/editcomment/{{ $item2->id }}"
                                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Edit
                                    Comment</a>
                            </li>
                            <li>
                                <a href="/destroycomment/{{ $item2->id }}"
                                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Delete
                                    Comment</a>
                            </li>
                        </ul>
                    </div>
                    @else
                    @endif
                </div>
                <hr class="mt-5 mb-5">
                @endforeach
                @endif
            </div>
            @endsection