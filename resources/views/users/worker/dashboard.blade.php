<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-2xl font-semibold mb-4">Assigned Delivery Requests</h1>

                    {{-- Display any success messages --}}
                    <x-alert-messages />

                    {{-- If there are no requests --}}
                    @if ($requests->isEmpty())
                        <p class="text-gray-600">No delivery requests assigned to you.</p>
                    @else
                        {{-- Display assigned requests --}}
                        <x-table>
                            <thead>
                                <x-tr>
                                    <x-th>Sender Postal Code</x-th>
                                    <x-th>Receiver Postal Code</x-th>
                                    <x-th>Status</x-th>
                                    <x-th>Options</x-th>
                                </x-tr>
                            </thead>
                            <tbody>
                                @foreach ($requests as $request)
                                    <x-tr>
                                        <x-td>{{ $request->sender_postal_code }}</x-td>
                                        <x-td>{{ $request->receiver_postal_code }}</x-td>
                                        <x-td>
                                            <span
                                                class="{{ $request->status == App\Models\DeliveryRequest::STATUS_IN_POST_OFFICE ? 'text-green-500' : 'text-yellow-500' }}">
                                                {{ ucfirst($request->getStatusLabel()) }}
                                            </span>
                                        </x-td>
                                        <x-td>
                                            <div class="flex space-x-4">
                                                @if (!$request->package)
                                                    <a href="{{ route('package.create', $request->id) }}"
                                                        class="text-green-600 hover:text-green-700 hover:underline">Add
                                                        Package</a>
                                                @else
                                                    <a href="{{ route('package.show', $request->package->id) }}"
                                                        class="text-green-600 hover:text-green-700 hover:underline">View
                                                        Package Details</a>
                                                @endif
                                            </div>
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
