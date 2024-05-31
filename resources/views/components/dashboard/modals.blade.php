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

<dialog id="barcode_modal" class="modal modal-bottom sm:modal-middle">
    <div class="modal-box">
        <h3 class="modal-title capitalize">
            Barcode <span id="bc_data_nama_barang"></span>
        </h3>
        <div class="modal-body text-center">
            <div class="mx-auto">
                <svg id="bc_preview"></svg>
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

<script>
    const el = id => document.getElementById(id) || ''
    let barcodeData;

    function initBarcode(data) {
        barcodeData = data;
        el('bc_data_nama_barang').innerText = `"${data.nama}"`
        JsBarcode(el('bc_preview'), data.kode, {
            height: 60
        });
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
