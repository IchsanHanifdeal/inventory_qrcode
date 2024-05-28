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
                        {{ $type == 'total_admin' ? 839483 : 10 }}
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
                                @foreach ([1, 1, 1, 1, 1] as $i => $item)
                                    <tr>
                                        <th>{{ $i + 1 }}</th>
                                        <td>Kejaa</td>
                                        <td class="text-blue-500 font-semibold hover:underline cursor-pointer">zaadevofc
                                        </td>
                                        <td>zaadevofc@gmail.com</td>
                                        <td class="font-semibold uppercase">admin</td>
                                        <td>12:22 20/09/2024</td>
                                        <td class="flex items-center gap-4">
                                            <x-lucide-square-pen class="size-5 hover:stroke-blue-500 cursor-pointer" />
                                            <x-lucide-trash-2 class="size-5 hover:stroke-rose-500 cursor-pointer" />
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
