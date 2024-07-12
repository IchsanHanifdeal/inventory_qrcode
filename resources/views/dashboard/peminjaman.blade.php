<x-dashboard.main title="Peminjaman Barang">
    <div class="flex flex-col xl:flex-row gap-5">
        @foreach (['jumlah_peminjaman_masuk', 'jumlah_peminjaman_dikonfirmasi', 'jumlah_peminjaman_ditolak'] as $item)
            <div onclick="{{ $item . '_modal' }}.showModal()"
                class="
                  {{ $item == 'jumlah_peminjaman_masuk' ? '' : 'flex-col sm:flex-row !items-start sm:items-center gap-5' }}
                  flex {{ $item == 'jumlah_peminjaman_dikonfirmasi' ? 'flex-col sm:flex-row !items-start sm:items-center gap-5' : '' }} 
                  flex {{ $item == 'jumlah_peminjaman_ditolak' ? 'flex-col sm:flex-row !items-start sm:items-center gap-5' : '' }} items-center justify-between p-5 sm:p-7 bg-white border-back rounded-xl w-full">
                <div>
                    <h1 class="flex items-start gap-3 font-semibold font-[onest] sm:text-lg capitalize">
                        {{ str_replace('_', ' ', $item) }}
                    </h1>
                    <p class="text-sm opacity-60">
                        {{ $item == 'jumlah_peminjaman_masuk' ? 'Jumlah Peminjaman yang masuk.' : '' }}
                        {{ $item == 'jumlah_peminjaman_dikonfirmasi' ? 'Jumlah Peminjaman yang telah dikonfirmasi.' : '' }}
                        {{ $item == 'jumlah_peminjaman_ditolak' ? 'Jumlah Peminjaman yang telah ditolak.' : '' }}
                    </p>
                </div>
                <h1 class="{{ $item == 'jumlah_peminjaman_masuk' ? '' : 'hidden' }} text-3xl sm:text-4xl font-semibold">
                    {{ $total_peminjaman }}
                </h1>
                <h1
                    class="{{ $item == 'jumlah_peminjaman_dikonfirmasi' ? '' : 'hidden' }} text-3xl sm:text-4xl font-semibold">
                    {{ $total_diterima }}
                </h1>
                <h1
                    class="{{ $item == 'jumlah_peminjaman_ditolak' ? '' : 'hidden' }} text-3xl sm:text-4xl font-semibold">
                    {{ $total_ditolak }}
                </h1>
            </div>
        @endforeach
    </div>
    <div class="flex gap-5">
        @foreach (['manajemen_peminjaman'] as $item)
            <div class="flex flex-col border-back rounded-xl w-full">
                <div class="p-5 sm:p-7 bg-white rounded-t-xl">
                    <h1 class="flex items-start gap-3 font-semibold font-[onest] sm:text-lg capitalize">
                        {{ str_replace('_', ' ', $item) }}
                    </h1>
                    <p class="text-sm opacity-60">Kelola Peminjaman barang dengan cermat dan efektif</p>
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
                                    @foreach (['no', 'Nama Peminjam', 'Perihal', 'Nama Barang', 'Pengembalian', 'validasi', 'last update', 'register', ''] as $item)
                                        <th class="uppercase font-bold">{{ $item }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @if ($peminjaman->isEmpty())
                                    <tr>
                                        <td colspan="9" class="text-center">Tidak ada Peminjaman</td>
                                    </tr>
                                @endif
                                @foreach ($peminjaman as $i => $item)
                                    <tr class="whitespace-nowrap">
                                        <th>{{ $i + 1 }}</th>
                                        <td class="uppercase font-semibold">{{ $item->user->name }}</td>
                                        <td class="uppercase font-semibold">
                                            {{ $item->perihal }}
                                        </td>
                                        <td class="font-semibold">{{ $item->barang->kode }} -
                                            {{ $item->barang->nama }}</td>
                                        <td class="font-semibold uppercase">{{ $item->pengembalian }}</td>
                                        <td class="font-semibold uppercase">{{ $item->validasi }}</td>
                                        <td class="uppercase">{{ $item->updated_at }}</td>
                                        <td class="uppercase">{{ $item->created_at }}</td>
                                        @if ($item->validasi === 'menunggu persetujuan')
                                            <td>
                                            <td>
                                                <button
                                                    onclick="document.getElementById('terima_peminjaman_modal_{{ $item->id_peminjaman }}').showModal();initUpdate('peminjaman', {{ $item->id_peminjaman }});"
                                                    class="btn btn-emerald m-2">Terima</button> |
                                                <button
                                                    onclick="document.getElementById('tolak_peminjaman_modal_{{ $item->id_peminjaman }}').showModal();"
                                                    class="btn btn-outline btn-error m-2">Tolak</button>
                                            </td>
                                            </td>
                                        @elseif ($item->validasi === 'dikonfirmasi')
                                            <td>
                                                <x-lucide-check class="stroke-emerald-500"
                                                    style="width: 20px; height: 20px;" />
                                            </td>
                                        @elseif ($item->validasi === 'ditolak')
                                            <td>
                                                <x-lucide-x class="stroke-emerald-500"
                                                    style="width: 20px; height: 20px;" />
                                            </td>
                                        @else
                                            <td class="uppercase">undefined</td>
                                        @endif
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

@foreach ($peminjaman as $i => $pe)
    @foreach (['terima', 'tolak'] as $action)
        <dialog id="{{ $action }}_peminjaman_modal_{{ $pe->id_peminjaman }}"
            class="modal modal-bottom sm:modal-middle">
            <form action="{{ route ($action . '_' . 'peminjaman', ['id_peminjaman' => $pe->id_peminjaman])}}" method="POST" class="modal-box">
                @csrf
                @method('PUT')
                <h3 class="modal-title capitalize">
                    {{ $action }} peminjaman
                </h3>
                <div class="modal-body">
                    <div class="input-label">
                        <h1 class="label">Apakah anda akan {{ $action }} peminjaman {{ $pe->barang->kode }} - {{ $pe->barang->nama }} yang akan dipinjam oleh {{ $pe->user->name }}?</h1>
                    </div>
                </div>
                <div class="modal-action">
                    <button
                        onclick="document.getElementById('{{ $action }}_peminjaman_modal_{{ $pe->id_peminjaman }}').close();"
                        class="btn" type="button">Tutup</button>
                    <button type="submit" class="btn btn-secondary capitalize">
                        {{ $action }}
                    </button>
                </div>
            </form>
        </dialog>
    @endforeach
@endforeach
