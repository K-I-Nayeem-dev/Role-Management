<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between align-items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Permissions') }}
            </h2>
            <a href="{{ route('permission.create') }}"
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
                        <th class="px-6 py-3 text-left">Created</th>
                        <th class="px-6 py-3 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @if ($permissions->isNotEmpty())
                        @foreach ($permissions as $permission)
                            <tr class="border-b">
                                <td class="px-6 py-3 text-left" width="60">
                                    {{ $permission->id }}
                                </td>
                                <td class="px-6 py-3 text-left">
                                    {{ $permission->name }}
                                </td>
                                <td class="px-6 py-3 text-left" width="150">
                                    {{ $permission->created_at->format('d M, Y') }}
                                </td>
                                <td class="px-6 py-3 text-center" width="180">
                                    <div class="flex justify-between">
                                        <a href="{{ route('permission.edit', $permission->id) }}"
                                        class="bg-slate-700 hover:bg-slate-600 py-3 rounded shadow-lg px-3 mt-2 text-sm text-white">Edit</a>
                                        <form method="POST" action="{{ route('permission.destroy', $permission->id) }}">
                                            @csrf
                                            @method("DELETE")
                                            <button onclick="confirm('Are You sure you want to delete')" class="bg-red-500 hover:bg-red-400 py-3 rounded shadow-lg px-3 mt-2 text-sm text-white">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
            <div class="mt-3">
                {{ $permissions->links() }}
            </div>
        </div>
    </div>

    {{-- <x-slot name="script">
        <script type="text/javascript">
            function deletePermission(id){
                if (confirm('Are you sure you Want to delete')) {
                    $.ajax({
                        url : '{{ route("permission.destroy") }}',
                        type : 'delete',
                        data : {id:id},
                        dataType : 'json',
                        headers : {
                            'x-csrf-token' : {{ csrf_token() }}
                        },
                        success : function(response){
                            window.location.href = {{ route('permission.index') }};
                        }
                    });
                }
            }
        </script>
    </x-slot> --}}

</x-app-layout>
