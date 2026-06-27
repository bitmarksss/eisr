const backdrop = document.getElementById('backdrop');
let selectedModal;

function handleEscapeKey(event) {
    if (event.key === 'Escape') {
        closeModal();
    }
}

export function initModalSystem() {
    if (!backdrop || !selectedModal) return;

    console.log('Initializing Modal System');
    backdrop.addEventListener('click', closeModal);
}

export function openModal(modal) {
    // if (!backdrop) return;

    selectedModal = document.getElementById(modal);
    console.log(modal);
    console.log(selectedModal);
    if (!selectedModal) return;
    
    // console.log(modal);
    // console.log(selectedModal);

    // backdrop.classList.add('absolute');
    // backdrop.classList.remove('hidden');

    // backdrop.classList.remove('opacity-0', 'pointer-events-none');
    // backdrop.classList.add('opacity-100');

    selectedModal.classList.remove('opacity-0', 'pointer-events-none');
    selectedModal.classList.add('opacity-100');

    document.addEventListener('keydown', handleEscapeKey);
}

export function closeModal() {
    if (!selectedModal) return;

    document.removeEventListener('keydown', handleEscapeKey);

    // backdrop.classList.remove('opacity-100');
    // backdrop.classList.add('opacity-0', 'pointer-events-none');

    selectedModal.classList.remove('opacity-100');
    selectedModal.classList.add('opacity-0', 'pointer-events-none');
}