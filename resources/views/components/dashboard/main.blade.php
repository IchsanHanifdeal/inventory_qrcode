<x-main title="{{ $title }}" class="!p-0" full>
    <div class="drawer md:drawer-open">
        <input id="aside-dashboard" type="checkbox" class="drawer-toggle" />
        <div class="drawer-content flex flex-col">
            @include('components.dashboard.navbar')
            <div class="p-5 bg-stone-100 w-full overflow-y-scroll">
                <div class="flex flex-col gap-6 w-full min-h-screen">
                    {{ $slot }}
                </div>
            </div>
            @include('components.footer')
        </div>
        @include('components.dashboard.aside')
    </div>
</x-main>
