@extends('./template/template')
@include('.template/navbar')

@section('title')
Twitar
@endsection

@section('content')
<div class="flex items-center mt-8">
    <div class="mx-auto w-2/5">
        <div class="flex flex-row mb-8">
            <a href="/home">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-10 h-8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18" />
                </svg>
            </a>
            <p class="ml-2 text-3xl">Profile</p>
        </div>

        <div class="flex justify-between items-center mb-8">
            <div class="flex flex-row items-center">
                <img class="w-40 h-40 rounded-full border" src="{{ asset('img/'. Auth::user()->media ) }}" alt="">
                <div class="flex-col ml-5">
                    <div class="flex flex-row">
                        <p class="text-xl">@
                        <p class="text-xl">{{ Auth::user()->username }}</p>
                        </p>
                    </div>
                    <div class="w-14">
                        <p class="text-md text-slate-500">{{ Auth::user()->bio }}</p>
                    </div>
                </div>
            </div>

            <a class="border bg-bluetwitar text-white p-3 rounded-lg" href="/editprofile/{{ Auth::user()->id }}">
                <p>Edit Profile</p>
            </a>
        </div>

        <hr>

        <div class="flex flex-row justify-between mt-8">
            <p class="ml-2 text-3xl">My Posts</p>

            <div class="flex">


                <a class="border bg-bluetwitar text-white p-3 rounded-lg" href="#">
                    <p>Add Post</p>
                </a>
            </div>
        </div>

        @foreach ($data as $item)
        {{-- post --}}
        <div class="flex flex-col">
            <div class="flex flex-row justify-between items-center mt-5 mb-5">
                <div class="flex flex-row items-center">
                    <img class="w-14 h-14 rounded-full border" src="{{ asset('img/'. Auth::user()->media ) }}" alt="">
                    <div class="flex flex-col ml-5">
                        <div class="flex flex-row">
                            <p>@
                            <p>{{ Auth::user()->username }}</p>
                            </p>
                        </div>
                        <p class="text-sm text-slate-500">{{ $item->created_at }}</p>
                    </div>
                </div>

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
            </div>
            <p class="text-lg mb-2 truncate">{{ $item->tweets }}</p>
            <img src="{{ asset('img/'. $item->media ) }}" class="w-full h-[500px] border mb-5" alt="">
            <p class="text-sm mb-2 text-slate-300">Tags : {{ $item->tags }}</p>

            <a href="/post/{{ $item->id }}" class="flex flex-row text-lg">
                <p>See Comments</p>
            </a>

            <hr class="mt-5 mb-5">
        </div>
        @endforeach

    </div>
    @endsection