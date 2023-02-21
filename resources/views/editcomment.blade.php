@extends('./template/template')
@include('.template/navbar')

@section('title')
Twitar
@endsection

@section('content')
<section class="bg-gray-50">
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
        <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 ">
            <img class="h-12" src="/images/twitar.png" alt="logo">
        </a>
        <div class="w-full bg-white rounded-lg shadow  md:mt-0 sm:max-w-md xl:p-0 ">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl ">
                    Edit Comment
                </h1>
                <form class="space-y-4 md:space-y-6" action="/updatecomment/{{ $data->id }}" method="post"
                    enctype="multipart/form-data">
                    @csrf

                    <div>
                        <label for="comment" class="block mb-2 text-sm font-medium text-gray-900 ">Caption</label>
                        <input type="text" name="comment" id="comment"
                            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 "
                            placeholder="This is my comment" value="{{ $data->comment }}"" required="">
                    </div>

                    <div>
                        <label for=" tags" class="block mb-2 text-sm font-medium text-gray-900 ">Tags</label>
                        <input type="text" name="tags" id="tags"
                            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 "
                            placeholder="Alphabet, Numbers (Divide using comma)" value="{{ $data->tags }}"" required="">
                    </div>
                    
                    <div>
                        <label for=" media" class="block mb-2 text-sm font-medium text-gray-900 ">Media</label>
                        <input
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50"
                            aria-describedby="user_avatar_help" id="media" name="media" type="file"
                            value="{{ $data->media }}">
                    </div>
                    <button type="submit"
                        class="w-full text-white bg-bluetwitar focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center">Update
                        Comment</button>
                </form>

                <p class="text-sm text-center font-light text-gray-500 ">
                    <a href="/home" class="font-medium text-primary-600 hover:underline ">Cancel</a>
                </p>
            </div>
        </div>
    </div>
</section>
@endsection