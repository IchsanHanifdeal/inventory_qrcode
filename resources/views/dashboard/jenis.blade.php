<x-dashboard.main title="Kelola Jenis Barang">
    <div class="grid sm:grid-cols-2 gap-5 md:gap-6">
        @foreach (['total_jenis', 'jenis_terbaru'] as $type)
            <div class="flex items-center px-4 py-3 bg-white border-back rounded-xl">
                <span
                    class="
                  {{ $type == 'total_jenis' ? 'bg-blue-300' : '' }}
                  {{ $type == 'jenis_terbaru' ? 'bg-amber-300' : '' }}
                  p-3 mr-4 text-gray-700 rounded-full"></span>
                <div>
                    <p class="text-sm font-medium capitalize text-gray-600 line-clamp-1">
                        {{ str_replace('_', ' ', $type) }}
                    </p>
                    <p class="text-lg font-semibold text-gray-700 line-clamp-1">
                        {{ $type == 'total_jenis' ? $total_jenis : '' }}
                        {{ $type == 'jenis_terbaru' ? $jenis_terbaru->jenis ?? '-' : '' }}
                    </p>
                </div>
            </div>
        @endforeach
    </div>
    <div class="flex flex-col lg:flex-row gap-5">
        @foreach (['tambah_jenis_barang'] as $item)
            <div onclick="{{ $item . '_modal' }}.showModal()"
                class="flex items-center justify-between p-5 sm:p-7 hover:shadow-md active:scale-[.97] border border-blue-200 bg-white cursor-pointer border-back rounded-xl w-full">
                <div>
                    <h1 class="flex items-start gap-3 font-semibold font-[onest] sm:text-lg capitalize">
                        {{ str_replace('_', ' ', $item) }}
                    </h1>
                    <p class="text-sm opacity-60">
                        {{ $item == 'tambah_jenis_barang' ? 'Menambahkan jenis untuk barang' : '' }}
                    </p>
                </div>
                <x-lucide-plus
                    class="{{ $item == 'tambah_jenis_barang' ? '' : 'hidden' }} size-5 sm:size-7 opacity-60" />
            </div>
        @endforeach
    </div>
    <div class="flex gap-5">
        @foreach (['manajemen_jenis_barang'] as $item)
            <div class="flex flex-col border-back rounded-xl w-full">
                <div class="p-5 sm:p-7 bg-white rounded-t-xl">
                    <h1 class="flex items-start gap-3 font-semibold font-[onest] text-lg capitalize">
                        {{ str_replace('_', ' ', $item) }}
                    </h1>
                    <p class="text-sm opacity-60">
                        Kelola lebih mudah dengan memberi jenis barang.
                    </p>
                </div>
                <div class="w-full px-5 sm:px-7 bg-zinc-50">
                    <input type="text" placeholder="Cari data disini...." name="nama_barang" id="searchInput" class="input input-sm shadow-md w-full bg-zinc-100">
                </div>
                <div class="flex flex-col bg-zinc-50 rounded-b-xl gap-3 divide-y pt-0 p-5 sm:p-7">
                    <div class="overflow-x-auto">
                        <table class="table table-zebra" id="dataTable">
                            <thead>
                                <tr>
                                    @foreach (['no', 'kode jenis', 'jenis barang', 'register', ''] as $item)
                                        <th class="uppercase font-bold">{{ $item }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($jenis as $i => $item)
                                    <tr>
                                        <th>{{ $i + 1 }}</th>
                                        <td class="font-semibold uppercase">{{ $item->kode_jenis }}</td>
                                        <td
                                            class="text-blue-500 font-semibold uppercase hover:underline cursor-pointer">
                                            {{ $item->jenis }}
                                        </td>
                                        <td>{{ $item->created_at }}</td>
                                        <td class="flex items-center gap-4">
                                            <x-lucide-square-pen
                                            onclick="update_jenis_modal_{{ $item->id_jenis }}.showModal();initUpdate('jenis', {{ $item }})"
                                            class="size-5 hover:stroke-blue-500 cursor-pointer" />

                                            <dialog id="update_jenis_modal_{{ $item->id_jenis }}" class="modal modal-bottom sm:modal-middle">
                                                <form method="POST" class="modal-box" action="{{ route('update.jenis', ['id_jenis' => $item->id_jenis] ) }}">
                                                    @method('PUT')
                                                    @csrf
                                                    <h3 class="modal-title capitalize">
                                                        Update jenis {{ $item->jenis }}
                                                    </h3>
                                                    <div class="modal-body">
                                                        <div class="input-label">
                                                            <h1 class="label">Masukan Kode jenis:</h1>
                                            
                                                            {{-- name => kode_jenis 'atau' kode_jenis --}}
                                                            <input required id="up_kode_jenis"
                                                                name="up_kode_jenis" type="text"
                                                                placeholder="Contoh: {{ $item == 'update_jenis_modal' ? 'UNC' : 'PKN' }}" value="{{ $item->kode }}">
                                                            @error('up_kode_jenis')
                                                                <span class="validated">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <div class="input-label">
                                                            <h1 class="label">Masukan Nama jenis:</h1>
                                            
                                                            {{-- name => nama_jenis 'atau' nama_jenis --}}
                                                            <input required id="up_nama_jenis"
                                                                name="up_nama_jenis" type="text"
                                                                placeholder="Contoh: {{ $item == 'update_jenis_modal' ? 'Uniclo' : 'Pakaian' }}" value="{{ $item->jenis }}">
                                                            @error('up_nama_jenis')
                                                                <span class="validated">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="modal-action">
                                                        <button onclick="update_jenis_modal_{{ $item->id_jenis }}.close()" class="btn" type="button">Tutup</button>
                                                        <button type="submit" class="btn btn-secondary capitalize">
                                                            Update jenis
                                                        </button>
                                                    </div>
                                                </form>
                                            </dialog>

                                            <x-lucide-trash-2
                                                onclick="delete_modal.showModal();initDelete('jenis', {{ $item }})"
                                                class="size-5 hover:stroke-rose-500 cursor-pointer" />
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
