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
                <div class="flex flex-col bg-zinc-50 rounded-b-xl gap-3 divide-y pt-0 p-5 sm:p-7">
                    <div class="overflow-x-auto">
                        <table class="table table-zebra">
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
                                        <td>{{ $item->created_at }}</td>
                                        <td class="flex items-center gap-4">
                                            <x-lucide-square-pen
                                                onclick="update_user_modal.showModal();initUpdate('user', {{ $item }})"
                                                class="size-5 hover:stroke-blue-500 cursor-pointer" />
                                            <x-lucide-trash-2
                                                onclick="delete_modal.showModal();initDelete('user', {{ $item }})"
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

<dialog id="update_user_modal" class="modal modal-bottom sm:modal-middle">
    <form method="POST" class="modal-box">
        @csrf
        <h3 class="modal-title capitalize">
            Update User
        </h3>
        <div class="modal-body">
            <div class="input-label">
                <h1 class="label">Masukan Nama:</h1>
                <input required id="up_nama" name="up_nama" type="text" placeholder="....">
                @error('nama')
                    <span class="validated">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-label">
                <h1 class="label">Masukan Username:</h1>
                <input required id="up_username" name="up_username" type="text" placeholder="....">
                @error('username')
                    <span class="validated">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-label">
                <h1 class="label">Masukan Email:</h1>
                <input disabled id="up_email" type="text" placeholder="....">
            </div>
            <div class="input-label">
                <h1 class="label">Masukan Role:</h1>
                <select required id="up_role" name="up_role" class="uppercase select select-sm">
                    <option value="user">USER</option>
                    <option value="admin">ADMIN</option>
                </select>
                @error('role')
                    <span class="validated">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="modal-action">
            <button onclick="update_user_modal.close()" class="btn" type="button">Tutup</button>
            <button type="submit" class="btn btn-secondary capitalize">Update User</button>
        </div>
    </form>
</dialog>
