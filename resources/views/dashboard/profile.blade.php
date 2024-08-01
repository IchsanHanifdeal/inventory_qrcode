<x-dashboard.main title="Profile">
    <div class="grid sm:grid-cols-2 xl:grid-cols-4 gap-5 md:gap-6">
        @foreach (['waktu', 'role', 'terakhir_login', 'register'] as $type)
            <div class="flex items-center px-4 py-3 bg-white border-back rounded-xl">
                <span
                    class="
                  {{ $type == 'waktu' ? 'bg-blue-300' : '' }}
                  {{ $type == 'role' ? 'bg-green-300' : '' }}
                  {{ $type == 'terakhir_login' ? 'bg-rose-300' : '' }}
                  {{ $type == 'register' ? 'bg-amber-300' : '' }}
                  p-3 mr-4 text-gray-700 rounded-full"></span>
                <div>
                    <p class="text-sm font-medium capitalize text-gray-600 line-clamp-1">
                        {{ str_replace('_', ' ', $type) }}
                    </p>
                    <p id="{{ $type }}" class="text-lg uppercase font-semibold text-gray-700 line-clamp-1">
                        {{ $type == 'waktu' ? '0' : '' }}
                        {{ $type == 'role' ? $role : '' }}
                        {{ $type == 'terakhir_login' ? $login : '' }}
                        {{ $type == 'register' ? $register : '' }}
                    </p>
                </div>
            </div>
        @endforeach
    </div>
    <div class="flex flex-col lg:flex-row gap-5">
        <div class="flex flex-col gap-5 p-5 sm:p-7 bg-white border-back rounded-xl w-full">
            <div class="flex gap-5 border-b pb-7">
                <div class="flex flex-col items-center gap-3 h-fit">
                    <div class="w-24 h-24 rounded-xl overflow-hidden border-2 border-gray-300">
                        <img class="w-full h-full object-cover rounded-xl" src="https://ui-avatars.com/api/?name={{ $name }}" />
                    </div>                    
                    <h1 class="badge badge-sm badge-neutral font-medium uppercase">
                        {{ $role }}
                    </h1>
                </div>
                <div>
                    <h1 class="flex items-start gap-3 lowercase line-clamp-1 font-semibold font-[onest] sm:text-lg">
                        {{-- username --}}
                        {{ '@' . ucfirst($username) }}
                    </h1>
                     <p class="text-sm opacity-60 line-clamp-1">
                        {{ $email }}
                    </p>
                    <div class="mt-3">
                        <div>
                            <h1 class="text-sm font-semibold">Nama Panggilan:</h1>
                            <p class="text-sm opacity-60 line-clamp-1">
                                {{ $username }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <form class="flex flex-col gap-3" method="POST" action="{{ route('update.profile', ['id_user' => $id_user]) }}">
                @csrf
                @method('PUT')
                <div class="input-label">
                    <h1 class="label">Nama:</h1>
                    <input required name="nama" value="{{ $name }}" type="text" placeholder="...">
                    @error('nama')
                        <span class="validated">{{ $message }}</span>
                    @enderror
                </div>
                <div class="input-label">
                    <h1 class="label">Username:</h1>
                    <input required name="username" value="{{ $username }}" type="text" placeholder="...">
                    @error('username')
                        <span class="validated">{{ $message }}</span>
                    @enderror
                </div>
                <div class="input-label">
                    <h1 class="label">Email:</h1>
                    <input disabled name="email" value="{{ $email }}" type="email" placeholder="...">
                </div>
                <button type="submit" class="btn btn-secondary mt-5 ml-auto capitalize w-fit">Update Profile</button>
            </form>
        </div>
        <div class="flex flex-col gap-5 p-5 sm:p-7 bg-white border-back rounded-xl w-full h-fit">
            <form class="flex flex-col gap-3" method="POST" action="{{ route('update.password', ['id_user' => $id_user])}}">
                @csrf
                @method('PUT')
                <div class="input-label">
                    <h1 class="label">Password Lama:</h1>
                    <input required name="password_lama" type="password" placeholder="...">
                    @error('password_lama')
                        <span class="validated">{{ $message }}</span>
                    @enderror
                </div>
                <div class="input-label">
                    <h1 class="label">Password Baru:</h1>
                    <input required name="password_baru" type="password" placeholder="...">
                    @error('password_baru')
                        <span class="validated">{{ $message }}</span>
                    @enderror
                </div>
                <div class="input-label">
                    <h1 class="label">Konfirmasi Password Baru:</h1>
                    <input required name="konfirmasi_password_baru" type="password" placeholder="...">
                    @error('konfirmasi_password_baru')
                        <span class="validated">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-secondary mt-5 ml-auto capitalize w-fit">Update Password</button>
            </form>
        </div>
    </div>
</x-dashboard.main>

<script>
    setInterval(() => {
        document.getElementById('waktu')
            .innerText = dayjs().format('HH:mm:ss DD/MM/YY')
    }, 1000);
</script>
