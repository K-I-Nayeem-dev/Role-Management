<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Article / Create') }}
            </h2>
            <a href="{{ route('articles.index') }}"
                class="bg-slate-700 py-2 rounded shadow-lg px-4 mt-2 text-sm text-white">Back</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl  mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 ">
                    <form method="POST" action="{{ route('articles.store') }}">
                        @csrf
                        <div>
                            <label for="title" class="text-lg mb-2">Title</label>
                            <div class="mb-3">
                                <input type="text" name="title" id="title"
                                    class="text-lg font-medium shadow-lg rounded w-1/2 border-gray-300 text-black"
                                    placeholder="Enter Title" value="{{ old('title') }}">
                                @error('title')
                                    <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <label for="text" class="text-lg mb-2">Content</label>
                            <div class="mb-3">
                                <textarea type="text" name="text" id="text" rows="4" cols="50"
                                    class="text-lg font-medium shadow-lg rounded w-1/2 border-gray-300 text-black"
                                    placeholder="Content">{{ old('text') }}</textarea>
                                @error('text')
                                    <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <label for="author" class="text-lg mb-2">Author</label>
                            <div class="mb-3">
                                <input type="text" name="author" id="author"
                                    class="text-lg font-medium shadow-lg rounded w-1/2 border-gray-300 text-black"
                                    placeholder="Author Name" value="{{ old('author') }}">
                                @error('author')
                                    <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <button class="bg-slate-700 py-2 rounded shadow-lg px-4 mt-2 text-sm">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
