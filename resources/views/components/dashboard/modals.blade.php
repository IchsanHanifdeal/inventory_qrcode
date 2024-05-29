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

<dialog id="tambah_barang_modal" class="modal modal-bottom sm:modal-middle">
    <form method="POST" class="modal-box">
        <h3 class="modal-title capitalize">
            Tambah Barang
        </h3>
        <div class="modal-body">
            <div class="input-label">
                <h1 class="label">Masukan Kode Barang:</h1>
                <input required name="kode_barang" type="text" placeholder="Contoh: DHI3748NM34378">
                @error('kode_barang')
                    <span class="validated">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-label">
                <h1 class="label">Masukan Nama Barang:</h1>
                <input required name="nama_barang" type="text" placeholder="Contoh: Celana Panjang Jeans [L]">
                @error('nama_barang')
                    <span class="validated">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-label">
                <h1 class="label">Masukan Jenis Barang:</h1>
                <select required name="jenis_barang" class="uppercase select select-sm">
                    @foreach (['PKN - PAKAIAN', 'MKN - MAKANAN', 'ELK - ELEKTRONIK'] as $item)
                        {{-- value => PAKAIAN 'atau' MAKANAN 'dan lain lain' --}}
                        {{-- value nantnya tidak memakai kode, buat visual aja --}}
                        <option value={{ explode(' - ', $item)[1] }}>{{ $item }}</option>
                    @endforeach
                </select>
                @error('jenis_barang')
                    <span class="validated">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-label">
                <h1 class="label">Masukan Merek Barang:</h1>
                <select required name="merek_barang" class="uppercase select select-sm">
                    @foreach (['UNC - UNICLO', 'NKE - NIKE'] as $item)
                        {{-- value => UNCILO 'atau' NIKE 'dan lain lain' --}}
                        {{-- value nantnya tidak memakai kode, buat visual aja --}}
                        <option value={{ explode(' - ', $item)[1] }}>{{ $item }}</option>
                    @endforeach
                </select>
                @error('merek_barang')
                    <span class="validated">{{ $message }}</span>
                @enderror
            </div>
            <div class="flex items-center gap-3 w-full">
                <div class="input-label">
                    <h1 class="label">Masukan Stok Barang:</h1>
                    <input required name="stok_barang" type="number" placeholder="Contoh: 1000">
                    @error('stok_barang')
                        <span class="validated">{{ $message }}</span>
                    @enderror
                </div>
                <div class="input-label">
                    <h1 class="label">Masukan Satuan Barang:</h1>
                    <input required name="satuan_barang" type="text" placeholder="Contoh: PCS">
                    @error('satuan_barang')
                        <span class="validated">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="modal-action">
            <button onclick="tambah_barang_modal.close()" class="btn" type="button">Tutup</button>
            <button type="submit" class="btn btn-secondary capitalize">Tambah Barang</button>
        </div>
    </form>
</dialog>
