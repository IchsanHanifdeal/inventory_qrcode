<div class="drawer-side border-r">
    <label for="aside-dashboard" aria-label="close sidebar" class="drawer-overlay"></label>
    <ul
        class="menu [&>li>a]:gap-4 [&>li]:my-1.5 [&>li]:text-[15px] [&>li]:font-medium [&>li]:text-opacity-80 [&>li]:text-base [&>_*_svg]:stroke-[1.5] [&>_*_svg]:size-6 [&>.label]:mt-6 p-4 w-64 min-h-full bg-white">
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
        <li>
            <a href="{{ route('barang') }}" class="{!! preg_match('#^dashboard/barang(?!_).*#', Request::path()) ? 'active' : '' !!} flex items-center px-2.5">
                <x-lucide-combine />
                Kelola Barang
            </a>
        </li>
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
        <span class="label text-xs font-extrabold opacity-50">ADVANCE</span>
        <li>
            <a class="flex items-center px-2.5">
                <x-lucide-log-out />
                Logout
            </a>
        </li>
    </ul>
</div>
