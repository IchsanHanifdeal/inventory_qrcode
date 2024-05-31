<x-dashboard.main title="Kelola Barang Keluar">
    <div class="flex flex-col xl:flex-row gap-5">
        @foreach (['jumlah_barang_keluar', 'tambah_barang_keluar'] as $item)
            <div onclick="{{ $item . '_modal' }}.showModal()"
                class="
                  {{ $item == 'tambah_barang_keluar' ? 'hover:shadow-md active:scale-[.97] border border-blue-200 cursor-pointer' : '' }}
                  flex {{ $item == 'jumlah_barang_keluar' ? 'flex-col sm:flex-row !items-start sm:items-center gap-5' : '' }} items-center justify-between p-5 sm:p-7 bg-white border-back rounded-xl w-full">
                <div>
                    <h1 class="flex items-start gap-3 font-semibold font-[onest] sm:text-lg capitalize">
                        {{ str_replace('_', ' ', $item) }}
                    </h1>
                    <p class="text-sm opacity-60">
                        {{ $item == 'jumlah_barang_keluar' ? 'Jumlah keseluruhan transaksi barang keluar.' : '' }}
                        {{ $item == 'tambah_barang_keluar' ? 'Menambahkan transaksi barang keluar.' : '' }}
                    </p>
                </div>
                <h1
                    class="{{ $item == 'jumlah_barang_keluar' ? '' : 'hidden' }} text-3xl sm:text-4xltext-4xl font-semibold">
                    {{ $jumlah_keluar }}
                </h1>
                <x-lucide-plus
                    class="{{ $item == 'tambah_barang_keluar' ? '' : 'hidden' }} size-5 sm:size-7 opacity-60" />
            </div>
        @endforeach
    </div>
    <div class="flex gap-5">
        @foreach (['manajemen_barang_keluar'] as $item)
            <div class="flex flex-col border-back rounded-xl w-full">
                <div class="p-5 sm:p-7 bg-white rounded-t-xl">
                    <h1 class="flex items-start gap-3 font-semibold font-[onest] sm:text-lg capitalize">
                        {{ str_replace('_', ' ', $item) }}
                    </h1>
                    <p class="text-sm opacity-60">Kelola barang keluar dengan efisien dan efektif</p>
                </div>
                <div class="w-full px-5 sm:px-7 bg-zinc-50">
                    <input type="text" placeholder="Cari data disini...." name="nama_barang" class="input input-sm shadow-md w-full bg-zinc-100">
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
                                @if ($barang_keluar->isEmpty())
                                    <tr>
                                        <td colspan="9" class="text-center">Tidak ada barang keluar</td>
                                    </tr>
                                @endif
                                @foreach ($barang_keluar as $i => $item)
                                    <tr class="whitespace-nowrap">
                                        <th>{{ $i + 1 }}</th>
                                        <td class="uppercase font-semibold opacity-70">{{ $item->barang->kode }}</td>
                                        <td class="text-blue-500 font-semibold hover:underline cursor-pointer">
                                            {{ $item->barang->nama }}
                                        </td>
                                        <td class="font-semibold">{{ $item->jumlah }}</td>
                                        <td class="font-semibold uppercase">{{ $item->barang->satuan }}</td>
                                        <td class="uppercase">{{ $item->barang->jenis->jenis }}</td>
                                        <td class="uppercase">{{ $item->barang->merk->merk }}</td>
                                        <td>{{ $item->updated_at }}</td>
                                        <td>{{ $item->created_at }}</td>
                                        <td class="flex items-center gap-4">
                                            {{-- <x-lucide-square-pen class="size-5 hover:stroke-blue-500 cursor-pointer" />
                                            <x-lucide-trash-2 class="size-5 hover:stroke-rose-500 cursor-pointer" /> --}}
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

<dialog id="tambah_barang_keluar_modal" class="modal modal-bottom sm:modal-middle">
    <form action="{{ route('store.barangkeluar') }}" method="POST" class="modal-box">
        @csrf
        <h3 class="modal-title capitalize">
            Tambah Barang Keluar
        </h3>
        <div class="modal-body">
            <div class="input-label">
                <h1 class="label">Masukan Barang Keluar:</h1>
                <select required name="barang_keluar" class="uppercase select select-sm">
                    @foreach ($barang as $b)
                        <option value="{{ $b->id_barang }}">{{ $b->kode }} - {{ $b->nama }}</option>
                    @endforeach
                </select>
                @error('barang_keluar')
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
            <button onclick="tambah_barang_keluar_modal.close()" class="btn" type="button">Tutup</button>
            <button type="submit" class="btn btn-secondary capitalize">
                Tambah Barang Keluar</button>
        </div>
    </form>
</dialog>
