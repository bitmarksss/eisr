// Helper: Safely escapes dynamic user data to avoid XSS injections in select options
export function escapeHtml(string) {
    if (!string) return '';
    return String(string).replace(/[&<>"']/g, function(match) {
        const map = {
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#039;'
        };
        return map[match];
    });
}

// Helper: Build option markup by converting collections safely
export function buildOptions(items, valueField, textField) {
    if (!items || !Array.isArray(items)) return '';
    return items.map(item => {
        const val = escapeHtml(item[valueField]);
        const text = escapeHtml(item[textField]);
        return `<option value="${val}">${text}</option>`;
    }).join('');
}

// Helper: Gets smallest available index number to avoid duplicated or massive indexes
export function availableIndex(inputsContainer) {
    const rows = inputsContainer.querySelectorAll('tr[data-index]');
    const indexes = Array.from(rows).map(row => parseInt(row.getAttribute('data-index'), 10));
    
    let nextIndex = 0;
    while (indexes.includes(nextIndex)) {
        nextIndex++;
    }
    return nextIndex;
}