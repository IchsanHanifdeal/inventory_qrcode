<x-dashboard.main title="Kelola User">
    <div class="grid sm:grid-cols-2 gap-5 md:gap-6">
        @foreach (['total_user', 'total_admin'] as $type)
            <div class="flex items-center px-4 py-3 bg-white border-back rounded-xl">
                <span
                    class="
                      {{ $type == 'total_user' ? 'bg-blue-300' : '' }}
                      {{ $type == 'total_admin' ? 'bg-green-300' : '' }}
                      p-3 mr-4 text-gray-700 rounded-full"></span>
                <div>
                    <p class="text-sm font-medium capitalize text-gray-600 line-clamp-1">
                        {{ str_replace('_', ' ', $type) }}
                    </p>
                    <p class="text-lg font-semibold text-gray-700 line-clamp-1">
                        {{ $type == 'total_user' ? $total_user : '' }}
                        {{ $type == 'total_admin' ? $total_admin : '' }}
                    </p>
                </div>
            </div>
        @endforeach
    </div>
    <div class="flex gap-5">
        @foreach (['manajemen_user'] as $item)
            <div class="flex flex-col border-back rounded-xl w-full">
                <div class="p-5 sm:p-7 bg-white rounded-t-xl">
                    <h1 class="flex items-start gap-3 font-semibold font-[onest] sm:text-lg capitalize">
                        {{ str_replace('_', ' ', $item) }}
                    </h1>
                    <p class="text-sm opacity-60">Selalu waspada dengan data yang beresiko.</p>
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
                                    @foreach (['no', 'nama', 'username', 'email', 'role', 'register', ''] as $item)
                                        <th class="uppercase font-bold">{{ $item }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($user as $i => $item)
                                    <tr>
                                        <th>{{ $i + 1 }}</th>
                                        <td>{{ $item->name ?? '-' }}</td>
                                        <td class="text-blue-500 font-semibold hover:underline cursor-pointer">
                                            {{ $item->username }}
                                        </td>
                                        <td>{{ $item->email }}</td>
                                        <td class="font-semibold uppercase">{{ $item->role }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item->created_at)->locale('id')->translatedFormat('d F Y H:i') }}</td>   
                                        <td class="flex items-center gap-4">
                                            <x-lucide-square-pen
                                                onclick="document.getElementById('update_user_modal_{{ $item->id_user }}').showModal();initUpdate('user', {{ $item->id_barang }})"
                                                class="size-5 hover:stroke-blue-500 cursor-pointer" />
                                            <x-lucide-trash class="size-5 hover:stroke-red-500 cursor-pointer"
                                                onclick="document.getElementById('hapus_modal_{{ $item->id_user }}').showModal();" />

                                            <dialog id="hapus_modal_{{ $item->id_user }}"
                                                class="modal modal-bottom sm:modal-middle">
                                                <div class="modal-box">
                                                    <h3 class="text-lg font-bold">Hapus
                                                        User
                                                    </h3>
                                                    <div class="mt-3">
                                                        <p class="text-red-700 font-semibold">Yakin ingin
                                                            menghapus User
                                                            <strong
                                                                class="text-red-800 font-bold">{{ $item->nama }}</strong>.
                                                            <span class="text-gray-600">Tindakan ini tidak dapat di
                                                                urungkan.
                                                                User akan hilang secara permanen
                                                            </span>
                                                        </p>
                                                    </div>
                                                    <div class="modal-action">
                                                        <form action="{{ route('destroy.user', $item->id_user) }}"
                                                            method="POST" class="inline-block">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-error">Yakin</button>
                                                        </form>
                                                        <button type="button"
                                                            onclick="document.getElementById('hapus_modal_{{ $item->id_user }}').close()"
                                                            class="btn">Batal</button>
                                                    </div>
                                                </div>
                                            </dialog>
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

@foreach ($user as $i => $item)
    <dialog id="update_user_modal_{{ $item->id_user }}" class="modal modal-bottom sm:modal-middle">
        <form method="POST" class="modal-box" action="{{ route('update.user', ['id_user' => $item->id_user]) }}">
            @csrf
            @method('PUT')
            <h3 class="modal-title capitalize">
                Update User
            </h3>
            <div class="modal-body">
                <div class="input-label">
                    <h1 class="label">Masukan Nama:</h1>
                    <input required id="up_nama" name="up_nama" type="text" placeholder="...."
                        value="{{ $item->name }}">
                    @error('nama')
                        <span class="validated">{{ $message }}</span>
                    @enderror
                </div>
                <div class="input-label">
                    <h1 class="label">Masukan Username:</h1>
                    <input required id="up_username" name="up_username" type="text" placeholder="...."
                        value="{{ $item->username }}">
                    @error('username')
                        <span class="validated">{{ $message }}</span>
                    @enderror
                </div>
                <div class="input-label">
                    <h1 class="label">Masukan Email:</h1>
                    <input disabled id="up_email" type="text" placeholder="...." value="{{ $item->email }}">
                </div>
                <div class="input-label">
                    <h1 class="label">Masukan Role:</h1>
                    <select required id="up_role" name="up_role" class="uppercase select select-sm">
                        <option value="user" {{ $item->role == 'user' ? 'selected' : '' }}>USER</option>
                        <option value="admin" {{ $item->role == 'admin' ? 'selected' : '' }}>ADMIN</option>
                    </select>
                    @error('role')
                        <span class="validated">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="modal-action">
                <button onclick="document.getElementById('update_user_modal_{{ $item->id_user }}').close()"
                    class="btn" type="button">
                    Tutup
                </button>
                <button type="submit" class="btn btn-secondary capitalize">Update User</button>
            </div>
        </form>
    </dialog>
@endforeach
