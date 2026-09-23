const columnDefs = [
    { field: 'athlete', minWidth: 170 },
    { field: 'age' },
    { field: 'country' },
    { field: 'year' },
    { field: 'date' },
    { field: 'sport' },
    { field: 'gold' },
    { field: 'silver' },
    { field: 'bronze' },
    { field: 'total' },
];

const gridOptions = {
    rowData: null,
    columnDefs: columnDefs,
    defaultColDef: {
        editable: true,
        sortable: true,
        filter: true,
        resizable: true,
    },
    sideBar: true,
    suppressMenuHide: true,
};

// setup the grid after the page has finished loading
document.addEventListener('DOMContentLoaded', function() {
    var gridDiv = document.querySelector('#myGrid');
    new agGrid.Grid(gridDiv, gridOptions);

    fetch('https://www.ag-grid.com/example-assets/olympic-winners.json')
        .then((response) => response.json())
        .then((data) => gridOptions.api.setRowData(data));
});