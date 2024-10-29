<x-admin-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Your Workers') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <h1 class="text-2xl font-semibold mb-4">Workers List</h1>

                    {{-- Success Message --}}
                    @if (session('success'))
                        <div class="bg-green-100 text-green-800 p-4 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    {{-- Workers Table --}}
                    <table class="min-w-full leading-normal">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">Name</th>
                                <th class="px-4 py-2">Email</th>
                                <th class="px-4 py-2">Postal Code</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($workers as $worker)
                                <tr class="bg-white border-b">
                                    <td class="px-4 py-2">{{ $worker->user->name }}</td>
                                    <td class="px-4 py-2">{{ $worker->user->email }}</td>
                                    <td class="px-4 py-2">{{ $worker->postal_code }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</x-admin-app-layout>