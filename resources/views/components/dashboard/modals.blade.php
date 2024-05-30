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