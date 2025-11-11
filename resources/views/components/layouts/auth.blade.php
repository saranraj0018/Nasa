<!DOCTYPE html>
<html lang="en">

<head>
    <x-partials.header />
</head>

<body>

    <div>
        {{ $slot }}
    </div>

    <footer class="fixed bottom-0 w-full text-center text-gray-500 text-sm font-semibold p-2">
        &copy; {{ date('Y') }} NASA. All rights reserved.
    </footer>
    <x-partials.scripts />
</body>

</html>
