<x-dashboard.main title="Peminjaman Barang">
    <div class="flex flex-col xl:flex-row gap-5">
        @foreach (['jumlah_peminjaman_masuk', 'jumlah_peminjaman_dikonfirmasi', 'jumlah_peminjaman_ditolak', 'jumlah_barang_dikembalikan'] as $item)
            <div onclick="{{ $item . '_modal' }}.showModal()"
                class="
                  {{ $item == 'jumlah_peminjaman_masuk' ? '' : 'flex-col sm:flex-row !items-start sm:items-center gap-5' }}
                  flex {{ $item == 'jumlah_peminjaman_dikonfirmasi' ? 'flex-col sm:flex-row !items-start sm:items-center gap-5' : '' }} 
                  flex {{ $item == 'jumlah_peminjaman_ditolak' ? 'flex-col sm:flex-row !items-start sm:items-center gap-5' : '' }} 
                  flex {{ $item == 'jumlah_barang_dikembalikan' ? 'flex-col sm:flex-row !items-start sm:items-center gap-5' : '' }} items-center justify-between p-5 sm:p-7 bg-white border-back rounded-xl w-full">
                <div>
                    <h1 class="flex items-start gap-3 font-semibold font-[onest] sm:text-lg capitalize">
                        {{ str_replace('_', ' ', $item) }}
                    </h1>
                    <p class="text-sm opacity-60">
                        {{ $item == 'jumlah_peminjaman_masuk' ? 'Jumlah Peminjaman yang masuk.' : '' }}
                        {{ $item == 'jumlah_peminjaman_dikonfirmasi' ? 'Jumlah Peminjaman yang telah dikonfirmasi.' : '' }}
                        {{ $item == 'jumlah_peminjaman_ditolak' ? 'Jumlah Peminjaman yang telah ditolak.' : '' }}
                        {{ $item == 'jumlah_barang_dikembalikan' ? 'Jumlah Barang yang telah dikembalikan.' : '' }}
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
                <h1
                    class="{{ $item == 'jumlah_barang_dikembalikan' ? '' : 'hidden' }} text-3xl sm:text-4xl font-semibold">
                    {{ $total_dikembalikan }}
                </h1>
            </div>
        @endforeach
    </div>
    <div class="flex flex-col xl:flex-row gap-5">
        @foreach (['ajukan_peminjaman', 'ajukan_peminjaman_scan_kode'] as $i => $item)
            <div onclick="{{ $item . '_modal' }}.showModal();{{ $item == 'ajukan_peminjaman_scan_kode' ? 'initScanner()' : '' }}"
                class="flex items-center justify-between p-5 sm:p-7 hover:shadow-md active:scale-[.97] border border-blue-200 bg-white cursor-pointer border-back rounded-xl w-full">
                <div>
                    <h1 class="flex items-start gap-3 font-semibold font-[onest] sm:text-lg capitalize">
                        {{ str_replace('_', ' ', $item) }}
                    </h1>
                    <p class="text-sm opacity-60 capitalize">
                        @if ($item === 'ajukan_peminjaman')
                            Pengajuan Peminjaman Barang Inventaris
                        @elseif('ajukan_peminjaman_scan_kode')
                            Pengajuan peminjaman dengan scan kamera
                        @else
                            Tombol Tak ada
                        @endif
                    </p>
                </div>
                <x-lucide-circle-arrow-up class="size-5 sm:size-7 opacity-100" />
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
                    <input type="text" id="searchInput" placeholder="Cari data disini...." name="nama_barang"
    class="input input-sm shadow-md w-full bg-zinc-100">
                </div>
                <div class="flex flex-col bg-zinc-50 rounded-b-xl gap-3 divide-y pt-0 p-5 sm:p-7">
                    <div class="overflow-x-auto">
                        <table class="table table-zebra" id="dataTable">
                            <thead>
                                <tr>
                                    @foreach (['no', 'Nama Peminjam', 'Perihal', 'Nama Barang', 'jumlah', 'Pengembalian', 'validasi', 'status', 'last update', 'register', ''] as $item)
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
                                            {{ $item->barang->nama }}
                                        </td>
                                        <td class="font-semibold">{{ $item->jumlah }}</td>
                                        <td class="font-semibold uppercase">
                                            {{ \Carbon\Carbon::parse($item->pengembalian)->locale('id')->translatedFormat('d F Y') }}
                                        </td>
                                        <td class="font-semibold uppercase">{{ $item->validasi }}</td>
                                        <td class="font-semibold uppercase">{{ $item->status }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item->updated_at)->locale('id')->translatedFormat('d F Y H:i') }}
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($item->created_at)->locale('id')->translatedFormat('d F Y H:i') }}
                                        </td>
                                        @if ($role === 'admin')
                                            @if ($item->validasi === 'menunggu persetujuan')
                                                <td>
                                                    <button
                                                        onclick="document.getElementById('terima_peminjaman_modal_{{ $item->id_peminjaman }}').showModal();initUpdate('peminjaman', {{ $item->id_peminjaman }});"
                                                        class="btn btn-emerald m-2">Terima</button> |
                                                    <button
                                                        onclick="document.getElementById('tolak_peminjaman_modal_{{ $item->id_peminjaman }}').showModal();"
                                                        class="btn btn-outline btn-error m-2">Tolak</button>
                                                </td>
                                            @elseif ($item->validasi === 'dikonfirmasi' && $item->status === 'dipinjam')
                                                <td>
                                                    <button
                                                        onclick="document.getElementById('kembalikan_peminjaman_modal_{{ $item->id_peminjaman }}').showModal();initUpdate('peminjaman', {{ $item->id_peminjaman }});"
                                                        class="btn btn-emerald m-2">Kembalikan</button>
                                                </td>
                                            @elseif ($item->validasi === 'ditolak')
                                                <td>
                                                    <x-lucide-x class="stroke-emerald-500"
                                                        style="width: 20px; height: 20px;" />
                                                </td>
                                            @elseif ($item->validasi === 'dikonfirmasi' && $item->status === 'dikembalikan')
                                                <td>
                                                    <x-lucide-check class="stroke-emerald-500"
                                                        style="width: 20px; height: 20px;" />
                                                </td>
                                            @else
                                                <td class="uppercase">undefined</td>
                                            @endif
                                        @elseif ($role === 'user')
                                            @if ($item->validasi === 'dikonfirmasi' && $item->status === 'dipinjam')
                                                <td>
                                                    <button
                                                        onclick="document.getElementById('kembalikan_peminjaman_modal_{{ $item->id_peminjaman }}').showModal();initUpdate('peminjaman', {{ $item->id_peminjaman }});"
                                                        class="btn btn-emerald m-2">Kembalikan</button>
                                                </td>
                                            @elseif ($item->validasi === 'dikonfirmasi' && $item->status === 'dikembalikan')
                                                <td>
                                                    <x-lucide-x class="stroke-emerald-500"
                                                        style="width: 20px; height: 20px;" />
                                                </td>
                                            @else
                                                <td class="uppercase">Menunggu persetujuan</td>
                                            @endif
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
    @foreach (['terima', 'tolak', 'kembalikan'] as $action)
        <dialog id="{{ $action }}_peminjaman_modal_{{ $pe->id_peminjaman }}"
            class="modal modal-bottom sm:modal-middle">
            <form action="{{ route($action . '_' . 'peminjaman', ['id_peminjaman' => $pe->id_peminjaman]) }}"
                method="POST" class="modal-box">
                @csrf
                @method('PUT')
                <h3 class="modal-title capitalize">
                    {{ ucfirst($action) }} Peminjaman
                </h3>
                <div class="modal-body">
                    <div class="input-label">
                        <h1 class="label">Anda sedang {{ $action }} peminjaman untuk barang
                            {{ $pe->barang->kode }} - {{ $pe->barang->nama }} yang dipinjam oleh
                            {{ $pe->user->name }}. Apakah Anda yakin ingin melanjutkan?
                        </h1>
                    </div>
                </div>
                <div class="modal-action">
                    <button
                        onclick="document.getElementById('{{ $action }}_peminjaman_modal_{{ $pe->id_peminjaman }}').close();"
                        class="btn" type="button">Tutup</button>
                    <button type="submit" class="btn btn-secondary capitalize">
                        {{ ucfirst($action) }}
                    </button>
                </div>
            </form>
        </dialog>
    @endforeach
