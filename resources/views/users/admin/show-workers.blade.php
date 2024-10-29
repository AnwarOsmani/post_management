<x-app-layout>
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

                    <x-alert-messages />

                    {{-- Workers Table --}}
                    <x-table>
                        <thead>
                            <x-tr>
                                <x-th>Name</x-th>
                                <x-th>Email</x-th>
                                <x-th>Actions</x-th>
                            </x-tr>
                        </thead>
                        <tbody>
                            @foreach ($workers as $worker)
                                <x-tr>
                                    <x-td>{{ $worker->user->name }}</x-td>
                                    <x-td>{{ $worker->user->email }}</x-td>
                                    <x-td>
                                        <!-- Edit link -->
                                        {{ $currentWorkerID = $worker->id }}
                                        <a href="{{ route('delivery.request.edit', $currentWorkerID) }}"
                                            class="text-blue-600 hover:text-blue-700 hover:underline mr-4">Edit</a>

                                        <!-- Delete link -->
                                        <a href="{{ route('admin.worker.destroy', $currentWorkerID) }}"
                                            class="text-blue-600 hover:text-blue-700 hover:underline"
                                            onclick="event.preventDefault(); 
                                                if(confirm('Are you sure you want to delete this worker?')) {
                                                    document.getElementById('delete-form-{{ $currentWorkerID }}').submit();
                                                }">Delete</a>

                                        <!-- Hidden Delete Form -->
                                        <form id="delete-form-{{ $currentWorkerID }}"
                                            action="{{ route('admin.worker.destroy', $currentWorkerID) }}"
                                            method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </x-td>
                                </x-tr>
                            @endforeach
                        </tbody>
                    </x-table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
