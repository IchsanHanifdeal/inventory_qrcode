<head lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <meta property="og:url" content="https://...">
    <meta property="og:type" content="website">
    <meta property="og:title" content="....">
    <meta property="og:description" content="....">
    <meta property="og:image" content="https://.../assets/zaadevofc-icon-black-white.png">
    <meta property="og:image:width" content="470">
    <meta property="og:image:height" content="470">

    <meta name="twitter:card" content="summary_large_image">
    <meta property="twitter:domain" content="...">
    <meta property="twitter:url" content="https://...">
    <meta name="twitter:title" content="....">
    <meta name="twitter:description" content="....">
    <meta name="twitter:image" content="https://.../assets/zaadevofc-icon-black-white.png">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Onest:wght@100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/dayjs@1/dayjs.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.6/dist/JsBarcode.all.min.js"></script>
    <script src="/qrcodejs/qrcode.min.js"></script>
    <script src="/qrscanner/qr-scanner.legacy.min.js"></script>
    <script src="https://code.createjs.com/1.0.0/soundjs.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.js"></script>
    
    <title>{{ $title ?? 'Beranda' }} | Invetory Barang with QR Code</title>
    <meta name="description" content="....">

    @vite('resources/css/app.css')
</head>
