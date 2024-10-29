<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Requests related to your postal office') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if ($requests->isEmpty())
                        <p>No delivery requests found.</p>
                    @else
                        <x-table>
                            <thead>
                                <x-tr>
                                    <x-th>Sender</x-th>
                                    <x-th>Receiver</x-th>
                                    <x-th>Date</x-th>
                                    <x-th>Status</x-th>
                                    <x-th>Actions</x-th>
                                </x-tr>
                            </thead>
                            <tbody>
                                @foreach ($requests as $request)
                                    <x-tr>
                                        <x-td>{{ $request->sender_name }}</x-td>
                                        <x-td>{{ $request->receiver_name }}</x-td>
                                        <x-td>{{ $request->created_at->format('Y-m-d') }}</x-td>
                                        <x-td>{{ ucfirst($request->status) }}</x-td>
                                        <x-td>
                                            <!-- Optional actions for each request, such as view or edit -->
                                        </x-td>
                                    </x-tr>
                                @endforeach
                            </tbody>
                        </x-table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
