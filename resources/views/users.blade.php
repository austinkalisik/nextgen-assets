<x-app-layout>

    <div class="space-y-8">

        <!-- HEADER -->
        <div>
            <h1 class="text-3xl font-bold text-slate-800">User Management</h1>
            <p class="text-sm text-gray-500">Manage system users and access</p>
        </div>

        <!-- SUCCESS -->
        @if(session('success'))
            <div class="p-4 text-green-700 bg-green-100 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <!-- ERRORS -->
        @if ($errors->any())
            <div class="p-4 text-red-700 bg-red-100 rounded-lg">
                @foreach ($errors->all() as $error)
                    <div>• {{ $error }}</div>
                @endforeach
            </div>
        @endif

        <!-- ADD USER -->
        <div class="p-6 bg-white border shadow rounded-xl">
            <h3 class="mb-4 text-lg font-semibold text-gray-700">Add New User</h3>

            <form method="POST" action="{{ route('users.store') }}" class="grid gap-4 md:grid-cols-4">
                @csrf

                <input name="name" placeholder="Full Name" class="px-4 py-2 border rounded-lg" required>
                <input name="email" type="email" placeholder="Email" class="px-4 py-2 border rounded-lg" required>
                <input name="password" type="password" placeholder="Password" class="px-4 py-2 border rounded-lg"
                    required>

                <button class="text-white bg-green-600 rounded-lg hover:bg-green-700">
                    + Add User
                </button>
            </form>
        </div>

        <!-- SEARCH -->
        <div class="p-4 bg-white border shadow rounded-xl">
            <form method="GET" action="{{ route('users') }}" class="flex gap-2">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search users..."
                    class="w-full px-4 py-2 border rounded-lg">

                <button class="px-4 py-2 text-white bg-blue-600 rounded-lg">
                    Search
                </button>
            </form>
        </div>

        <!-- TABLE -->
        <div class="overflow-hidden bg-white shadow rounded-2xl">

            <div class="flex items-center justify-between px-6 py-4 border-b bg-slate-50">
                <h3 class="font-semibold text-gray-700">All Users</h3>
                <span class="text-sm text-gray-400">{{ $users->total() }} total</span>
            </div>

            <table class="w-full text-sm">
                <thead class="text-xs text-gray-600 uppercase bg-slate-50">
                    <tr>
                        <th class="px-6 py-4 text-left">Name</th>
                        <th class="px-6 py-4 text-left">Email</th>
                        <th class="px-6 py-4 text-left">Joined</th>
                        <th class="px-6 py-4 text-center">Actions</th>
                    </tr>
                </thead>

                <tbody class="divide-y">
                    @forelse($users as $user)
                        <tr class="hover:bg-slate-50">

                            <td class="px-6 py-4 font-medium">{{ $user->name }}</td>
                            <td class="px-6 py-4">{{ $user->email }}</td>
                            <td class="px-6 py-4 text-gray-400">
                                {{ optional($user->created_at)->format('M d, Y') }}
                            </td>

                            <td class="px-6 py-4 text-center">
                                <div class="flex justify-center gap-2">

                                    <a href="{{ route('users.edit', $user->id) }}"
                                        class="px-3 py-1 text-white bg-blue-500 rounded-lg">
                                        Edit
                                    </a>

                                    <form method="POST" action="{{ route('users.destroy', $user->id) }}">
                                        @csrf
                                        @method('DELETE')

                                        <button onclick="return confirm('Delete this user?')"
                                            class="px-3 py-1 text-white bg-red-500 rounded-lg">
                                            Delete
                                        </button>
                                    </form>

                                </div>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-10 text-center text-gray-400">
                                No users found
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="p-4">
                {{ $users->links() }}
            </div>

        </div>

    </div>

</x-app-layout>