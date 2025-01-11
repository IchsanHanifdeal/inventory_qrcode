<x-main title="{{ $title }}" class="!p-0" full>
    <div class="drawer md:drawer-open">
        <input id="aside-dashboard" type="checkbox" class="drawer-toggle" />
        <div class="drawer-content flex flex-col">
            @include('components.dashboard.navbar')
            <div class="p-4 md:p-5 bg-stone-100 w-full overflow-y-scroll">
                <div class="flex flex-col gap-5 md:gap-6 w-full min-h-screen">
                    {{ $slot }}
                </div>
            </div>
            @include('components.footer')
        </div>
        @include('components.dashboard.aside')
    </div>
    <script>
        // Ambil elemen input dan tabel
        const searchInput = document.getElementById('searchInput');
        const table = document.getElementById('dataTable');

        // Tambahkan event listener untuk input
        searchInput.addEventListener('keyup', function() {
            const filter = searchInput.value.toLowerCase(); // Konversi input ke lowercase
            const rows = table.getElementsByTagName('tr'); // Ambil semua baris tabel

            // Loop melalui semua baris tabel (mulai dari tbody)
            for (let i = 1; i < rows.length; i++) {
                const cells = rows[i].getElementsByTagName('td'); // Ambil semua sel di baris ini
                let match = false;

                // Periksa setiap sel dalam baris
                for (let j = 0; j < cells.length; j++) {
                    const cellText = cells[j].textContent || cells[j].innerText;
                    if (cellText.toLowerCase().indexOf(filter) > -1) {
                        match = true; // Ada kecocokan
                        break;
                    }
                }

                // Tampilkan atau sembunyikan baris berdasarkan hasil pencarian
                rows[i].style.display = match ? '' : 'none';
            }
        });
    </script>
</x-main>

@include('components.dashboard.modals')
