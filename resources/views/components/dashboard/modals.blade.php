@foreach (['tambah_merek_modal', 'tambah_jenis_barang_modal'] as $item)
    @php
        $route = 'store.' . explode('_', $item)[1];
    @endphp
    <dialog id="{{ $item }}" class="modal modal-bottom sm:modal-middle">
        <form action="{{ route($route) }}" method="POST" class="modal-box">
            @csrf
            <h3 class="modal-title capitalize">
                {{ str_replace('modal', '', str_replace('_', ' ', $item)) }}
            </h3>
            <div class="modal-body">
                <div class="input-label">
                    <h1 class="label">Masukan Kode {{ explode('_', $item)[1] }}:</h1>

                    {{-- name => kode_merek 'atau' kode_jenis --}}
                    <input required name="kode_{{ explode('_', $item)[1] }}" type="text"
                        placeholder="Contoh: {{ $item == 'tambah_merek_modal' ? 'UNC' : 'PKN' }}">
                    @error('kode_' . explode('_', $item)[1])
                        <span class="validated">{{ $message }}</span>
                    @enderror
                </div>
                <div class="input-label">
                    <h1 class="label">Masukan Nama {{ explode('_', $item)[1] }}:</h1>

                    {{-- name => nama_merek 'atau' nama_jenis --}}
                    <input required name="nama_{{ explode('_', $item)[1] }}" type="text"
                        placeholder="Contoh: {{ $item == 'tambah_merek_modal' ? 'Uniclo' : 'Pakaian' }}">
                    @error('nama_' . explode('_', $item)[1])
                        <span class="validated">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="modal-action">
                <button onclick="{{ $item }}.close()" class="btn" type="button">Tutup</button>
                <button type="submit" class="btn btn-secondary capitalize">Tambah
                    {{ explode('_', $item)[1] }}</button>
            </div>
        </form>
    </dialog>
@endforeach

@foreach (['update_merek_modal', 'update_jenis_barang_modal'] as $item)
    <dialog id="{{ $item }}" class="modal modal-bottom sm:modal-middle">
        <form method="POST" class="modal-box">
            @csrf
            <h3 class="modal-title capitalize">
                {{ str_replace('modal', '', str_replace('_', ' ', $item)) }}
            </h3>
            <div class="modal-body">
                <div class="input-label">
                    <h1 class="label">Masukan Kode {{ explode('_', $item)[1] }}:</h1>

                    {{-- name => kode_merek 'atau' kode_jenis --}}
                    <input required id="up_kode_{{ explode('_', $item)[1] }}"
                        name="up_kode_{{ explode('_', $item)[1] }}" type="text"
                        placeholder="Contoh: {{ $item == 'update_merek_modal' ? 'UNC' : 'PKN' }}">
                    @error('up_kode_' . explode('_', $item)[1])
                        <span class="validated">{{ $message }}</span>
                    @enderror
                </div>
                <div class="input-label">
                    <h1 class="label">Masukan Nama {{ explode('_', $item)[1] }}:</h1>

                    {{-- name => nama_merek 'atau' nama_jenis --}}
                    <input required id="up_nama_{{ explode('_', $item)[1] }}"
                        name="up_nama_{{ explode('_', $item)[1] }}" type="text"
                        placeholder="Contoh: {{ $item == 'update_merek_modal' ? 'Uniclo' : 'Pakaian' }}">
                    @error('up_nama_' . explode('_', $item)[1])
                        <span class="validated">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="modal-action">
                <button onclick="{{ $item }}.close()" class="btn" type="button">Tutup</button>
                <button type="submit" class="btn btn-secondary capitalize">
                    Update {{ explode('_', $item)[1] }}
                </button>
            </div>
        </form>
    </dialog>
@endforeach


