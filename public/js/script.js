function filterTable(input, fields) {
    const filter = input.value.toLowerCase();
    const rows = document.querySelectorAll('tbody tr');

    rows.forEach(row => {
        let match = false;
        fields.split(',').forEach(field => {
            const cell = row.querySelector(`td[data-field="${field}"]`);
            if (cell && cell.textContent.toLowerCase().includes(filter)) {
                match = true;
            }
        });

        row.style.display = match ? '' : 'none';
    });
}
