import './bootstrap';
import { initNotificationSystem } from './components/notification';
import { initModuleHeaderAnim } from './components/module_header';
import { initModuleScripts } from './components/module_scripts';

// Initialize when the DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    // Initialize notification system
    initNotificationSystem();

    // Initialize module header animation
    // initModuleHeaderAnim();
    
    // Initialize module scripts
    initModuleScripts();
});