<dialog id="barcode_modal" class="modal modal-bottom sm:modal-middle">
    <div class="modal-box sm:max-w-xl">
        <h3 class="modal-title capitalize">
            QR Code <span id="bc_data_nama_barang"></span>
        </h3>
        <div class="modal-body text-center">
            <div class="flex flex-col sm:flex-row gap-6 items-center justify-center my-2">
                <div class="flex flex-col gap-2 group items-center">
                    <div id="bc_preview" class="group-hover:shadow-2xl group-hover:shadow-gray-950 bg-white p-2 rounded-lg transition-all duration-300"></div>
                    <strong id="bc_data_kode_barang" class="font-mono text-blue-500"></strong>
                </div>
                <div class="text-left w-full sm:w-64 bg-zinc-50 p-4 rounded-xl border border-zinc-200 text-sm">
                    <h4 class="font-bold mb-2 text-zinc-700 border-b pb-1">Informasi Barang</h4>
                    <div class="grid grid-cols-3 gap-y-1.5 text-zinc-600">
                        <span class="font-semibold col-span-1">Nama</span>
                        <span class="col-span-2" id="bc_info_nama">-</span>
                        
                        <span class="font-semibold col-span-1">Jenis</span>
                        <span class="col-span-2 capitalize" id="bc_info_jenis">-</span>
                        
                        <span class="font-semibold col-span-1">Merek</span>
                        <span class="col-span-2 capitalize" id="bc_info_merek">-</span>
                        
                        <span class="font-semibold col-span-1">Lokasi</span>
                        <span class="col-span-2 capitalize" id="bc_info_lokasi">-</span>
                        
                        <span class="font-semibold col-span-1">Status</span>
                        <span class="col-span-2 capitalize font-medium" id="bc_info_status">-</span>
                        
                        <span class="font-semibold col-span-1">Stok</span>
                        <span class="col-span-2" id="bc_info_stok">-</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-action">
            <button onclick="barcode_modal.close()" class="btn" type="button">Tutup</button>
            <button id="copy" onclick="copyKodeBarang()" class="btn btn-secondary capitalize text-white">Salin Kode
                Barang</button>
            <button id="print" onclick="printPreview()"
                class="btn btn-secondary capitalize text-white">Print</button>
        </div>
    </div>
</dialog>

<dialog id="delete_modal" class="modal modal-bottom sm:modal-middle">
    <form method="POST" class="modal-box">
        @csrf
        @method('DELETE')
        <h3 class="modal-title capitalize">
            Hapus <span id="dl_data_type"></span> <span id="dl_data_nama"></span>
        </h3>
        <div class="modal-body" id="dl_body"></div>
        <div class="modal-action">
            <button class="btn btn-error capitalize text-white" type="submit">
                Yakin
            </button>
            <button type="button" onclick="document.getElementById('delete_modal').close()"
                class="btn">Batal</button>
        </div>
    </form>
</dialog>

<dialog id="ajukan_peminjaman_scan_kode_modal" class="modal modal-bottom sm:modal-middle">
    <div class="modal-box">
        <h3 class="modal-title capitalize !border-0 !pb-0">
            Scan Qr Code
        </h3>
        <div class="modal-body text-center">
            <video class="rounded-xl" id="bc_scanner"></video>
            <h1 id="bc_scanner_output" class="mx-auto font-semibold"></h1>
        </div>
        <form method="dialog" onclick="stopScanner()">
            <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
        </form>
    </div>
</dialog>

<script>
    function printPreview() {
        const printContent = document.getElementById('bc_preview').outerHTML;
        const printContent2 = document.getElementById('bc_data_kode_barang').outerHTML;

        const printArea = document.createElement('div');
        printArea.id = 'printArea';
        printArea.innerHTML = printContent + printContent2;

        const originalContent = document.body.innerHTML;

        document.body.appendChild(printArea);
        const style = document.createElement('style');
        style.textContent = `
            @media print {
                body > *:not(#printArea) {
                    display: none;
                }
                #printArea {
                    display: block;
                }
            }
        `;
        document.head.appendChild(style);

        window.print();

        document.body.removeChild(printArea);
        document.head.removeChild(style);
    }
</script>

