<!DOCTYPE html>
<html lang="en">
<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.3.1/css/all.min.css"
        integrity="sha512-QeR2VH+lsBE5LSAe1Q5EnTBbe7XTBubt8dG93Y7gidSgdMCr8nVqKcfKAMyN96SV8KDbZVTDXChatu5G2KQGzg=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer"
    />
    <title>Indeed Clone</title>
</head>
<body>
    <x-header/>


    @if(session('success')) <x-alert type="success" :message="session('success')" /> @endif
    @if(session('error')) <x-alert type="error" :message="session('error')" /> @endif


    <div class="w-full px-5 sm:px-10 lg:px-20">
        {{$slot}}
    </div>

    <x-footer />
</body>
</html>
