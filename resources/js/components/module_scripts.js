export function initModuleScripts() {
    const fileInput = document.getElementById('fileInput');
    const dropzone = document.getElementById('dropzone');
    const fileIcon = document.getElementById('fileIcon');
    const mainText = document.getElementById('mainText');
    const subText = document.getElementById('subText');
    const removeContainer = document.getElementById('removeButtonContainer');
    const btnRemove = document.getElementById('btnRemove');

    const moduleColors = {
        default: 'gray',
        carenderia: 'amber',
        loan: 'emerald',
        grocery: 'indigo',
        payments: 'rose'
    };
    const routePath = window.location.pathname;
    const pathSegments = routePath.split('/');
    console.log(`curr path: ${pathSegments[1]}`);
    console.log(`modulecoolors: ${moduleColors[pathSegments[1]]}`);
    const fileModuleUploadColor = moduleColors[pathSegments[1]] || moduleColors.default;
    console.log(`fileModuleUploadColor: ${fileModuleUploadColor}`);

    // Handle File Selection
    fileInput.addEventListener('change', function () {
        console.log('this.files');
        console.log(this.files);
        if (this.files && this.files.length > 0) {
            const file = this.files[0];
            const extension = file.name.split('.').pop().toUpperCase();

            // 1. Swap the texts to display name and extension metadata
            mainText.textContent = file.name;
            subText.textContent = `File Extension: .${extension} (${(file.size / 1024 / 1024).toFixed(2)} MB)`;
            
            // 2. Change icon visual state to active color
            fileIcon.classList.remove('text-gray-300');
            fileIcon.classList.add(`text-${fileModuleUploadColor}-500`);

            // 3. Make container keep its active hover borders permanently while loaded
            dropzone.classList.remove('border-gray-300');
            dropzone.classList.add(`border-${fileModuleUploadColor}-500`, `bg-${fileModuleUploadColor}-50/10`);

            // 4. Show the remove button component
            removeContainer.classList.remove('hidden');

            // 5. CRITICAL: Disable file input pointer events so clicks pass directly down to our remove button
            fileInput.classList.add('pointer-events-none');

            console.log('fileIcon');
            console.log(fileIcon);
            console.log('dropzone');
            console.log(dropzone);
        }
    });

    // Handle File Removal
    btnRemove.addEventListener('click', function (e) {
        // Prevent click bubbling up and triggering the file selector window again
        e.preventDefault();
        e.stopPropagation();

        // 1. Reset input value completely
        fileInput.value = '';

        // 2. Re-enable interactive pointer capture on file input
        fileInput.classList.remove('pointer-events-none');

        // 3. Restore default template texts
        mainText.textContent = 'Click to select or drag document here';
        subText.textContent = 'XLSX, XLS, or CSV format up to 10MB';

        // 4. Revert state colors and layouts back to normal
        fileIcon.classList.remove(`text-${fileModuleUploadColor}-500`);
        fileIcon.classList.add('text-gray-300');
        dropzone.classList.remove(`border-${fileModuleUploadColor}-500`, `bg-${fileModuleUploadColor}-50/10`);
        dropzone.classList.add('border-gray-300');

        // 5. Hide the remove element button away again
        removeContainer.classList.add('hidden');
    });
}
