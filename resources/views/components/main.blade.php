<!DOCTYPE html>
<html lang="en" data-theme="emerald">

@include('components.head')

<body class="flex flex-col mx-auto min-h-dvh max-w-screen-2xl">
    @include('components.navbar')
    <main class="{{ $class }} p-4">
        {{ $slot }}
    </main>
</body>

</html>
