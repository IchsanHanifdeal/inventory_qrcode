<x-main title="Login" class="p-0">
    <div
        class="bg-no-repeat bg-cover bg-center bg-[url('https://images.unsplash.com/photo-1486520299386-6d106b22014b?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1050&q=80')]">
        <div class="flex justify-end">
            <div class="bg-white min-h-screen w-1/2 flex justify-center items-center">
                <div>
                    <form action="{{ route('authenticate') }}" method="POST">
                        @csrf
                        <div class="my-3">
                            <label class="block text-md mb-2" for="email">Email</label>
                            <input class="input input-bordered px-4 w-full border-2 py-2 rounded-md text-sm outline-none"
                                type="email" name="email" placeholder="Masukan email...">
                        </div>
                        <div class="my-3">
                            <label class="block text-md mb-2" for="email">Password</label>
                            <input class="input input-bordered px-4 w-full border-2 py-2 rounded-md text-sm outline-none"
                                type="password" name="password" placeholder="Masukan password...">
                        </div>
                        <div class="">
                            <button type="submit" class="mt-4 mb-3 w-full bg-blue-500 hover:bg-blue-400 text-white py-2 rounded-md">
                                Login
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
</x-main>