@endforeach

<dialog id="ajukan_peminjaman_modal" class="modal modal-bottom sm:modal-middle">
    <form action="{{ route('ajukan_peminjaman') }}" method="POST" class="modal-box">
        @csrf
        <h3 class="modal-title capitalize">
            Ajukan peminjaman
        </h3>
        <div class="modal-body">
            <div class="input-label">
                <h1 class="label">Nama Peminjam</h1>
                <input required name="nama_pengguna" type="text" value="{{ $user->name }}" readonly>
            </div>
            <div class="input-label">
                <h1 class="label">Perihal</h1>
                <textarea required class="block p-2.5 w-full text-sm rounded-lg border border-gray-300" name="perihal" rows="4"></textarea>
            </div>
            <div class="input-label">
                <h1 class="label">Barang yang akan dipinjam</h1>
                <select required class="uppercase select select-sm" name="id_barang">
                    @foreach ($barang as $b)
                        <option value="{{ $b->id_barang }}">{{ $b->kode . '-' . $b->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="input-label">
                <h1 class="label">Jumlah Barang yang dipinjam</h1>
                <input required name="jumlah" type="number">
                @error('jumlah')
                    <span class="validated">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-label">
                <h1 class="label">Tanggal Barang akan dikembalikan</h1>
                <input required name="pengembalian" type="date">
                @error('pengembalian')
                    <span class="validated">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="modal-action">
            <button type="button" class="btn" onclick="ajukan_peminjaman_modal.close()">Tutup</button>
            <button type="submit" class="btn btn-secondary capitalize">Ajukan</button>
        </div>
    </form>
</dialog>

<dialog id="detail_barang_modal" class="modal modal-bottom sm:modal-middle">
    <div class="modal-box p-6 rounded-lg shadow-lg bg-base-200">
        <h3 class="modal-title text-lg font-semibold capitalize mb-4" id="dtb_nama_header"></h3>
        <div class="modal-body">
            @foreach (['dtb_kode_barang', 'dtb_nama_barang', 'dtb_satuan_barang', 'dtb_barang_didaftar', 'dtb_barang_diupdate'] as $item)
                <div class="mb-4">
                    <h1 class="font-bold text-sm capitalize text-gray-600">
                        {{ explode('dtb', str_replace('_', ' ', $item))[1] }}
                    </h1>
                    <h1 id="{{ $item }}" class="text-lg font-medium text-gray-800"></h1>
                </div>
            @endforeach
        </div>
        <form id="pinjam_form" action="{{ route('ajukan_peminjaman_qr', ':id_barang') }}" method="POST"
            class="mt-4">
            @csrf
            <div class="input-label">
                <h1 class="label">Perihal</h1>
                <input type="text" name="perihal"
                    class="block p-2.5 w-full text-sm rounded-lg border border-gray-300" required>
            </div>
            <div class="input-label">
                <h1 class="label">Jumlah</h1>
                <input type="number" name="jumlah" min="1" required class="mt-2 w-full"
                    placeholder="Jumlah">
            </div>
            <div class="input-label">
                <h1 class="label">Tanggal Pengembalian</h1>
                <input type="date" name="pengembalian" required class="mt-2 w-full"
                    placeholder="Tanggal Pengembalian">
            </div>
            <input type="hidden" name="id_barang" id="id_barang_input">
            <button type="submit" id="pinjamButton"
                class="btn btn-primary w-full mt-4 bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-lg shadow-lg transition-transform transform hover:scale-105 active:scale-95 hover:shadow-xl">
                Pinjam
            </button>

        </form>

        <form method="dialog" class="mt-4">
            <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
        </form>
    </div>
</dialog>

<script>
    let dataz = {!! json_encode($barang) !!};
    let s = 0;
    let e = 0;

    setInterval(() => {
        s = 1;
        e = 1;
    }, 1000);

    var scanner = new QrScanner(el('bc_scanner'), scan => {
        let data = dataz.find(y => y.kode == scan.data);

        el('bc_scanner_output').innerText = scan.data;
        el('bc_scanner_output').classList.remove('text-red-500');

        if (data) {
            if (s) {
                s = 0;
                createjs.Sound.play('ding');
            }
            stopScanner();

            // Set the modal content
            el('dtb_nama_header').innerText = data.nama;
            el('dtb_kode_barang').innerText = data.kode;
            el('dtb_nama_barang').innerText = data.nama;
            el('dtb_satuan_barang').innerText = data.satuan;
            el('dtb_barang_didaftar').innerText = dayjs(data.created_at).format('HH:mm:ss DD/MM/YYYY');
            el('dtb_barang_diupdate').innerText = dayjs(data.updated_at).format('HH:mm:ss DD/MM/YYYY');

            // Set the hidden input for the form
            el('id_barang_input').value = data.id_barang;

            el('detail_barang_modal').showModal();
            el('scan_kode_barang_modal').close();
        } else {
            el('bc_scanner_output').innerText = 'Tidak dapat menemukan barang.';
            el('bc_scanner_output').classList.add('text-red-500');
            if (e) {
                e = 0;
                createjs.Sound.play('error');
            }
        }
    }, {
        highlightScanRegion: true,
        highlightCodeOutline: true,
    });

    stopScanner();

    function initScanner() {
        scanner.start();
    }

    function stopScanner() {
        s = 0;
        e = 0;
        scanner.stop();
        el('bc_scanner_output').innerText = '';
    }

    document.getElementById('pinjam_form').addEventListener('submit', function(event) {
        event.preventDefault();

        const id_barang = document.getElementById('id_barang_input').value;
        this.action = this.action.replace(':id_barang', id_barang);

        const formData = new FormData(this);

        const modal = document.getElementById('detail_barang_modal');
        modal.close();

        fetch(this.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
            })
            .then(response => {
                if (response.ok) {
                    return response.json();
                } else if (response.status === 422) {
                    return response.json().then(data => {
                        const errors = data.errors;
                        let errorMessage = '';
                        for (const key in errors) {
                            if (errors.hasOwnProperty(key)) {
                                errorMessage += `${errors[key].join(', ')}\n`;
                            }
                        }
                        throw new Error(errorMessage);
                    });
                }
                throw new Error('Network response was not ok.');
            })
            .then(data => {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: data.message,
                    confirmButtonText: 'OK',
                }).then(() => {
                    this.reset();
                    window.location.href =
                        '{{ route('kelola_peminjaman') }}';
                });
            })
            .catch(error => {
                console.error('There was a problem with the fetch operation:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: error.message || 'Terjadi kesalahan. Silakan coba lagi.',
                    confirmButtonText: 'OK',
                });
            });
    });
</script>
