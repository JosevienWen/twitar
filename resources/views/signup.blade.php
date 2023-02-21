@extends('./template/template')
{{-- @include('.template/navbar') --}}

@section('title')
Twitar
@endsection

@section('content')
<section class="bg-gray-50">
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
        <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 ">
            <img class="h-12" src="./images/twitar.png" alt="logo">
        </a>
        <div class="w-full bg-white rounded-lg shadow  md:mt-0 sm:max-w-md xl:p-0 ">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl ">
                    Sign up your account
                </h1>
                <form class="space-y-4 md:space-y-6" action="/register" method="post">
                    @csrf

                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 ">Your
                            email</label>
                        <input type="email" name="email" id="email"
                            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 "
                            placeholder="name@company.com" required="">
                    </div>
                    <div>
                        <label for="username" class="block mb-2 text-sm font-medium text-gray-900 ">Your
                            username</label>
                        <input type="username" name="username" id="username"
                            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 "
                            placeholder="johndoe" required="">
                    </div>
                    <div>
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 ">Password</label>
                        <input type="password" name="password" id="password" placeholder="••••••••"
                            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 "
                            required="">
                    </div>
                    <button type="submit"
                        class="w-full text-white bg-bluetwitar focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center">Sign
                        Up</button>
                    <p class="text-sm text-center font-light text-gray-500 ">
                        Already have account? <a href="/" class="font-medium text-primary-600 hover:underline ">Sign
                            in</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection