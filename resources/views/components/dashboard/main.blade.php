<x-main title="{{ $title }}" class="!p-0" full>
    <div class="drawer md:drawer-open">
        <input id="aside-dashboard" type="checkbox" class="drawer-toggle" />
        <div class="drawer-content flex flex-col">
            <div class="w-full navbar sticky top-0 bg-white shadow-md shadow-gray-200 border-b">
                <div class="flex-none md:hidden">
                    <label for="aside-dashboard" aria-label="open sidebar" class="btn btn-square btn-ghost">
                        <x-lucide-align-left class="size-6" />
                    </label>
                </div>
                <div class="flex-1 px-2 mx-2"></div>
                <div class="flex-none hidden lg:block">
                    <ul class="menu menu-horizontal">
                        <img class="w-8 rounded-full border border-gray-400"
                            src="https://raw.githubusercontent.com/zaadevofc/zaadevofc/main/empty-profile-picture.webp"
                            alt="">
                    </ul>
                </div>
            </div>
            <div class="p-5 bg-stone-100 w-full overflow-y-scroll">
                <div class="w-full min-h-screen">
                    {{ $slot }}
                </div>
            </div>
        </div>
        <div class="drawer-side border-r shadow-md shadow-gray-200">
            <label for="aside-dashboard" aria-label="close sidebar" class="drawer-overlay"></label>
            <ul
                class="menu [&>li>a]:gap-4 [&>li]:my-1.5 [&>li]:text-[15px] [&>li]:font-medium [&>li]:text-opacity-80 [&>li]:text-base [&>_*_svg]:stroke-[1.5] [&>_*_svg]:size-6 [&>.label]:mt-6 p-4 w-64 min-h-full bg-white">
                <div class="pb-4 border-b border-gray-300">
                    @include('components.brands', ['class' => '!text-2xl'])
                </div>
                <span class="label text-xs font-extrabold opacity-50">GENERAL</span>
                <li>
                    <a href="{{ route('dashboard') }}" class="{!! preg_match('#^dashboard.*#', Request::path()) ? 'active' : '' !!} flex items-center px-2.5">
                        <x-lucide-bar-chart-2 />
                        Dashboard
                    </a>
                </li>
                <li>
                    <a href="{{ route('users') }}" class="{!! preg_match('#^dashboard/merk.*#', Request::path()) ? 'active' : '' !!} flex items-center px-2.5">
                        <x-lucide-users-2 />
                        Kelola User
                    </a>
                </li>
                <li>
                    <a href="{{ route('dashboard') }}" class="{!! preg_match('#^dashboard/merk.*#', Request::path()) ? 'active' : '' !!} flex items-center px-2.5">
                        <x-lucide-tag />
                        Kelola Merk
                    </a>
                </li>
                <li>
                    <a href="{{ route('dashboard') }}" class="{!! preg_match('#^dashboard/merk.*#', Request::path()) ? 'active' : '' !!} flex items-center px-2.5">
                        <x-lucide-hash />
                        Kelola Jenis
                    </a>
                </li>
                <li>
                    <a href="{{ route('dashboard') }}" class="{!! preg_match('#^dashboard/barang.*#', Request::path()) ? 'active' : '' !!} flex items-center px-2.5">
                        <x-lucide-combine />
                        Kelola Barang
                    </a>
                </li>
                <li>
                    <a href="{{ route('dashboard') }}" class="{!! preg_match('#^dashboard/barang_masuk.*#', Request::path()) ? 'active' : '' !!} flex items-center px-2.5">
                        <x-lucide-package />
                        Barang Masuk
                    </a>
                </li>
                <li>
                    <a href="{{ route('dashboard') }}" class="{!! preg_match('#^dashboard/barang_keluar.*#', Request::path()) ? 'active' : '' !!} flex items-center px-2.5">
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
    </div>
</x-main>
