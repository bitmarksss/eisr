import './bootstrap';

import { DataTable } from 'simple-datatables';
window.DataTable = DataTable;

import { initNotificationSystem } from './components/notification';
import { initModalSystem, openModal, closeModal } from './components/modal';
import { initModuleHeaderAnim } from './components/module_header';
import { initModuleScripts } from './components/module_scripts';

// Initialize when the DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    // Initialize notification system
    initNotificationSystem();

    // Initialize modal system
    initModalSystem();
    window.openModal = openModal;
    window.closeModal = closeModal;

    window.openEditInventoryModal = function (id, sku, name, category, quantity) {
        const modal = document.getElementById('editInventoryModal');
        const form = document.getElementById('editInventoryForm');

        console.log(id, sku, name);
        
        // Inject values dynamically from the row click arguments
        document.getElementById('edit_modal_sku').value = sku;
        document.getElementById('edit_modal_item_name').value = name;
        document.getElementById('edit_modal_category').value = category || '';
        document.getElementById('edit_modal_quantity').value = quantity;
        
        // Set the target endpoint update route dynamically (e.g., /inventory/22)
        form.action = `/inventory/${id}`;
        
        // Dynamically update the form action URL to point to your update route endpoint (e.g., /inventory/5)
        form.action = `/inventory/${id}`;
        
        // Remove Tailwind v4 display guards
        window.openModal('editInventoryModal');
        // modal.classList.remove('opacity-0', 'pointer-events-none');
    }

    window.closeEditInventoryModal = function() {
        const modal = document.getElementById('editInventoryModal');
        modal.classList.add('opacity-0', 'pointer-events-none');
    }



    // Initialize module scripts
    // initModuleScripts();

    // let sideBar = document.getElementById('sidebar');
    // let sideBarToggleBtn = document.getElementById('sidebarToggle');
    // let sideBarState = sessionStorage.getItem('sidebarState') || 'expanded';

    // // Apply saved sidebar state on page load
    // if (sideBarState === 'collapsed') {
    //     document.body.classList.add('sidebar-collapsed');
    // }

    // // Toggle sidebar
    // sideBarToggleBtn.addEventListener('click', () => {
    //     sideBar.classList.toggle('collapsed');
    //     sideBarState = sideBarState === 'expanded' ? 'collapsed' : 'expanded';
    //     sessionStorage.setItem('sidebarState', sideBarState);
    // });
});

// /**
//  * Global triggers to safely expose the modal framework view container
//  */
// window.openModal = function openModal() {
//     const modal = document.getElementById('inventoryAdjustmentModal');
//     if (modal) {
//         // Remove the hidden class to display the flex container layout instantly
//         modal.classList.remove('hidden');
//         // Prevent background main page window scroll interactions while active
//         document.body.classList.add('overflow-hidden');
//     }
// }

// /**
//  * Clean hide utilities to suppress the overlay block
//  */
// window.closeModal = function closeModal() {
//     const modal = document.getElementById('inventoryAdjustmentModal');
//     if (modal) {
//         // Enforce structural visibility blocking flag
//         modal.classList.add('hidden');
//         // Release background page tracking locking mechanisms
//         document.body.classList.remove('overflow-hidden');
//     }
// }

// // Optional: Escape Key Listener to dismiss the modal naturally
// document.addEventListener('keydown', function(event) {
//     if (event.key === 'Escape') {
//         closeModal();
//     }
// });