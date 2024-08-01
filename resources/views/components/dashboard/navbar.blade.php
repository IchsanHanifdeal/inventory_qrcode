<div class="w-full navbar sticky top-0 bg-white border-b z-10">
    <div class="flex-none md:hidden">
        <label for="aside-dashboard" aria-label="open sidebar" class="btn btn-square btn-ghost">
            <x-lucide-align-left class="size-6" />
        </label>
    </div>
    <div class="flex-1 px-2 mx-2"></div>
    <div class="flex-none hidden lg:block">
        <ul class="menu menu-horizontal">
            <img class="w-8 rounded-full border border-gray-400"
                src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}"
                alt="">
        </ul>
    </div>
</div>
