<!-- resources/views/barcode/scan.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Barcode Scan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-2xl font-semibold mb-4">Scan Package Barcode</h1>

                    {{-- Success/Error Message --}}
                    @if (session('success'))
                        <div class="bg-green-100 text-green-800 p-4 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="bg-red-100 text-red-800 p-4 rounded mb-4">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form action="{{ route('barcode.process') }}" method="POST">
                        @csrf
                        <label for="barcode" class="block text-gray-700 font-semibold">Enter or Scan Barcode</label>
                        <input type="text" id="barcode" name="barcode"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" autofocus required>
                        <button type="submit"
                            class="mt-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Process Scan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>