<x-app-layout>

    <div class="max-w-xl mx-auto p-6 bg-white shadow rounded-xl mt-6">

        <h2 class="text-xl font-bold mb-4">Edit User</h2>

        <form method="POST" action="{{ route('users.update', $user->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-sm">Name</label>
                <input type="text" name="name" value="{{ $user->name }}" class="w-full border rounded px-3 py-2">
            </div>

            <div class="mb-4">
                <label class="block text-sm">Email</label>
                <input type="email" name="email" value="{{ $user->email }}" class="w-full border rounded px-3 py-2">
            </div>

            <button class="px-4 py-2 bg-blue-600 text-white rounded">
                Update User
            </button>

        </form>

    </div>

</x-app-layout>