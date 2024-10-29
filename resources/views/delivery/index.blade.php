<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Delivery Requests') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <x-alert-messages />
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
                                        <x-td>
                                            <span
                                                class="{{ $request->status == App\Models\DeliveryRequest::STATUS_IN_POST_OFFICE ? 'text-green-500' : 'text-yellow-500' }}">
                                                {{ ucfirst($request->getStatusLabel()) }}
                                            </span>
                                        </x-td>
                                        <x-td>
                                            @if ($request->status == App\Models\DeliveryRequest::STATUS_CREATED)
                                                <!-- Edit link -->
                                                <a href="{{ route('delivery.request.edit', $request->id) }}"
                                                    class="text-blue-600 hover:text-blue-700 hover:underline mr-4">Edit</a>

                                                <!-- Delete link -->
                                                <a href="{{ route('delivery.request.destroy', $request->id) }}"
                                                    class="text-blue-600 hover:text-blue-700 hover:underline"
                                                    onclick="event.preventDefault(); 
                                                        if(confirm('Are you sure you want to delete this request?')) {
                                                            document.getElementById('delete-form-{{ $request->id }}').submit();
                                                        }">Delete</a>

                                                <!-- Hidden Delete Form -->
                                                <form id="delete-form-{{ $request->id }}"
                                                    action="{{ route('delivery.request.destroy', $request->id) }}"
                                                    method="POST" style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            @else
                                                <span class="text-gray-500">No actions available</span>
                                            @endif
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
