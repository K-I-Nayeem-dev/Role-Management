<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('User / Create') }}
            </h2>
            <a href="{{ route('users.index') }}" class="bg-slate-700 py-2 rounded shadow-lg px-4 mt-2 text-sm text-white">Back</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl  mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 ">
                    <form method="POST" action="{{ route('users.update', $user->id) }}">
                        @csrf
                        @method('PUT')
                        <div>
                            <label for="name" class="text-lg mb-2">Name</label>
                            <div class="mb-3">
                                <input type="text" name="name"
                                    class="text-lg font-medium shadow-lg rounded w-1/2 border-gray-300 text-black"
                                    placeholder="Enter Name" value="{{ old('name', $user->name) }}">
                                @error('name')
                                    <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <label for="email" class="text-lg mb-2">Email</label>
                            <div class="mb-3">
                                <input type="text" name="email"
                                    class="text-lg font-medium shadow-lg rounded w-1/2 border-gray-300 text-black"
                                    placeholder="Enter Email" value="{{ old('email', $user->email) }}">
                                @error('email')
                                    <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class='grid grid-cols-4'>
                                {{-- For Roles select --}}
                                @if ($roles->isNotEmpty())
                                    @foreach ($roles as $role)
                                        <div class="mt-3">
                                            <input {{ $hasRoles->contains($role->id) ? 'checked' : ' ' }} type="checkbox" id="{{ $role->id }}" name="role[]" class="rounded" value="{{ $role->name }}">
                                            <label for="{{ $role->id }}">{{ $role->name }}</label>
                                        </div>
                                    @endforeach
                                @endif
                                @error('role')
                                    <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <button class="bg-slate-700 py-2 rounded shadow-lg px-4 mt-3 text-sm hover:bg-slate-500" >Update</button>
                            <a href="{{ route('users.index') }}" class="bg-slate-700 py-2 rounded shadow-lg px-4 ms-1 mt-3 hover:bg-slate-500 text-sm">Back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
