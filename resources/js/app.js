import './bootstrap';

import { DataTable } from 'simple-datatables';
window.DataTable = DataTable;

import { escapeHtml, buildOptions, availableIndex } from './components/helpers';
import { initNotificationSystem } from './components/notification';
import { initModalSystem, openModal, closeModal } from './components/modal';
import { initModuleHeaderAnim } from './components/module_header';
import { initModuleScripts } from './components/module_scripts';
import {  } from './components/daily-reports';

// Initialize when the DOM is ready
document.addEventListener('DOMContentLoaded', () => {

    // Setup TrustedHTML Policy once globally
    let rowPolicy;
    if (window.trustedTypes && window.trustedTypes.createPolicy) {
        rowPolicy = window.trustedTypes.createPolicy("myRowTemplatePolicy", {
            createHTML: (htmlString) => htmlString
        });
    } else {
        rowPolicy = { createHTML: (htmlString) => htmlString };
    }


    // Initialize notification system
    initNotificationSystem();


    // Sidebar toggle functionality
    const sidebar = document.getElementById('sidebar');
    const toggleBtn = document.getElementById('sidebar-toggle');

    if (sidebar && toggleBtn) {
        toggleBtn.addEventListener('click', () => {
            // Toggles negative margin to slide the sidebar out of the layout view
            sidebar.classList.toggle('-ml-64');
            toggleBtn.classList.toggle('active:-translate-x-0.5');
            toggleBtn.classList.toggle('active:translate-x-0.5');
        });
    }

    // Initialize modal system
    initModalSystem();
    window.openModal = openModal;
    window.closeModal = closeModal;
    window.openEditInventoryModal = function (id, supplierId, itemCode, name, category, cost, variant, unit, quantity = null) {
        
        const modal = document.getElementById('editInventoryModal');
        const form = document.getElementById('editInventoryForm');

        // Set item name
        document.getElementById('edit-item_code').value = itemCode;

        // Select supplier value
        const supplierEl = document.getElementById('edit-supplier');
        if (supplierEl && supplierEl.options) {
            const targetOption = Array.from(supplierEl.options).find(option => option.value.trim() === supplierId);

            if (targetOption) {
                supplierEl.value = targetOption.value;
            } else {
                console.warn(`Supplier option matching "${supplierId}" not found.`);
            }
        } else {
            console.error("Element #edit-supplier-id not found in the DOM.");
        }
        
        // Set item code
        document.getElementById('edit-name').value = name;

        // Set category value
        const categoryEl = document.getElementById('edit-category');
        if (categoryEl && categoryEl.options) {
            const targetOption = Array.from(categoryEl.options).find(option => option.value.trim() === category);

            if (targetOption) {
                categoryEl.value = targetOption.value;
            } else {
                console.warn(`Supplier option matching "${category}" not found.`);
            }
        } else {
            console.error("Element #edit-supplier-id not found in the DOM.");
        }

        // Set variant
        document.getElementById('edit-variant').value = variant;

        // Set category value
        const unitEl = document.getElementById('edit-unit');
        if (unitEl && unitEl.options) {
            const targetOption = Array.from(unitEl.options).find(option => option.value.trim() === unit);

            if (targetOption) {
                unitEl.value = targetOption.value;
            } else {
                console.warn(`Supplier option matching "${unit}" not found.`);
            }
        } else {
            console.error("Element #edit-supplier-id not found in the DOM.");
        }

        // Set cost
        document.getElementById('edit-cost').value = cost;

        // Set quantity
        if (quantity) {
            document.getElementById('edit-quantity').value = quantity;
        }

        // Dynamically update the form action URL to point to your update route endpoint (e.g., /inventory/5)
        form.action = `/maintenance/inventory/${id}`;
        
        // Remove Tailwind v4 display guards
        window.openModal('editInventoryModal');
        // modal.classList.remove('opacity-0', 'pointer-events-none');
    }

    window.toggleDropdown = function(id, btn) {
        const menu = document.getElementById(id);
        const icon = btn.querySelector('.chevron-icon');

        if (menu) {
            menu.classList.toggle('hidden');
        }
        if (icon) {
            icon.classList.toggle('rotate-90');
        }
    }

    window.closeEditInventoryModal = function() {
        const modal = document.getElementById('editInventoryModal');
        modal.classList.add('opacity-0', 'pointer-events-none');
    }

    window.openEditUserModal = function(id, firstName, middleName, lastName, username, email, roleId) {
        const modal = document.getElementById('editUserModal');
        const form = document.getElementById('editUserForm');
        
        if (modal && form) {
            // Feed text and field datasets directly into input components
            document.getElementById('edit_first_name').value = firstName;
            document.getElementById('edit_middle_name').value = middleName || '';
            document.getElementById('edit_last_name').value = lastName;
            document.getElementById('edit_username').value = username;
            document.getElementById('edit_email').value = email;
            document.getElementById('edit_role_id').value = roleId;
            
            // Wipe optional password tracking fields clear on initialization
            document.getElementById('edit_password').value = '';
            document.getElementById('edit_password_confirmation').value = '';

            // Point action route safely to user endpoint string
            form.action = `/users/${id}`;
            
            // Display Modal
            window.openModal('editUserModal');
            // modal.classList.remove('opacity-0', 'pointer-events-none');
        }
    }

    window.stockCardModal = function stockCardModal(id, type, kind, quantity, status) {
        const modal = document.getElementById('stockCardModal');

        window.openModal('stockCardModal');
    }

    window.updateAndRecordModal = function updateAndRecordModal(id, type, kind, quantity, status) {
        const modal = document.getElementById('updateAndRecordModal');
        const kindInput = modal.querySelector('#modal-item-kind');
        console.log('kindInput');
        console.log(kindInput);
        kindInput.value = kind;

        window.openModal('updateAndRecordModal');
    }

    window.openEditStockRequestModal = function openEditStockRequestModal(id, type, kind, quantity, status) {
        // Dynamically target correct prefix updates
        const contextPrefix = "{{ $location }}"; 
        const form = document.getElementById('editStockRequestForm');
        form.action = `/${contextPrefix}/stock/${id}`;

        // Fill elements values
        document.getElementById('edit_type').value = type;
        document.getElementById('edit_kind').value = kind;
        document.getElementById('edit_status').value = status;

        // Toggle Modal visibility class triggers
        const modal = document.getElementById('editStockRequestModal');
        modal.classList.remove('opacity-0', 'pointer-events-none');

        window.openModal('editStockRequestModal');
    }

    window.editStock = function (id, supplier, name, category, quantity) {
        const form = document.getElementById('editStockForm');

        form.querySelector('#edit-name').textContent = name;
        form.querySelector('#edit-supplier').textContent = supplier;
        form.querySelector('#edit-kind').textContent = category;
        form.querySelector('#edit-quantity').value = quantity;

        window.openModal('editStockModal');
    }

    window.editLevelModal = function (id, name, code, order, description, active) {
        const form = document.getElementById('editLevelForm');
        
        form.querySelector('#edit-level-name').value = name;
        form.querySelector('#edit-level-code').value = code;
        form.querySelector('#edit-level-order').value = order;
        form.querySelector('#edit-level-desc').value = description;

        window.openModal('editLevelModal');
    }

    // For RECEIVING and ISSUANCE modal
    // Global function to add a row to ANY table container
    window.addRow = function(modalPrefix) {
        const inputs = document.getElementById(`${modalPrefix}FormInputs`);
        if (!inputs) return;

        // Pull data off the global window object (which we will seed from Blade)
        const inventoryItems = window.modalData?.inventoryItems || [];
        const categories = window.modalData?.categories || [];
        const uoms = window.modalData?.uoms || [];

        const index = availableIndex(inputs);

        const itemOptions = buildOptions(inventoryItems, 'id', 'name');
        const categoryOptions = buildOptions(categories, 'id', 'kind');
        const uomOptions = buildOptions(uoms, 'id', 'unit');

        const rowHtml = `
            <tr class="text-center max-h-9" data-index="${index}">
                <!-- Quantity -->
                <td class="w-[10%] border-box border h-full border-gray-200 p-1">
                    <input type="number" placeholder="0" 
                        name="items[${index}][quantity]"
                        class="w-full h-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-brand-navy text-xs rounded-lg"/>
                </td>

                <!-- Item Name -->
                <td class="border border-gray-200 p-1">
                    <select name="items[${index}][item_name]" required
                        class="w-full bg-gray-50 border border-gray-300 rounded-lg p-2 text-sm focus:border-brand-gold focus:outline-none transition">
                        <option value="" disabled selected>Select Item</option>
                        ${itemOptions}
                    </select>
                </td>

                <!-- Category -->
                <td class="border border-gray-200 p-1">
                    <select name="items[${index}][category]" required
                        class="w-full bg-gray-50 border border-gray-300 rounded-lg p-2 text-sm focus:border-brand-gold focus:outline-none transition">
                        <option value="" disabled selected>Select Category</option>
                        ${categoryOptions}
                    </select>
                </td>

                <!-- UoM -->
                <td class="border border-gray-200 p-1">
                    <select name="items[${index}][uom]" required
                        class="w-full bg-gray-50 border border-gray-300 rounded-lg p-2 text-sm focus:border-brand-gold focus:outline-none transition">
                        <option value="" disabled selected>Select UoM</option>
                        ${uomOptions}
                    </select>
                </td>

                <!-- Remarks -->
                <td class="border border-gray-200 p-1">
                    <input type="text" 
                        name="items[${index}][remarks]" placeholder="Any additional details..."
                        class="w-full bg-gray-50 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:border-brand-gold focus:outline-none transition">
                </td>

                <!-- Remove Button -->
                <td class="w-[1%] border border-gray-200 p-1">
                    <button type="button" onclick="removeRow('${modalPrefix}', ${index});" 
                        class="w-full bg-red-500 hover:bg-red-600 active:translate-y-0.5 rounded-lg p-2 cursor-pointer transition">
                        <i class="fa-solid fa-circle-minus fa-lg text-white"></i>
                    </button>
                </td>
            </tr>`;

        const trustedRow = rowPolicy.createHTML(rowHtml);
        const tempTbody = document.createElement('tbody');
        tempTbody.innerHTML = trustedRow;
        
        inputs.appendChild(tempTbody.firstElementChild);
    };

    // Unified remove function accepting target container configuration
    window.removeRow = function(modalPrefix, index) {
        const inputsWrapper = document.getElementById(`${modalPrefix}FormInputs`);
        console.log('modalPrefix:', modalPrefix);
        console.log('inputsWrapper:', inputsWrapper);
        if (!inputsWrapper) return;
        
        const row = inputsWrapper.querySelector(`tr[data-index="${index}"]`);
        if (row) row.remove();
    };
});