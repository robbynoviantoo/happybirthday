
document.addEventListener('DOMContentLoaded', function () {
    const token = '1|f47OFomlg0hUkmJnSo2u2CxEFw49hDqAqo0HcuEef31c2092'; 

    fetch('http://10.20.10.44/employee-management/api/employees', {
        method: 'GET',
        headers: {
            'Authorization': `Bearer ${token}`,
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        console.log(data);
        // Proses data API dan tampilkan di halaman jika diperlukan
    })
    .catch(error => {
        console.error('Error:', error);
    });
});