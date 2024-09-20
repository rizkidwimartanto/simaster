@extends('layout/templateberanda_user')
@section('content')
    <div class="container-fluid mt-4">
        <div class="container-fluid mt-4">
            <label class="form-label">ID Pelanggan</label>
            <input type="text" class="form-control" id="searchInput"
                placeholder="Ketik disini untuk mencari ID Pelanggan ........" onkeypress="handleKeyPress(event)"
                oninput="showSuggestions()" onclick="click_customer_app()">
            <div id="suggestionListAPP" class="dropdown">
                <ul class="list-group"></ul>
            </div>
        </div>

        <script>
            // Fungsi ini diubah untuk menangkap pemilihan ID Pelanggan dari saran
            function handleKeyPress(event) {
                if (event.keyCode === 13) {
                    searchCustomer();
                }
            }

            function click_map() {
                document.getElementById('suggestionListAPP').style.display = "none";
            }

            function click_customer_app() {
                document.getElementById('suggestionListAPP').style.display = "block";
            }

            function showSuggestions() {
                var data_pelanggan_app = @json($data_pelanggan_app);
                var searchTerm = document.getElementById('searchInput').value.toLowerCase();
                var suggestionListAPP = document.getElementById('suggestionListAPP');
                var listGroup = suggestionListAPP.querySelector('ul');
                listGroup.innerHTML = '';

                var matchCount = 0;
                data_pelanggan_app.forEach(function(customer) {
                    if (customer.id_pelanggan.toLowerCase().includes(searchTerm) && matchCount < 10) {
                        var listItem = document.createElement('li');
                        listItem.className = 'list-group-item';
                        listItem.textContent = customer.id_pelanggan;
                        listItem.onclick = function() {
                            document.getElementById('searchInput').value = customer.id_pelanggan;
                            listGroup.innerHTML = ''; // Sembunyikan daftar setelah memilih
                            // Redirect berdasarkan ID Pelanggan
                            window.location.href = '/edit_pelanggan_app_user/' + customer.id_pelanggan;
                        };
                        listGroup.appendChild(listItem);
                        matchCount++;
                    }
                });

                if (listGroup.childElementCount > 0) {
                    suggestionListAPP.style.display = 'block';
                } else {
                    suggestionListAPP.style.display = 'none';
                }
            }

            // Menutup daftar saran jika klik di luar elemen
            document.addEventListener('click', function(event) {
                var suggestionListAPP = document.getElementById('suggestionListAPP');
                if (event.target !== suggestionListAPP && !suggestionListAPP.contains(event.target)) {
                    suggestionListAPP.style.display = 'none';
                }
            });
        </script>
    @endsection
