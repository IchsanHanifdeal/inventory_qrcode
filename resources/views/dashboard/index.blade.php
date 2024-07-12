<x-dashboard.main title="Dashboard">
    <div class="grid sm:grid-cols-2 xl:grid-cols-4 gap-5 md:gap-6">
        @foreach (['total_barang', 'total_merek', 'total_jenis', 'total_user'] as $type)
            @if ($role !== 'user' || $type === 'total_barang')
                <div class="flex items-center px-4 py-3 bg-white border-back rounded-xl">
                    <span
                        class="
                      {{ $type == 'total_barang' ? 'bg-blue-300' : '' }}
                      {{ $type == 'total_merek' ? 'bg-green-300' : '' }}
                      {{ $type == 'total_jenis' ? 'bg-rose-300' : '' }}
                      {{ $type == 'total_user' ? 'bg-amber-300' : '' }}
                      p-3 mr-4 text-gray-700 rounded-full"></span>
                    <div>
                        <p class="text-sm font-medium capitalize text-gray-600 line-clamp-1">
                            {{ str_replace('_', ' ', $type) }}
                        </p>
                        <p class="text-lg font-semibold text-gray-700 line-clamp-1">
                            {{ $type == 'total_barang' ? $totalBarang : '' }}
                            {{ $type == 'total_merek' ? $totalMerk : '' }}
                            {{ $type == 'total_jenis' ? $totalJenis : '' }}
                            {{ $type == 'total_user' ? $totalUser : '' }}
                        </p>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
    
    @if ($role !== 'user')
        <div class="flex flex-col xl:flex-row gap-5">
            @foreach (['transaksi_barang_masuk', 'transaksi_barang_keluar'] as $index => $item)
                <div
                    class="flex flex-col sm:flex-row sm:items-center gap-5 justify-between p-5 sm:p-7 bg-white border-back rounded-xl w-full">
                    <div>
                        <h1 class="flex items-start gap-3 font-semibold font-[onest] sm:text-lg capitalize">
                            {{ str_replace('_', ' ', $item) }}
                        </h1>
                        <p class="text-sm opacity-60">Berdasarkan pada jumlah keseluruhan.</p>
                    </div>
                    <h1 class="text-3xl sm:text-4xl font-semibold">
                        @if ($loop->first)
                            {{ $totalMasuk }}
                        @else
                            {{ $totalKeluar }}
                        @endif
                    </h1>
                </div>
            @endforeach
        </div>
    
        <div class="flex flex-col xl:flex-row gap-5">
            @foreach (['barang_masuk', 'barang_keluar'] as $key => $jenis)
                <div class="flex flex-col border-back rounded-xl w-full">
                    <div class="p-5 sm:p-7 bg-white rounded-t-xl">
                        <h1 class="flex items-start gap-3 font-semibold font-[onest] sm:text-lg capitalize">
                            {{ str_replace('_', ' ', $jenis) }} <span
                                class="badge badge-xs sm:badge-sm uppercase badge-secondary">baru</span>
                        </h1>
                        <p class="text-sm opacity-60">Berdasarkan data pada {{ date('d-m-Y') }}</p>
                    </div>
                    <div class="flex flex-col bg-zinc-50 rounded-b-xl gap-3 divide-y pt-0 p-5">
                        @forelse (${$jenis} as $index => $data)
                            <div class="flex items-center gap-5 pt-3">
                                <h1>{{ $index + 1 }}</h1>
                                <div>
                                    <h1 class="opacity-50 text-sm font-semibold">#{{ $data->barang->kode }}</h1>
                                    <h1 class="font-semibold text-sm sm:text-[15px] hover:underline cursor-pointer">
                                        {{ $data->barang->nama }}</h1>
                                </div>
                            </div>
                        @empty
                            <div class="flex items-center gap-5 pt-3">
                                <h1>Data transaksi tidak ada.</h1>
                            </div>
                        @endforelse
                    </div>
                </div>
            @endforeach
        </div>
    @endif
    
    @if ($role === 'user')
        <div class="flex flex-col xl:flex-row gap-5">
            <div class="flex flex-col border-back rounded-xl w-full">
                <div class="p-5 sm:p-7 bg-white rounded-t-xl">
                    <h1 class="flex items-start gap-3 font-semibold font-[onest] sm:text-lg capitalize">
                        Tabel Barang
                    </h1>
                    <p class="text-sm opacity-60">Berikut adalah daftar barang yang tersedia.</p>
                </div>
                <div class="flex flex-col bg-zinc-50 rounded-b-xl gap-3 divide-y pt-0 p-5">
                    @forelse ($barang as $index => $data)
                        <div class="flex items-center gap-5 pt-3">
                            <h1>{{ $index + 1 }}</h1>
                            <div>
                                <h1 class="opacity-50 text-sm font-semibold">#{{ $data->kode }}</h1>
                                <h1 class="font-semibold text-sm sm:text-[15px] hover:underline cursor-pointer">
                                    {{ $data->nama }}
                                </h1>
                            </div>
                        </div>
                    @empty
                        <div class="flex items-center gap-5 pt-3">
                            <h1>Data barang tidak ada.</h1>
                        </div>
                    @endforelse
                </div>
            </div>
    
            <div class="flex flex-col border-back rounded-xl w-full">
                <div class="p-5 sm:p-7 bg-white rounded-t-xl">
                    <h1 class="flex items-start gap-3 font-semibold font-[onest] sm:text-lg capitalize">
                        Tabel Peminjaman
                    </h1>
                    <p class="text-sm opacity-60">Berikut adalah daftar peminjaman Anda.</p>
                </div>
                <div class="flex flex-col bg-zinc-50 rounded-b-xl gap-3 divide-y pt-0 p-5">
                    @forelse ($peminjaman as $index => $data)
                        <div class="flex items-center gap-5 pt-3">
                            <h1>{{ $index + 1 }}</h1>
                            <div>
                                <h1 class="opacity-50 text-sm font-semibold">#{{ $data->barang->kode }}</h1>
                                <h1 class="font-semibold text-sm sm:text-[15px] hover:underline cursor-pointer">
                                    {{ $data->barang->nama }}
                                </h1>
                            </div>
                        </div>
                    @empty
                        <div class="flex items-center gap-5 pt-3">
                            <h1>Data peminjaman tidak ada.</h1>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    @endif    
</x-dashboard.main>
