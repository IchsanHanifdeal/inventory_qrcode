<x-main title="{{ $title }}" class="!p-0" full>
    <div class="drawer md:drawer-open">
        <input id="aside-dashboard" type="checkbox" class="drawer-toggle" />
        <div class="drawer-content flex flex-col">
            <div class="w-full navbar bg-slate-100 border-b">
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
            <div class="p-5">
                {{ $slot }}
            </div>
        </div>
        <div class="drawer-side border-r">
            <label for="aside-dashboard" aria-label="close sidebar" class="drawer-overlay"></label>
            <ul class="menu [&>li]:my-1 [&>li]:text-base [&>_*_svg]:size-4 [&>_*_svg]:fill-red-200 [&>.label]:mt-8 p-4 w-64 min-h-full bg-slate-100">
                <div class="pb-5 border-b border-gray-300">
                    @include('components.brands', ['class' => '!text-2xl'])
                </div>
                <span class="label text-xs font-bold opacity-50">GENERAL</span>
                <li>
                    <a class="flex items-center gap-3">
                        <x-lucide-user-2 />
                        Users Management
                    </a>
                </li>
                <li>
                    <a class="flex items-center gap-3">
                        <x-lucide-user-2 />
                        Users Management
                    </a>
                </li>
                <span class="label text-xs font-bold opacity-50">GENERAL</span>
                <li>
                    <a>Sidebar Item 1</a>
                </li>
            </ul>

        </div>
    </div>
</x-main>
