<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Delivery Request') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="w-1/2 mx-auto p-6 text-gray-900">
                    <x-alert-messages />
                    {{-- Edit Form --}}
                    <form method="POST" action="{{ route('delivery.request.update', $deliveryRequest->id) }}">
                        @csrf
                        @method('PUT')

                        <x-delivery-request-form title="Sender Information" name-id="sender_name"
                            name-value="{{ old('sender_name', $deliveryRequest->sender_name) }}" phone-id="sender_phone"
                            phone-value="{{ old('sender_phone', $deliveryRequest->sender_phone) }}"
                            postal-code-id="sender_postal_code"
                            postal-code-value="{{ old('sender_postal_code', $deliveryRequest->sender_postal_code) }}" />

                        <hr class="my-6">

                        <x-delivery-request-form title="Receiver Information" name-id="receiver_name"
                            name-value="{{ old('receiver_name', $deliveryRequest->receiver_name) }}"
                            phone-id="receiver_phone"
                            phone-value="{{ old('receiver_phone', $deliveryRequest->receiver_phone) }}"
                            postal-code-id="receiver_postal_code"
                            postal-code-value="{{ old('receiver_postal_code', $deliveryRequest->receiver_postal_code) }}" />

                        <div class="mt-6">
                            <x-primary-button>
                                {{ __('Update Request') }}
                            </x-primary-button>
                            <!-- Cancel button -->
                            <a href="{{ route('delivery.request.index') }}"
                                class="text-blue-600 hover:text-blue-700 hover:underline ml-4">Cancel</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
