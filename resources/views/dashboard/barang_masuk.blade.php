<x-dashboard.main title="Kelola Barang Masuk">
    <div class="flex flex-col xl:flex-row gap-5">
        @foreach (['jumlah_barang_masuk', 'tambah_barang_masuk'] as $item)
            <div
                class="
                  {{ $item == 'tambah_barang_masuk' ? 'hover:shadow-md active:scale-[.97] border border-blue-200 cursor-pointer' : '' }}
                  flex {{ $item == 'jumlah_barang_masuk' ? 'flex-col sm:flex-row !items-start sm:items-center gap-5' : '' }} items-center justify-between p-5 sm:p-7 bg-white border-back rounded-xl w-full">
                <div>
                    <h1 class="flex items-start gap-3 font-semibold font-[onest] sm:text-lg capitalize">
                        {{ str_replace('_', ' ', $item) }}
                    </h1>
                    <p class="text-sm opacity-60">
                        {{ $item == 'jumlah_barang_masuk' ? 'Jumlah keseluruhan transaksi barang masuk.' : '' }}
                        {{ $item == 'tambah_barang_masuk' ? 'Menambahkan transaksi barang masuk.' : '' }}
                    </p>
                </div>
                <h1 class="{{ $item == 'jumlah_barang_masuk' ? '' : 'hidden' }} text-3xl sm:text-4xl font-semibold">
                    344
                </h1>
                <x-lucide-plus
                    class="{{ $item == 'tambah_barang_masuk' ? '' : 'hidden' }} size-5 sm:size-7 opacity-60" />
            </div>
        @endforeach
    </div>
    <div class="flex gap-5">
        @foreach (['manajemen_barang_masuk'] as $item)
            <div class="flex flex-col border-back rounded-xl w-full">
                <div class="p-5 sm:p-7 bg-white rounded-t-xl">
                    <h1 class="flex items-start gap-3 font-semibold font-[onest] sm:text-lg capitalize">
                        {{ str_replace('_', ' ', $item) }}
                    </h1>
                    <p class="text-sm opacity-60">Kelola barang masuk dengan efisien dan efektif</p>
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
