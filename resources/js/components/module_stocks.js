// For Stock Module
import { availableIndex } from '../components/helpers';

// Global function to add a row to ANY table container
export function addRow(modalPrefix) {
    const inputs = document.getElementById(`${modalPrefix}FormInputs`);
    if (!inputs) return;

    // Pull data off the global window object
    const inventoryItems = window.modalData?.inventoryItems || [];
    const categories = window.modalData?.categories || [];
    const uoms = window.modalData?.uoms || [];

    const index = availableIndex(inputs);

    const row = createRow(
        modalPrefix,
        index,
        inventoryItems,
        categories,
        uoms
    );

    inputs.appendChild(row);
};


// Unified remove function accepting target container configuration
export function removeRow(modalPrefix, index) {
    const inputsWrapper = document.getElementById(`${modalPrefix}FormInputs`);

    if (!inputsWrapper) return;

    const row = inputsWrapper.querySelector(`tr[data-index="${index}"]`);

    if (row) {
        row.remove();
    }
};

export function updateItemSelects(items) {
    const selects = document.querySelectorAll(
        'select[name^="items"][name$="[item_name]"]'
    );

    selects.forEach(select => {
        populateItemSelect(select, items);
    });
};


// Create the complete table row using DOM APIs
function createRow(modalPrefix, index, inventoryItems, categories, uoms) {
    // <tr>
    const row = document.createElement('tr');

    row.className = 'text-center max-h-9';
    row.dataset.index = index;


    // =========================================================
    // Quantity
    // =========================================================

    const quantityCell = document.createElement('td');

    quantityCell.className =
        'w-[10%] border-box border h-full border-gray-200 p-1';

    const quantityInput = document.createElement('input');

    quantityInput.type = 'number';
    quantityInput.placeholder = '0';
    quantityInput.name = `items[${index}][quantity]`;

    quantityInput.className =
        'w-full h-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-brand-navy text-xs rounded-lg';

    quantityCell.appendChild(quantityInput);
    row.appendChild(quantityCell);


    // =========================================================
    // Item Name
    // =========================================================

    const itemCell = document.createElement('td');

    itemCell.className =
        'border border-gray-200 p-1';

    const itemSelect = createSelect({
        name: `items[${index}][item_name]`,
        placeholder: 'Select Item',
        options: inventoryItems,
        valueKey: 'id',
        textKey: 'name'
    });

    itemCell.appendChild(itemSelect);
    row.appendChild(itemCell);


    // =========================================================
    // Category
    // =========================================================

    const categoryCell = document.createElement('td');

    categoryCell.className =
        'border border-gray-200 p-1';

    const categorySelect = createSelect({
        name: `items[${index}][category]`,
        placeholder: 'Select Category',
        options: categories,
        valueKey: 'id',
        textKey: 'kind'
    });

    categoryCell.appendChild(categorySelect);
    row.appendChild(categoryCell);


    // =========================================================
    // UoM
    // =========================================================

    const uomCell = document.createElement('td');

    uomCell.className =
        'border border-gray-200 p-1';

    const uomSelect = createSelect({
        name: `items[${index}][uom]`,
        placeholder: 'Select UoM',
        options: uoms,
        valueKey: 'id',
        textKey: 'unit'
    });

    uomCell.appendChild(uomSelect);
    row.appendChild(uomCell);


    // =========================================================
    // Remarks
    // =========================================================

    const remarksCell = document.createElement('td');

    remarksCell.className =
        'border border-gray-200 p-1';

    const remarksInput = document.createElement('input');

    remarksInput.type = 'text';
    remarksInput.name = `items[${index}][remarks]`;
    remarksInput.placeholder = 'Any additional details...';

    remarksInput.className =
        'w-full bg-gray-50 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:border-brand-gold focus:outline-none transition';

    remarksCell.appendChild(remarksInput);
    row.appendChild(remarksCell);


    // =========================================================
    // Remove Button
    // =========================================================

    const removeCell = document.createElement('td');

    removeCell.className =
        'w-[1%] border border-gray-200 p-1';

    const removeButton = document.createElement('button');

    removeButton.type = 'button';

    removeButton.className =
        'w-full bg-red-500 hover:bg-red-600 active:translate-y-0.5 rounded-lg p-2 cursor-pointer transition';

    // Avoid inline onclick="..."
    removeButton.addEventListener('click', () => {
        removeRow(modalPrefix, index);
    });


    // Font Awesome icon
    const icon = document.createElement('i');

    icon.className =
        'fa-solid fa-circle-minus fa-lg text-white';

    removeButton.appendChild(icon);
    removeCell.appendChild(removeButton);
    row.appendChild(removeCell);


    return row;
};


// =============================================================
// Helper for creating <select> elements
// =============================================================

function createSelect({
    name,
    placeholder,
    options,
    valueKey,
    textKey
}) {
    const select = document.createElement('select');

    select.name = name;
    select.required = true;

    select.className =
        'w-full bg-gray-50 border border-gray-300 rounded-lg p-2 text-sm focus:border-brand-gold focus:outline-none transition';


    // Placeholder option
    const placeholderOption = document.createElement('option');

    placeholderOption.value = '';
    placeholderOption.textContent = placeholder;
    placeholderOption.disabled = true;
    placeholderOption.selected = true;

    select.appendChild(placeholderOption);


    // Actual options
    for (const item of options) {
        const option = document.createElement('option');

        option.value = item[valueKey];
        option.textContent = `${item[textKey]} ${item.variant || ''}`.trim();

        select.appendChild(option);
    }


    return select;
}

function populateItemSelect(select, items) {
    // Remove existing options
    select.replaceChildren();

    // Placeholder
    const placeholder = document.createElement('option');

    placeholder.value = '';
    placeholder.textContent = 'Select Item';
    placeholder.disabled = true;
    placeholder.selected = true;

    select.appendChild(placeholder);

    // Items
    for (const item of items) {
        const option = document.createElement('option');

        option.value = item.id;
        option.textContent = `${item.name} ${item.variant || ''}`.trim();

        option.dataset.category = item.kind_id;
        option.dataset.uom = item.unit_id;

        select.appendChild(option);
    }
}