<script>
    createjs.Sound.registerSound("/sounds/ding.mp3", 'ding');
    createjs.Sound.registerSound("/sounds/error.mp3", 'error');

    var el = id => document.getElementById(id) || ''
    var barcodeData;

    var qrcode = new QRCode('bc_preview', {
        width: 200,
        height: 200
    });

    function parseQrData(scanData) {
        if (!scanData) return '';
        let text = scanData.trim();
        // 1. Check if it's a JSON string
        if (text.startsWith('{') && text.endsWith('}')) {
            try {
                let parsed = JSON.parse(text);
                if (parsed && parsed.kode) {
                    return parsed.kode;
                }
            } catch(e) {}
        }
        // 2. Check if it's formatted text containing "Kode Barang: [CODE]" or "Kode: [CODE]"
        let match = text.match(/Kode Barang:\s*([^\n\r]+)/i) || text.match(/Kode:\s*([^\n\r]+)/i);
        if (match) {
            return match[1].trim();
        }
        // 3. Otherwise return the raw scanned text
        return text;
    }

    function initBarcode(data) {
        let init = data?.barang || data;
        barcodeData = init;
        el('bc_data_nama_barang').innerText = `"${init.nama}"`
        el('bc_data_kode_barang').innerText = init.kode

        let jenisText = (init.jenis && init.jenis.jenis) ? init.jenis.jenis : '-';
        let merkText = (init.merk && init.merk.merk) ? init.merk.merk : '-';
        let lokasiText = init.lokasi || '-';
        let statusText = init.status || '-';
        let stokText = init.stok !== undefined ? init.stok : '-';
        let satuanText = init.satuan || '';

        // Update info display inside modal
        if (el('bc_info_nama')) el('bc_info_nama').innerText = init.nama;
        if (el('bc_info_jenis')) el('bc_info_jenis').innerText = jenisText;
        if (el('bc_info_merek')) el('bc_info_merek').innerText = merkText;
        if (el('bc_info_lokasi')) el('bc_info_lokasi').innerText = lokasiText;
        if (el('bc_info_status')) el('bc_info_status').innerText = statusText;
        if (el('bc_info_stok')) el('bc_info_stok').innerText = `${stokText} ${satuanText}`;

        // Construct detailed text content for the QR Code
        let qrContent = `Kode: ${init.kode}
Nama: ${init.nama}
Jenis: ${jenisText}
Merek: ${merkText}
Lokasi: ${lokasiText}
Status: ${statusText}
Stok: ${stokText} ${satuanText}`;

        qrcode.makeCode(qrContent)
    }

    function initUpdate(type, data) {
        if (document.getElementById('up_kode_merek')) el('up_kode_merek').value = data.kode || '';
        if (document.getElementById('up_nama_merek')) el('up_nama_merek').value = data.merk || '';
        if (document.getElementById('up_kode_jenis')) el('up_kode_jenis').value = data.kode_jenis || '';
        if (document.getElementById('up_nama_jenis')) el('up_nama_jenis').value = data.jenis || '';

        if (document.getElementById('up_kode_barang')) el('up_kode_barang').value = data.kode || '';
        if (document.getElementById('up_nama_barang')) el('up_nama_barang').value = data.nama || '';
        if (document.getElementById('up_jenis_barang')) el('up_jenis_barang').value = data.id_jenis || '';
        if (document.getElementById('up_merek_barang')) el('up_merek_barang').value = data.id_merk || '';
        if (document.getElementById('up_stok_barang')) el('up_stok_barang').value = data.stok || '0';
        if (document.getElementById('up_satuan_barang')) el('up_satuan_barang').value = data.satuan || '';

        if (document.getElementById('up_nama')) el('up_nama').value = data.name || '';
        if (document.getElementById('up_username')) el('up_username').value = data.username || '';
        if (document.getElementById('up_email')) el('up_email').value = data.email || '';
        if (document.getElementById('up_role')) el('up_role').value = data.role || '';
        if (document.getElementById('up_nik')) el('up_nik').value = data.nik || '';
    }

    function initDelete(type, data) {
        const val = type === 'barang' ? data['nama'] :
            type === 'user' ? data['username'] :
            data[type];
        const id = type === 'barang' ? data['id_barang'] :
            type === 'merk' ? data['id_merk'] :
            type === 'jenis' ? data['id_jenis'] : '';
        document.getElementById('dl_data_type').innerText = type;
        document.getElementById('dl_data_nama').innerText = `"${val}"`;
        document.getElementById('dl_body').innerHTML =
            `<h1>Yakin ingin menghapus ${type} <strong>"${val}"?</strong> Tindakan ini tidak dapat di urungkan. <strong class="text-red-600"><span class='capitalize'>${type}</span> akan hilang secara permanen.</strong></h1>`;
        const form = document.querySelector('#delete_modal form');
        form.action = `/delete/${type}/${id}`;
        document.getElementById('delete_modal').showModal();
    }

    function copyKodeBarang() {
        navigator.clipboard.writeText(barcodeData.kode)
            .then(() => {
                el('copy').innerText = 'di salin!';
                el('copy').classList.add('btn-success');
                mark('bc_data_kode_barang')
                setTimeout(() => {
                    el('copy').innerText = 'Salin Kode Barang';
                    el('copy').classList.remove('btn-success');
                }, 1200);
            })
    }

    function mark(id) {
        el(id).innerHTML = `<mark>${el(id).innerText}</mark>`;
    }
</script>
