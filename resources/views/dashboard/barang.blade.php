<x-dashboard.main title="Kelola Barang">
    <div class="grid md:grid-cols-2 xl:grid-cols-4 gap-6">
        @foreach (['total_barang', 'barang_masuk', 'barang_keluar', 'merk_terdaftar'] as $type)
            <div class="flex items-center px-4 py-3 bg-white border-back rounded-xl">
                <span
                    class="
                  {{ $type == 'total_barang' ? 'bg-blue-300' : '' }}
                  {{ $type == 'barang_masuk' ? 'bg-green-300' : '' }}
                  {{ $type == 'barang_keluar' ? 'bg-rose-300' : '' }}
                  {{ $type == 'merk_terdaftar' ? 'bg-amber-300' : '' }}
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
    <div class="flex gap-5">
        @foreach (['user_aktif', 'admin_aktif'] as $item)
            <div class="p-7 bg-white border-back rounded-xl w-full">
                <h1 class="flex items-start gap-3 font-semibold font-[onest] text-lg capitalize">
                    {{ str_replace('_', ' ', $item) }} <span
                        class="badge badge-sm badge-warning animate-pulse">realtime</span>
                </h1>
                <p class="text-sm opacity-60">Data dalam 2 menit terakhir</p>
                <h1 class="border-b my-5 w-full"></h1>
                <h1 class="text-4xl font-semibold">
                    12
                </h1>
            </div>
        @endforeach
    </div>
    <div class="flex gap-5">
        @foreach (['manajemen_barang'] as $item)
            <div class="flex flex-col border-back rounded-xl w-full">
                <div class="p-7 bg-white rounded-t-xl">
                    <h1 class="flex items-start gap-3 font-semibold font-[onest] text-lg capitalize">
                        {{ str_replace('_', ' ', $item) }}
                    </h1>
                    <p class="text-sm opacity-60">Kelola barang dengan efisien dan efektif</p>
                </div>
                <div class="flex flex-col bg-zinc-50 rounded-b-xl gap-3 divide-y pt-0 p-7">
                    <div class="overflow-x-auto">
                        <table class="table table-zebra">
                            <thead>
                                <tr>
                                    @foreach (['no', 'kode barang', 'nama barang', 'stok barang', 'jenis barang', 'merek barang', 'last update', 'register', ''] as $item)
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
                                        <td class="font-semibold text-center">884</td>
                                        <td class="text-center uppercase">pakaian</td>
                                        <td class="text-center uppercase">uniclo</td>
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
