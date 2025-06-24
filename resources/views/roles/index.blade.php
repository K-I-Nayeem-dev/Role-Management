<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Roles') }}
            </h2>
            <a href="{{ route('roles.create') }}"
                class="bg-slate-700 py-3 rounded shadow-lg px-3 mt-2 text-sm text-white">Create</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-message></x-message>

            <table class="w-full">
                <thead class="bg-gray-50 rounded">
                    <tr class="border-b">
                        <th class="px-6 py-3 text-left">#</th>
                        <th class="px-6 py-3 text-left">Name</th>
                        <th class="px-6 py-3 text-left">Permissions</th>
                        <th class="px-6 py-3 text-left">Created</th>
                        <th class="px-6 py-3 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @if ($roles->isNotEmpty())
                        @forelse ($roles as $role)
                            <tr class="border-b">
                                <td class="px-6 py-3 text-left" width="60">
                                    {{ $role->id }}
                                </td>
                                <td class="px-6 py-3 text-left">
                                    {{ $role->name }}
                                </td>
                                <td class="px-6 py-3 text-left">
                                    {{ $role->permissions->pluck('name')->implode(' , ') }}
                                </td>
                                <td class="px-6 py-3 text-left" width="150">
                                    {{ $role->created_at->format('d M, Y') }}
                                </td>
                                <td class="px-6 py-3 text-center" width="180">
                                    <div class="flex justify-between">
                                        <a href="{{ route('roles.edit', $role->id) }}"
                                            class="bg-slate-700 hover:bg-slate-600 py-3 rounded shadow-lg px-3 mt-2 text-sm text-white">Edit</a>
                                        <form method="POST"
                                            action="{{ route('roles.destroy', $role->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button onclick="confirm('Are You sure you want to delete')"
                                                class="bg-red-500 hover:bg-red-400 py-3 rounded shadow-lg px-3 mt-2 text-sm text-white">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                        @endforelse
                    @else
                        <tr>
                            <td class="px-6 py-3 text-center" colspan="5">
                                <p>No Permission Found</p>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
            <div class="mt-3">
                {{ $roles->links() }}
            </div>

        </div>
    </div>
</x-app-layout>
