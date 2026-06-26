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