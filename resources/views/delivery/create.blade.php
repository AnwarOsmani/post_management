<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Delivery Request') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="w-1/2 mx-auto p-6 text-gray-900">
                    <form method="POST" action="{{ route('delivery.request.store') }}">
                        @csrf

                        {{-- Sender Information --}}
                        <x-delivery-request-form title="Sender Information" name-id="sender_name"
                            name-value="{{ Auth::user()->name }}" phone-id="sender_phone" phone-value=""
                            postal-code-id="sender_postal_code" postal-code-value="" />

                        <hr class="my-6">

                        {{-- Receiver Information --}}
                        <x-delivery-request-form title="Receiver Information" name-id="receiver_name" name-value=""
                            phone-id="receiver_phone" phone-value="" postal-code-id="receiver_postal_code"
                            postal-code-value="" />

                        <div class="mt-4">
                            <x-primary-button>
                                {{ __('Submit Request') }}
                            </x-primary-button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>