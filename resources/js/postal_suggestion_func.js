export function setupPostalCodeInput(postalCodeId) {
    const postalCodeInput = document.getElementById(postalCodeId);
    const suggestionsContainer = document.getElementById(`${postalCodeId}-suggestions`);
    const postalInfo = document.getElementById(`${postalCodeId}-info`);
    const selectedInfo = document.getElementById(`${postalCodeId}-selected-info`);

    postalCodeInput.addEventListener('input', async function () {
        const query = postalCodeInput.value;

        if (query.length < 3) {
            suggestionsContainer.classList.add('hidden');
            return;
        }

        try {
            const response = await fetch(`/postal-codes/search?query=${query}`);
            const data = await response.json();

            suggestionsContainer.innerHTML = '';

            if (data.length === 0) {
                suggestionsContainer.classList.add('hidden');
                return;
            }

            data.forEach(item => {
                const div = document.createElement('div');
                div.classList.add('p-2', 'hover:bg-gray-100', 'cursor-pointer');
                div.textContent = `${item.postal_code} - ${item.province} - ${item.post_office}`;
                div.addEventListener('click', () => selectPostalCode(item, postalCodeId));
                suggestionsContainer.appendChild(div);
            });

            suggestionsContainer.classList.remove('hidden');
        } catch (error) {
            console.error('Error fetching postal codes:', error);
        }
    });

    function selectPostalCode(item, postalCodeId) {
        postalCodeInput.value = item.postal_code;
        selectedInfo.textContent = `${item.postal_code}, ${item.province}, ${item.district}, ${item.post_office}`;
        postalInfo.classList.remove('hidden');
        suggestionsContainer.classList.add('hidden');
    }
}
