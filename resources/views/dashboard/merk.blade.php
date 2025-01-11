<x-dashboard.main title="Kelola Merek Barang">
    <div class="grid sm:grid-cols-2 gap-5 md:gap-6">
        @foreach (['total_merek', 'merek_terbaru'] as $type)
            <div class="flex items-center px-4 py-3 bg-white border-back rounded-xl">
                <span
                    class="
                  {{ $type == 'total_merek' ? 'bg-blue-300' : '' }}
                  {{ $type == 'merek_terbaru' ? 'bg-amber-300' : '' }}
                  p-3 mr-4 text-gray-700 rounded-full"></span>
                <div>
                    <p class="text-sm font-medium capitalize text-gray-600 line-clamp-1">
                        {{ str_replace('_', ' ', $type) }}
                    </p>
                    <p class="text-lg font-semibold text-gray-700 line-clamp-1">
                        {{ $type == 'total_merek' ? $total_merk : '' }}
                        {{ $type == 'merek_terbaru' ? $merk_terbaru->merk ?? '-' : '' }}
                    </p>
                </div>
            </div>
        @endforeach
    </div>
    <div class="flex flex-col lg:flex-row gap-5">
        @foreach (['tambah_merek'] as $item)
            <div onclick="{{ $item . '_modal' }}.showModal()"
                class="flex items-center justify-between p-5 sm:p-7 hover:shadow-md active:scale-[.97] border border-blue-200 bg-white cursor-pointer border-back rounded-xl w-full">
                <div>
                    <h1 class="flex items-start gap-3 font-semibold font-[onest] sm:text-lg capitalize">
                        {{ str_replace('_', ' ', $item) }}
                    </h1>
                    <p class="text-sm opacity-60">
                        {{ $item == 'tambah_merek' ? 'Menambahkan merek untuk barang' : '' }}
                    </p>
                </div>
                <x-lucide-plus class="{{ $item == 'tambah_merek' ? '' : 'hidden' }} size-5 sm:size-7 opacity-60" />
            </div>
        @endforeach
    </div>
    <div class="flex gap-5">
        @foreach (['manajemen_merek_barang'] as $item)
            <div class="flex flex-col border-back rounded-xl w-full">
                <div class="p-5 sm:p-7 bg-white rounded-t-xl">
                    <h1 class="flex items-start gap-3 font-semibold font-[onest] sm:text-lg capitalize">
                        {{ str_replace('_', ' ', $item) }}
                    </h1>
                    <p class="text-sm opacity-60">
                        Buat identitas setiap barang dengan menambahkan merek.
                    </p>
                </div>
                <div class="w-full px-5 sm:px-7 bg-zinc-50">
                    <input type="text" id="searchInput" placeholder="Cari data disini...." class="input input-sm shadow-md w-full bg-zinc-100" onkeyup="searchTable()">
                </div>
                <div class="flex flex-col bg-zinc-50 rounded-b-xl gap-3 divide-y pt-0 p-5 sm:p-7">
                    <div class="overflow-x-auto">
                        <table class="table table-zebra" id="dataTable">
                            <thead>
                                <tr>
                                    @foreach (['no', 'kode merek', 'nama merek', 'register', ''] as $item)
                                        <th class="uppercase font-bold">{{ $item }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($merk as $i => $item)
                                    <tr>
                                        <th>{{ $i + 1 }}</th>
                                        <td class="font-semibold uppercase">{{ $item->kode }}</td>
                                        <td class="text-blue-500 font-semibold hover:underline cursor-pointer">
                                            {{ $item->merk }}
                                        </td>
                                        <td>{{ $item->created_at }}</td>
                                        <td class="flex items-center gap-4">
                                            <x-lucide-square-pen
                                                onclick="update_merek_modal_{{ $item->id_merk }}.showModal();initUpdate('merk', {{ $item }})"
                                                class="size-5 hover:stroke-blue-500 cursor-pointer" />

                                            <dialog id="update_merek_modal_{{ $item->id_merk }}"
                                                class="modal modal-bottom sm:modal-middle">
                                                <form method="POST" class="modal-box"
                                                    action="{{ route('update.merek', ['id_merk' => $item->id_merk]) }}">
                                                    @method('PUT')
                                                    @csrf
                                                    <h3 class="modal-title capitalize">
                                                        Update Merek {{ $item->merk }}
                                                    </h3>
                                                    <div class="modal-body">
                                                        <div class="input-label">
                                                            <h1 class="label">Masukan Kode Merek:</h1>

                                                            {{-- name => kode_merek 'atau' kode_jenis --}}
                                                            <input required id="up_kode_Merek" name="up_kode_merek"
                                                                type="text"
                                                                placeholder="Contoh: {{ $item == 'update_merek_modal' ? 'UNC' : 'PKN' }}"
                                                                value="{{ $item->kode }}">
                                                            @error('up_kode_merek')
                                                                <span class="validated">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <div class="input-label">
                                                            <h1 class="label">Masukan Nama Merek:</h1>

                                                            {{-- name => nama_merek 'atau' nama_jenis --}}
                                                            <input required id="up_nama_Merek" name="up_nama_merek"
                                                                type="text"
                                                                placeholder="Contoh: {{ $item == 'update_merek_modal' ? 'Uniclo' : 'Pakaian' }}"
                                                                value="{{ $item->merk }}">
                                                            @error('up_nama_merek')
                                                                <span class="validated">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="modal-action">
                                                        <button
                                                            onclick="update_merek_modal_{{ $item->id_merk }}.close()"
                                                            class="btn" type="button">Tutup</button>
                                                        <button type="submit" class="btn btn-secondary capitalize">
                                                            Update Merek
                                                        </button>
                                                    </div>
                                                </form>
                                            </dialog>

                                            <x-lucide-trash-2
                                                onclick="delete_modal.showModal();initDelete('merk', {{ $item }})"
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
