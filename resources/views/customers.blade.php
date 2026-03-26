<x-app-layout>

    <div class="space-y-6">

        <h1 class="text-2xl font-bold">Customers</h1>

        <!-- ADD CUSTOMER -->
        <form method="POST" action="{{ route('customers.store') }}" class="flex gap-2">
            @csrf
            <input name="name" placeholder="Name" class="p-2 border">
            <input name="email" placeholder="Email" class="p-2 border">
            <input name="phone" placeholder="Phone" class="p-2 border">
            <input name="address" placeholder="Address" class="p-2 border">

            <button class="px-4 text-white bg-blue-600">Add</button>
        </form>

        <!-- TABLE -->
        <table class="w-full mt-4">
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Action</th>
            </tr>

            @foreach($customers as $customer)
                <tr>
                    <td>{{ $customer->name }}</td>
                    <td>{{ $customer->email }}</td>
                    <td>
                        <form method="POST" action="/customers/{{ $customer->id }}">
                            @csrf
                            @method('DELETE')
                            <button class="px-2 text-white bg-red-500">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach

        </table>

    </div>

</x-app-layout>