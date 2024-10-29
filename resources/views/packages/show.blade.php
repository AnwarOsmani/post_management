{{-- resources/views/packages/show.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Package Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-4">
                        <h1 class="text-2xl font-semibold">Package Details</h1>
                        <x-primary-button onclick="printPackageDetails()">Print</x-primary-button>
                    </div>

                    <x-alert-messages />

                    <div id="printableArea" class="mt-6">
                        <div>
                            <p><strong>Sender Name:</strong> {{ $request->sender_name }}</p>
                            <p><strong>Sender Postal Code:</strong> {{ $request->sender_postal_code }}</p>
                            <p><strong>Receiver Name:</strong> {{ $request->receiver_name }}</p>
                            <p><strong>Receiver Postal Code:</strong> {{ $request->receiver_postal_code }}</p>
                        </div>

                        <div class="my-8">
                            <h3 class="font-semibold text-xl mb-2">Tracking Number:</h3>
                            <p class="text-3xl font-bold mb-4">{{ $package->tracking_number }}</p>
                            <img src="data:image/png;base64,{{ $barcode }}" alt="Barcode for Tracking Number" />
                        </div>
                    </div>

                    <x-link href="{{ route('worker.dashboard') }}">Back to Dashboard</x-link>
                </div>
            </div>
        </div>
    </div>

    <script>
        function printPackageDetails() {
            const printableArea = document.getElementById('printableArea').innerHTML;
            const originalContents = document.body.innerHTML;

            document.body.innerHTML = printableArea;
            window.print();
            document.body.innerHTML = originalContents;
            location.reload();
        }
    </script>
</x-app-layout>