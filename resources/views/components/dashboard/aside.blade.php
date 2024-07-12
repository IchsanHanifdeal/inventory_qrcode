<div class="drawer-side border-r z-20">
    <label for="aside-dashboard" aria-label="close sidebar" class="drawer-overlay"></label>
    <ul
        class="menu p-4 w-64 lg:w-72 min-h-full bg-white [&>li>a]:gap-4 [&>li]:my-1.5 [&>li]:text-[14.3px] [&>li]:font-medium [&>li]:text-opacity-80 [&>li]:text-base [&>_*_svg]:stroke-[1.5] [&>_*_svg]:size-[23px] [&>.label]:mt-6">
        <div class="pb-4 border-b border-gray-300">
            @include('components.brands', ['class' => '!text-2xl'])
        </div>
        <span class="label text-xs font-extrabold opacity-50">GENERAL</span>
        <li>
            <a href="{{ route('dashboard') }}" class="{!! Request::path() == 'dashboard' ? 'active' : '' !!} flex items-center px-2.5">
                <x-lucide-bar-chart-2 />
                Dashboard
            </a>
        </li>
        @if ($role === 'admin')
            <li>
                <a href="{{ route('user') }}" class="{!! preg_match('#^dashboard/user.*#', Request::path()) ? 'active' : '' !!} flex items-center px-2.5">
                    <x-lucide-users-2 />
                    Kelola User
                </a>
            </li>
            <li>
                <a href="{{ route('merk') }}" class="{!! preg_match('#^dashboard/merk.*#', Request::path()) ? 'active' : '' !!} flex items-center px-2.5">
                    <x-lucide-tag />
                    Kelola Merk
                </a>
            </li>
            <li>
                <a href="{{ route('jenis') }}" class="{!! preg_match('#^dashboard/jenis.*#', Request::path()) ? 'active' : '' !!} flex items-center px-2.5">
                    <x-lucide-hash />
                    Kelola Jenis
                </a>
            </li>
        @endif
        <li>
            <a href="{{ route('barang') }}" class="{!! preg_match('#^dashboard/barang(?!_).*#', Request::path()) ? 'active' : '' !!} flex items-center px-2.5">
                <x-lucide-combine />
                Kelola Barang
            </a>
        </li>
        @if ($role === 'admin')
            <li>
                <a href="{{ route('barang_masuk') }}" class="{!! preg_match('#^dashboard/barang_masuk.*#', Request::path()) ? 'active' : '' !!} flex items-center px-2.5">
                    <x-lucide-package />
                    Barang Masuk
                </a>
            </li>
            <li>
                <a href="{{ route('barang_keluar') }}" class="{!! preg_match('#^dashboard/barang_keluar.*#', Request::path()) ? 'active' : '' !!} flex items-center px-2.5">
                    <x-lucide-blocks />
                    Barang Keluar
                </a>
            </li>
        @endif
        <li>
            <a href="{{ route('kelola_peminjaman') }}" class="{!! preg_match('#^dashboard/kelola_peminjaman.*#', Request::path()) ? 'active' : '' !!} flex items-center px-2.5">
                <x-lucide-circle-arrow-up />
                Kelola Peminjaman
            </a>
        </li>
        <span class="label text-xs font-extrabold opacity-50">ADVANCE</span>
        <li>
            <a href="{{ route('profile') }}" class="{!! Request::path() == 'dashboard/profile' ? 'active' : '' !!} flex items-center px-2.5">
                <x-lucide-user-2 />
                Profile
            </a>
        </li>
        <li>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="px-0">
                @csrf
                <a class="flex items-center px-2.5 gap-4" href="#"
                    onclick="event.preventDefault(); confirmLogout();">
                    <x-lucide-log-out />
                    Logout
                </a>
            </form>
        </li>
    </ul>
</div>