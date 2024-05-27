<!DOCTYPE html>
<html lang="en">

@include('layouts.head')

<body class="flex flex-col mx-auto min-h-dvh max-w-screen-2xl">
    @include('layouts.navbar')
    <main class="p-4">
        {{ $slot }}
    </main>
</body>

</html>
