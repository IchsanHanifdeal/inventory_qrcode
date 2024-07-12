<x-dashboard.main title="Kelola Barang">
    <div class="grid sm:grid-cols-2 xl:grid-cols-4 gap-5 md:gap-6">
        @foreach (['total_barang', 'stok_barang', 'barang_masuk', 'barang_keluar'] as $type)
            @if ($role !== 'user' || in_array($type, ['total_barang', 'stok_barang']))
                <div class="flex items-center px-4 py-3 bg-white border-back rounded-xl">
                    <span
                        class="
                      {{ $type == 'total_barang' ? 'bg-blue-300' : '' }}
                      {{ $type == 'stok_barang' ? 'bg-green-300' : '' }}
                      {{ $type == 'barang_masuk' ? 'bg-rose-300' : '' }}
                      {{ $type == 'barang_keluar' ? 'bg-amber-300' : '' }}
                      p-3 mr-4 text-gray-700 rounded-full"></span>
                    <div>
                        <p class="text-sm font-medium capitalize text-gray-600 line-clamp-1">
                            {{ str_replace('_', ' ', $type) }}
                        </p>
                        <p class="text-lg font-semibold text-gray-700 line-clamp-1">
                            {{ $type == 'total_barang' ? $total_barang : '' }}
                            {{ $type == 'stok_barang' ? $stok_barang : '' }}
                            {{ $type == 'barang_masuk' ? $barang_masuk : '' }}
                            {{ $type == 'barang_keluar' ? $barang_keluar : '' }}
                        </p>
                    </div>
                </div>
            @endif
        @endforeach
    </div>    
    <div class="flex flex-col lg:flex-row gap-5">
        @foreach (['scan_kode_barang', 'tambah_barang'] as $item)
            @if ($item !== 'tambah_barang' || $role === 'admin')
                <div onclick="{{ $item . '_modal' }}.showModal();{{ $item == 'scan_kode_barang' ? 'initScanner()' : '' }}"
                    class="flex items-center justify-between p-5 sm:p-7 hover:shadow-md active:scale-[.97] border border-blue-200 bg-white cursor-pointer border-back rounded-xl w-full">
                    <div>
                        <h1 class="flex items-start gap-3 font-semibold font-[onest] sm:text-lg capitalize">
                            {{ str_replace('_', ' ', $item) }}
                        </h1>
                        <p class="text-sm opacity-60">
                            {{ $item == 'scan_kode_barang' ? 'Cari detail info tentang barang' : '' }}
                            {{ $item == 'tambah_barang' ? 'Menambahkan barang untuk di kelola' : '' }}
                        </p>
                    </div>
                    <x-lucide-scan-line
                        class="{{ $item == 'scan_kode_barang' ? '' : 'hidden' }} size-5 sm:size-7 opacity-60" />
                    <x-lucide-plus
                        class="{{ $item == 'tambah_barang' ? '' : 'hidden' }} size-5 sm:size-7 opacity-60" />
                </div>
            @endif
        @endforeach
    </div>
    <div class="flex gap-5">
        @foreach (['manajemen_barang'] as $item)
            <div class="flex flex-col border-back rounded-xl w-full">
                <div class="p-5 sm:p-7 bg-white rounded-t-xl">
                    <h1 class="flex items-start gap-3 font-semibold font-[onest] text-lg capitalize">
                        {{ str_replace('_', ' ', $item) }}
                    </h1>
                    <p class="text-sm opacity-60">Kelola barang dengan efisien dan efektif</p>
                </div>
                <div class="w-full px-5 sm:px-7 bg-zinc-50">
                    <input type="text" placeholder="Cari data disini...." name="nama_barang"
                        class="input input-sm shadow-md w-full bg-zinc-100">
                </div>
                <div class="flex flex-col bg-zinc-50 rounded-b-xl gap-3 divide-y pt-0 p-5 sm:p-7">
                    <div class="overflow-x-auto">
                        <table class="table table-zebra">
                            <thead>
                                <tr>
                                    @foreach (['no', 'kode barang', 'nama barang', 'stok', 'satuan', 'jenis barang', 'merek barang', 'last update', 'register', ''] as $item)
                                        <th class="uppercase font-bold">{{ $item }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($barang as $i => $item)
                                    <tr class="whitespace-nowrap">
                                        <th>{{ $i + 1 }}</th>
                                        <td class="uppercase font-semibold opacity-70">{{ $item->kode }}</td>
                                        <td class="text-blue-500 font-semibold hover:underline cursor-pointer">
                                            {{ $item->nama }}
                                        </td>
                                        <td class="font-semibold">{{ $item->stok }}</td>
                                        <td class="font-semibold uppercase">{{ $item->satuan }}</td>
                                        <td class="uppercase">{{ $item->jenis->jenis }}</td>
                                        <td class="uppercase">{{ $item->merk->merk }} </td>
                                        <td>{{ $item->updated_at }}</td>
                                        <td>{{ $item->created_at }}</td>
                                        <td class="flex items-center gap-4">
                                            @if ($role === 'admin')
                                                <x-lucide-square-pen
                                                    onclick="document.getElementById('update_barang_modal_{{ $item->id_barang }}').showModal();initUpdate('barang', {{ $item->id_barang }})"
                                                    class="size-5 hover:stroke-blue-500 cursor-pointer" />
                                                <x-lucide-trash-2
                                                    onclick="delete_modal.showModal();initDelete('barang', {{ $item }})"
                                                    class="size-5 hover:stroke-rose-500 cursor-pointer" />
                                            @endif
                                            <x-lucide-scan-barcode
                                                onclick="barcode_modal.showModal();initBarcode({{ $item }})"
                                                class="size-5 hover:stroke-emerald-500 cursor-pointer" />
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</x-dashboard.main>

<dialog id="tambah_barang_modal" class="modal modal-bottom sm:modal-middle">
    <form method="POST" class="modal-box" action="{{ route('store.barang') }}">
        @csrf
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
                    @foreach ($jenis as $item)
                        {{-- value => PAKAIAN 'atau' MAKANAN 'dan lain lain' --}}
                        {{-- value nantnya tidak memakai kode, buat visual aja --}}
                        <option value="{{ $item->id_jenis }}">{{ $item->kode_jenis }} - {{ $item->jenis }}</option>
                    @endforeach
                </select>
                @error('jenis_barang')
                    <span class="validated">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-label">
                <h1 class="label">Masukan Merek Barang:</h1>
                <select required name="merek_barang" class="uppercase select select-sm">
                    @foreach ($merk as $item)
                        {{-- value => UNCILO 'atau' NIKE 'dan lain lain' --}}
                        {{-- value nantnya tidak memakai kode, buat visual aja --}}
                        <option value="{{ $item->id_merk }}">{{ $item->kode }} - {{ $item->merk }}</option>
                    @endforeach
                </select>
                @error('merek_barang')
                    <span class="validated">{{ $message }}</span>
                @enderror
            </div>
            <div class="flex items-center gap-3 w-full">
                <div class="input-label">
                    <h1 class="label">Masukan Stok Barang:</h1>
                    <input required name="stok_barang" type="number" placeholder="Contoh: 1000" value="0"
                        readonly>
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

@foreach ($barang as $i => $item)
    <dialog id="update_barang_modal_{{ $item->id_barang }}" class="modal modal-bottom sm:modal-middle">
        <form method="POST" class="modal-box"
            action="{{ route('update.barang', ['id_barang' => $item->id_barang]) }}">
            @csrf
            @method('PUT')
            <h3 class="modal-title capitalize">Update Barang</h3>
            <div class="modal-body">
                <div class="input-label">
                    <h1 class="label">Masukan Kode Barang:</h1>
                    <input required name="up_kode_barang" type="text" placeholder="Contoh: DHI3748NM34378"
                        value="{{ $item->kode }}">
                    @error('up_kode_barang')
                        <span class="validated">{{ $message }}</span>
                    @enderror
                </div>
                <div class="input-label">
                    <h1 class="label">Masukan Nama Barang:</h1>
                    <input required name="up_nama_barang" type="text"
                        placeholder="Contoh: Celana Panjang Jeans [L]" value="{{ $item->nama }}">
                    @error('up_nama_barang')
                        <span class="validated">{{ $message }}</span>
                    @enderror
                </div>
                <div class="input-label">
                    <h1 class="label">Masukan Jenis Barang:</h1>
                    <select required name="up_jenis_barang" class="uppercase select select-sm">
                        @foreach ($jenis as $jenis_item)
                            <option value="{{ $jenis_item->id_jenis }}"
                                {{ $item->id_jenis == $item->id_jenis ? 'selected' : '' }}>
                                {{ $jenis_item->kode_jenis }} - {{ $jenis_item->jenis }}
                            </option>
                        @endforeach
                    </select>
                    @error('up_jenis_barang')
                        <span class="validated">{{ $message }}</span>
                    @enderror
                </div>
                <div class="input-label">
                    <h1 class="label">Masukan Merek Barang:</h1>
                    <select required name="up_merek_barang" class="uppercase select select-sm">
                        @foreach ($merk as $merk_item)
                            <option value="{{ $merk_item->id_merk }}"
                                {{ $item->id_merk == $item->id_merk ? 'selected' : '' }}>
                                {{ $merk_item->kode }} - {{ $merk_item->merk }}
                            </option>
                        @endforeach
                    </select>
                    @error('up_merek_barang')
                        <span class="validated">{{ $message }}</span>
                    @enderror
                </div>
                <div class="flex items-center gap-3 w-full">
                    <div class="input-label">
                        <h1 class="label">Masukan Stok Barang:</h1>
                        <input required name="up_stok_barang" type="number" placeholder="Contoh: 1000"
                            value="{{ $item->stok }}" readonly>
                        @error('up_stok_barang')
                            <span class="validated">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="input-label">
                        <h1 class="label">Masukan Satuan Barang:</h1>
                        <input required name="up_satuan_barang" type="text" placeholder="Contoh: PCS"
                            value="{{ $item->satuan }}">
                        @error('up_satuan_barang')
                            <span class="validated">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="modal-action">
                <button type="button" class="btn"
                    onclick="document.getElementById('update_barang_modal_{{ $item->id_barang }}').close()">Tutup</button>
                <button type="submit" class="btn btn-secondary capitalize">Update Barang</button>
            </div>
        </form>
    </dialog>
@endforeach

<dialog id="detail_barang_modal" class="modal modal-bottom sm:modal-middle">
    <div class="modal-box">
        <h3 class="modal-title capitalize !border-0 !pb-0" id="dtb_nama_header"></h3>
        <div class="modal-body">
            @foreach (['dtb_kode_barang', 'dtb_nama_barang', 'dtb_jenis_barang', 'dtb_merk_barang', 'dtb_satuan_barang', 'dtb_stok_barang', 'dtb_barang_didaftar', 'dtb_barang_diupdate'] as $item)
                <div>
                    <h1 class="font-bold text-sm capitalize">{{ explode('dtb', str_replace('_', ' ', $item))[1] }}
                    </h1>
                    <h1 id="{{ $item }}"></h1>
                </div>
            @endforeach
        </div>
        <form method="dialog">
            <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
        </form>
    </div>
</dialog>

<script>
    let dataz = {!! json_encode($barang) !!}
    let s = 0
    let e = 0

    setInterval(() => {
        s = 1
        e = 1
    }, 1000);

    var scanner = new QrScanner(el('bc_scanner'), scan => {
        let data = dataz.find(y => y.kode == scan.data)

        el('bc_scanner_output').innerText = scan.data
        el('bc_scanner_output').classList.remove('text-red-500')

        if (data) {
            if (s) {
                s = 0
                createjs.Sound.play('ding')
            }
            stopScanner()
            el('dtb_nama_header').innerText = data.nama
            el('dtb_kode_barang').innerText = data.kode
            el('dtb_nama_barang').innerText = data.nama
            el('dtb_jenis_barang').innerText = `${data.jenis.kode_jenis} - ${data.jenis.jenis}`
            el('dtb_merk_barang').innerText = `${data.merk.kode} - ${data.merk.merk}`
            el('dtb_satuan_barang').innerText = data.satuan
            el('dtb_stok_barang').innerText = data.stok

            el('dtb_barang_didaftar').innerText = dayjs(data.created_at).format('HH:mm:ss DD/MM/YYYY')
            el('dtb_barang_diupdate').innerText = dayjs(data.updated_at).format('HH:mm:ss DD/MM/YYYY')

            el('detail_barang_modal').showModal()
            el('scan_kode_barang_modal').close()
        } else {
            el('bc_scanner_output').innerText = 'Tidak dapat menemukan barang.'
            el('bc_scanner_output').classList.add('text-red-500')
            if (e) {
                e = 0
                createjs.Sound.play('error')
            }
        }
    }, {
        highlightScanRegion: true,
        highlightCodeOutline: true,
    });

    stopScanner();

    function initScanner() {
        scanner.start()
    }

    function stopScanner() {
        s = 0
        e = 0
        scanner.stop()
        el('bc_scanner_output').innerText = ''
    }
</script>
