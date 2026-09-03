import DataTable from 'datatables.net-dt';
import 'datatables.net-dt/css/dataTables.dataTables.css';
window.DataTable = DataTable;

export default function loadDatatable(dataTableID, { 
    url, 
    callbacks = null,
    searchElement = null, 
    entriesElement = null, 
    filters = null,
    columns, 
    headers,
    maxRetries = 3,
    retryDelay = 3000,
    buttons = [],
}) {
    let retryCount = 0;
    let typingTimer;

    // Check if datatable exists
    let dataTableInstance = isAlreadyDatatable(dataTableID);
    // Destroy existing table
    if (dataTableInstance) {
        dataTableInstance.destroy();
    }

    // Clear thead & tbody
    const table = document.getElementById(dataTableID);
    const thead = table.querySelector('thead');
    const tbody = table.querySelector('tbody');

    thead.setHTML('');
    tbody.setHTML('');

    // Build dynamic header
    const headerRow = document.createElement('tr');
    headers.forEach(header => {
        const th = document.createElement('th');
        th.setHTML(`<span class="flex items-center">${header}</span>`);
        headerRow.appendChild(th);
    });
    thead.appendChild(headerRow);

    // Initialize DataTable
    const dataTable = new DataTable(`#${dataTableID}`, {
        processing: true,
        serverSide: true,
        autoWidth: false,
        pageLength: 10,
        order: [[0, 'desc']],
        layout: {
            topEnd: null,
            topStart: {
                buttons: buttons
            },
            bottomStart: 'info',
            bottomEnd: 'paging',
        },
        ajax: {
            url: url,
            type: 'GET',
            data: function (d) {
                if (typeof filters === 'function') {
                    const extraFilters = filters();
                    Object.assign(d, extraFilters);
                }
            },
            error: function (xhr, textStatus, errorThrown) {
                console.warn(`Loading datatable failed (${retryCount + 1}/${maxRetries})`);

                if (retryCount < maxRetries - 1) {
                    retryCount++;

                    setTimeout(() => {
                        dataTable.ajax.reload();
                    }, retryDelay);

                } else {
                    alert('Datatable failed after max retries. Please refresh the page. If issue persists, contact support');
                }
            }
        },
        columns: columns,
        drawCallback() {
            $('.dataTables_paginate span.ellipsis').each(function () {
                $(this).replaceWith(
                    `<button class="paginate_button ellipsis-btn" disabled>…</button>`
                );
            });

            if (callbacks && Array.isArray(callbacks)) {
                callbacks.forEach((fn) => {
                    if (typeof fn === 'function') {
                        fn();
                    }
                });
            }
        }
    });

    if (searchElement) {
        const tableSearchElement = document.getElementById(searchElement);

        tableSearchElement.addEventListener('keyup', function () {
            const value = this.value;

            dataTable.processing(true);

            clearTimeout(typingTimer);
            typingTimer = setTimeout(function () {
                dataTable.search(value).draw();
            }, 300);
        });
    }

    if (entriesElement) {
        const tableEntriesElement = document.getElementById(entriesElement);

        tableEntriesElement.addEventListener('change', function () {
            dataTable.page.len(this.value).draw();
        });
    }

    return dataTable;
}

function isAlreadyDatatable(dataTableID) {
    return DataTable.isDataTable(`#${dataTableID}`)
            ? DataTable(`#${dataTableID}`)
            : null;
}