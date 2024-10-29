import './bootstrap';

import Alpine from 'alpinejs';

import { setupPostalCodeInput } from './postal_suggestion_func';

window.Alpine = Alpine;

Alpine.start();

// Initialize postal code input based on the page context
document.addEventListener('DOMContentLoaded', () => {
    const postalInputs = [
        'sender_postal_code',
        'receiver_postal_code',
        'postal_code'
    ].map(id => document.getElementById(id)).filter(Boolean);

    if (postalInputs.length > 0) {
        postalInputs.forEach(input => setupPostalCodeInput(input.id));
    }
});

