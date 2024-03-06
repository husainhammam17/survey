// // <!-- Contoh menggunakan JavaScript untuk mengirim data ke halaman berikutnya -->

// function submitForm() {
//     // Mendapatkan data yang dipilih dari checklist
//     var selectedData = {};
//     var checkboxes = document.querySelectorAll('input[type="checkbox"]');
//     checkboxes.forEach(function (checkbox) {
//         if (checkbox.checked) {
//             selectedData[checkbox.name] = parseInt(checkbox.value);
//         }
//     });

//     // Mengirim data ke halaman berikutnya sebagai parameter URL
// }

// percobaaan ke duaaaaaaaaaaaa


// Function to create checkboxes based on the received data
// function createCheckboxes(data) {
//     // Get the dropdown element
//     var productChecklist = document.getElementById('productChecklist');

//     // Clear existing options
//     productChecklist.innerHTML = '';

//     // Populate dropdown options based on available product names
//     var allProductsOption = document.createElement('option');
//     allProductsOption.value = 'all';
//     allProductsOption.text = 'All Products';
//     productChecklist.appendChild(allProductsOption);

//     // Create checkboxes based on the dataset
//     for (var i = 0; i < data.dataset.length; i++) {
//         var option = document.createElement('option');
//         option.value = data.dataset[i].label;
//         option.text = data.dataset[i].label;
//         productChecklist.appendChild(option);
//     }

//     // Set the change event listener for the dropdown
//     productChecklist.addEventListener('change', function () {
//         updateChart();
//     });

//     // Create the initial chart
//     initialChart = createChart();
//     updateChart();
// }

// // Fetch data from the server
// fetch('data.php')
//     .then(response => response.json())
//     .then(data => {
//         jsonData = data; // Store data globally
//         // Call the function to create checkboxes
//         createCheckboxes(jsonData);
//     })
//     .catch(error => console.error('Error fetching data:', error));




// percobaaan ke tigaaaaa



function createCheckboxes(data) {
    // Dapatkan elemen dropdown
    var productChecklist = document.getElementById('productChecklist');

    // Bersihkan opsi yang sudah ada
    productChecklist.innerHTML = '';

    // Populasikan dropdown berdasarkan nama produk yang tersedia
    var allProductsOption = document.createElement('option');
    allProductsOption.value = 'all';
    allProductsOption.text = 'Semua Produk';
    productChecklist.appendChild(allProductsOption);

    // Buat checkboxes berdasarkan dataset
    for (var i = 0; i < data.dataset.length; i++) {
        var option = document.createElement('option');
        option.value = data.dataset[i].label;
        option.text = data.dataset[i].label;
        productChecklist.appendChild(option);
    }

    // Setel event listener untuk perubahan pada dropdown
    productChecklist.addEventListener('change', function () {
        updateChart();
    });

    // Buat chart awal
    initialChart = createChart();
    updateChart();
}

// Fetch data dari server
fetch('data.php')
    .then(response => response.json())
    .then(data => {
        jsonData = data; // Simpan data secara global
        // Panggil fungsi untuk membuat checkboxes
        createCheckboxes(jsonData);
    })
    .catch(error => console.error('Error fetching data:', error));