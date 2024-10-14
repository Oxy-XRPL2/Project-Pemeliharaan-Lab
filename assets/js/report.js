document.addEventListener('DOMContentLoaded', function() {
    loadReportData();
    
    document.getElementById('filter-form').addEventListener('submit', function(e) {
        e.preventDefault();
        loadReportData();
    });
});

function loadReportData() {
    const lab = document.getElementById('lab').value;
    const startDate = document.getElementById('start-date').value;
    const endDate = document.getElementById('end-date').value;

    fetch(`get_report_data.php?lab=${lab}&start_date=${startDate}&end_date=${endDate}`)
        .then(response => response.json())
        .then(data => {
            const tableBody = document.querySelector('#report-data tbody');
            tableBody.innerHTML = '';

            data.forEach(row => {
                const tr = document.createElement('tr');
                tr.innerHTML = `
                    <td>${row.tanggal}</td>
                    <td>${row.lab}</td>
                    <td>${row.petugas1}, ${row.petugas2}, ${row.petugas3}</td>
                    <td>${row.komputer_baik}/${row.komputer_rusak}/${row.komputer_total}</td>
                    <td>${row.monitor_baik}/${row.monitor_rusak}/${row.monitor_total}</td>
                    <td>${row.cpu_baik}/${row.cpu_rusak}/${row.cpu_total}</td>
                    <td>${row.keyboard_baik}/${row.keyboard_rusak}/${row.keyboard_total}</td>
                    <td>${row.mouse_baik}/${row.mouse_rusak}/${row.mouse_total}</td>
                    <td>${row.kabel_baik}/${row.kabel_rusak}/${row.kabel_total}</td>
                `;
                tableBody.appendChild(tr);
            });
        })
        .catch(error => console.error('Error:', error));
}

// Fungsi untuk mengisi opsi lab secara dinamis
function loadLabOptions() {
    fetch('get_lab_options.php')
        .then(response => response.json())
        .then(data => {
            const labSelect = document.getElementById('lab');
            data.forEach(lab => {
                const option = document.createElement('option');
                option.value = lab;
                option.textContent = lab;
                labSelect.appendChild(option);
            });
        })
        .catch(error => console.error('Error:', error));
}

loadLabOptions();