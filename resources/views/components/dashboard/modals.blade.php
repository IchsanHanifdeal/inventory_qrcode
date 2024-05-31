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

@foreach (['tambah_barang_masuk_modal', 'tambah_barang_keluar_modal'] as $item)
    <dialog id="{{ $item }}" class="modal modal-bottom sm:modal-middle">
        <form method="POST" class="modal-box">
            <h3 class="modal-title capitalize">
                {{ str_replace('modal', '', str_replace('_', ' ', $item)) }}
            </h3>
            <div class="modal-body">
                <div class="input-label">
                    <h1 class="label">Masukan Barang {{ explode('_', $item)[2] }}:</h1>
                    {{-- name => barang_masuk 'atau' barang_keluar --}}
                    <select required name="barang_{{ explode('_', $item)[2] }}" class="uppercase select select-sm">
                        @foreach ([['id' => 'FDKJFEB44958495', 'nama_barang' => 'Celana Panjang Pria Jeans [L]'], ['id' => 'FDKJFEB44965442', 'nama_barang' => 'Celana Panjang Wanita Kasual [L]']] as $barang)
                            <option value={{ $barang['id'] }}>{{ $barang['nama_barang'] }}</option>
                        @endforeach
                    </select>
                    @error('barang_' . explode('_', $item)[2])
                        <span class="validated">{{ $message }}</span>
                    @enderror
                </div>
                <div class="input-label">
                    <h1 class="label">Masukan Jumlah Barang:</h1>
                    <input required name="jumlah_barang" type="number" placeholder="Contoh: 1000">
                    @error('jumlah_barang')
                        <span class="validated">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="modal-action">
                <button onclick="{{ $item }}.close()" class="btn" type="button">Tutup</button>
                <button type="submit" class="btn btn-secondary capitalize">
                    Tambah Barang {{ explode('_', $item)[2] }}</button>
            </div>
        </form>
    </dialog>
@endforeach

<dialog id="barcode_modal" class="modal modal-bottom sm:modal-middle">
    <div class="modal-box">
        <h3 class="modal-title capitalize">
            QR Code <span id="bc_data_nama_barang"></span>
        </h3>
        <div class="modal-body text-center">
            <div class="flex flex-col gap-2 mx-auto my-2 group">
                <div id="bc_preview" class="group-hover:shadow-2xl group-hover:shadow-gray-950 bg-transparent"></div>
                <strong id="bc_data_kode_barang" class="font-mono group-hover:opacity-0 text-blue-500"></strong>
            </div>
        </div>
        <div class="modal-action">
            <button onclick="barcode_modal.close()" class="btn" type="button">Tutup</button>
            <button id="copy" onclick="copyKodeBarang()" class="btn btn-secondary capitalize text-white">Salin Kode
                Barang</button>
        </div>
    </div>
</dialog>

<dialog id="delete_modal" class="modal modal-bottom sm:modal-middle">
    <form class="modal-box">
        <h3 class="modal-title capitalize">
            Hapus <span id="dl_data_type"></span> <span id="dl_data_nama"></span>
        </h3>
        <div class="modal-body" id="dl_body"></div>
        <div class="modal-action">

            {{-- maininnya disini --}}
            <button class="btn btn-error capitalize text-white">
                Yakin
            </button>
            <button onclick="delete_modal.close()" class="btn" type="button">Batal</button>
        </div>
    </form>
</dialog>

<dialog id="scan_kode_barang_modal" class="modal modal-bottom sm:modal-middle">
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
    createjs.Sound.registerSound("/sounds/ding.mp3", 'ding');
    createjs.Sound.registerSound("/sounds/error.mp3", 'error');
    createjs.Sound.registerSound("/sounds/sus.mp3", 'sus');

    var el = id => document.getElementById(id) || ''
    var barcodeData;

    var qrcode = new QRCode('bc_preview', {
        width: 200,
        height: 200
    });

    function initBarcode(data) {
        let init = data?.barang || data;
        barcodeData = init;
        el('bc_data_nama_barang').innerText = `"${init.nama}"`
        el('bc_data_kode_barang').innerText = init.kode
        qrcode.makeCode(init.kode)
    }

    function initUpdate(type, data) {
        el('up_kode_merek').value = data.kode
        el('up_nama_merek').value = data.merk
        el('up_kode_jenis').value = data.kode_jenis
        el('up_nama_jenis').value = data.jenis

        el('up_kode_barang').value = data.kode
        el('up_nama_barang').value = data.nama
        el('up_jenis_barang').value = data.id_jenis
        el('up_merek_barang').value = data.id_merk
        el('up_stok_barang').value = data.stok
        el('up_satuan_barang').value = data.satuan

        el('up_nama').value = data.name
        el('up_username').value = data.username
        el('up_email').value = data.email
        el('up_role').value = data.role
    }

    function initDelete(type, data) {
        const val = data[type == 'barang' ? 'nama' : type == 'user' ? 'username' : type];

        el('dl_data_type').innerText = type;
        el('dl_data_nama').innerText = `"${val}"`;
        el('dl_body').innerHTML =
            `<h1>Yakin ingin menghapus ${type} <strong>"${val}"?</strong> Tindakan ini tidak dapat di
                urungkan. <strong class="text-red-600"><span class='capitalize'>${type}</span> akan hilang secara permanen.</strong></h1>`;
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
