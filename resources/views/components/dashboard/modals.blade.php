@foreach (['tambah_merek_modal', 'tambah_jenis_barang_modal'] as $item)
    <dialog id="{{ $item }}" class="modal modal-bottom sm:modal-middle">
        <form method="POST" class="modal-box">
            <h3 class="modal-title capitalize">
                {{ str_replace('modal', '', str_replace('_', ' ', $item)) }}
            </h3>
            <div class="modal-body">
                <div class="input-label">
                    <h1 class="label">Masukan Kode {{ explode('_', $item)[1] }}:</h1>

                    {{-- name => kode_merek 'atau' kode_jenis --}}
                    <input required name="kode_{{ explode('_', $item)[1] }}" type="text"
                        placeholder="Contoh: {{ $item == 'tambah_merek_modal' ? 'UNC' : 'PKN' }}">
                </div>
                <div class="input-label">
                    <h1 class="label">Masukan Nama {{ explode('_', $item)[1] }}:</h1>

                    {{-- name => nama_merek 'atau' nama_jenis --}}
                    <input required name="nama_{{ explode('_', $item)[1] }}" type="text"
                        placeholder="Contoh: {{ $item == 'tambah_merek_modal' ? 'Uniclo' : 'Pakaian' }}">
                </div>
            </div>
            <div class="modal-action">
                <button onclick="{{ $item }}.close()" class="btn" type="button">Tutup</button>
                <button type="submit" class="btn btn-secondary capitalize">Tambah {{ explode('_', $item)[1] }}</button>
            </div>
        </form>
    </dialog>
@endforeach

<dialog id="tambah_barang_modal" class="modal modal-bottom sm:modal-middle">
    <form method="POST" class="modal-box">
        <h3 class="modal-title capitalize">
            Tambah Barang
        </h3>
        <div class="modal-body">
            <div class="input-label">
                <h1 class="label">Masukan Kode Barang:</h1>
                <input required name="kode_barang" type="text" placeholder="Contoh: DHI3748NM34378">
            </div>
            <div class="input-label">
                <h1 class="label">Masukan Nama Barang:</h1>
                <input required name="nama_barang" type="text" placeholder="Contoh: Celana Panjang Jeans [L]">
            </div>
            <div class="input-label">
                <h1 class="label">Masukan Jenis Barang:</h1>
                <select name="jenis_barang" class="uppercase select select-sm">
                    @foreach (['PKN - PAKAIAN', 'MKN - MAKANAN', 'ELK - ELEKTRONIK'] as $item)
                        {{-- value => PAKAIAN 'atau' MAKANAN 'dan lain lain' --}}
                        {{-- value tidak memakai kode, buat visual aja --}}
                        <option value={{ explode(' - ', $item)[1] }}>{{ $item }}</option>
                    @endforeach
                </select>
            </div>
            <div class="input-label">
                <h1 class="label">Masukan Merek Barang:</h1>
                <select name="merek_barang" class="uppercase select select-sm">
                    @foreach (['UNC - UNICLO', 'NKE - NIKE'] as $item)
                        {{-- value => UNCILO 'atau' NIKE 'dan lain lain' --}}
                        {{-- value tidak memakai kode, buat visual aja --}}
                        <option value={{ explode(' - ', $item)[1] }}>{{ $item }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex items-center gap-3 w-full">
                <div class="input-label">
                    <h1 class="label">Masukan Stok Barang:</h1>
                    <input required name="stok_barang" type="number" placeholder="Contoh: 1000">
                </div>
                <div class="input-label">
                    <h1 class="label">Masukan Satuan Barang:</h1>
                    <input required name="satuan_barang" type="text" placeholder="Contoh: PCS">
                </div>
            </div>
        </div>
        <div class="modal-action">
            <button onclick="tambah_barang_modal.close()" class="btn" type="button">Tutup</button>
            <button type="submit" class="btn btn-secondary capitalize">Tambah Barang</button>
        </div>
    </form>
</dialog>
