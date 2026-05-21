import './bootstrap';

import Alpine from 'alpinejs';
window.Alpine = Alpine;
Alpine.start();

import DataTable from 'datatables.net-dt';

document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('table[data-dt]').forEach(function (table) {
        new DataTable(table, {
            pageLength: 25,
            autoWidth: false,
            language: {
                search:            '',
                searchPlaceholder: 'Search...',
                lengthMenu:        'Show _MENU_ entries',
                info:              'Showing _START_–_END_ of _TOTAL_',
                infoEmpty:         'No entries found',
                infoFiltered:      '(filtered from _MAX_)',
                paginate: {
                    previous: '←',
                    next:     '→',
                },
                emptyTable: 'No data available',
            },
        });
    });
});
