<x-dashboard.main title="Kelola Barang">
    <div class="grid sm:grid-cols-2 xl:grid-cols-4 gap-5 md:gap-6">
        @foreach (['total_barang', 'stok_barang', 'barang_masuk', 'barang_keluar'] as $type)
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
                        {{ $type == 'total_barang' ? 839483 : 10 }}
                    </p>
                </div>
            </div>
        @endforeach
    </div>
   <div class="flex flex-col lg:flex-row gap-5">
        @foreach (['detail_barang', 'tambah_barang'] as $item)
            <div
                class="flex items-center justify-between p-5 sm:p-7 hover:shadow-md active:scale-[.97] border border-blue-200 bg-white cursor-pointer border-back rounded-xl w-full">
                <div>
                    <h1 class="flex items-start gap-3 font-semibold font-[onest] sm:text-lg capitalize">
                        {{ str_replace('_', ' ', $item) }}
                    </h1>
                    <p class="text-sm opacity-60">
                        {{ $item == 'detail_barang' ? 'Cari detail info tentang barang' : '' }}
                        {{ $item == 'tambah_barang' ? 'Menambahkan barang untuk di kelola' : '' }}
                    </p>
                </div>
                <x-lucide-scan-line class="{{ $item == 'detail_barang' ? '' : 'hidden' }} size-5 sm:size-7 opacity-60" />
                <x-lucide-plus class="{{ $item == 'tambah_barang' ? '' : 'hidden' }} size-5 sm:size-7 opacity-60" />
            </div>
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
                                @foreach ([1, 1, 1, 1, 1] as $i => $item)
                                    <tr class="whitespace-nowrap">
                                        <th>{{ $i + 1 }}</th>
                                        <td class="uppercase font-semibold opacity-70">#PKNUNC7973950</td>
                                        <td class="text-blue-500 font-semibold hover:underline cursor-pointer">
                                            Celana Jeans Uniclo [XL]
                                        </td>
                                        <td class="font-semibold">884</td>
                                        <td class="font-semibold uppercase">PCS</td>
                                        <td class="uppercase">pakaian</td>
                                        <td class="uppercase">uniclo</td>
                                        <td>12:22 20/09/2023</td>
                                        <td>12:22 20/09/2023</td>
                                        <td class="flex items-center gap-4">
                                            <x-lucide-square-pen class="size-5 hover:stroke-blue-500 cursor-pointer" />
                                            <x-lucide-trash-2 class="size-5 hover:stroke-rose-500 cursor-pointer" />
                                            <x-lucide-qr-code class="size-5 hover:stroke-emerald-500 cursor-pointer" />
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
