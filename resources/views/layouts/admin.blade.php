<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Thư Viện</title>

    <!--star:css-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">

    
</head>

<body>
    <!--star:header-->
    @include('layouts.partials.header')
    <!--end:header-->

    <!--star:main layout-->
    <div class="layout main-content">
        <!--star:sidebar-->
        @include('layouts.partials.sidebar')
        <!--end:sidebar-->

        <!--star:dashboard-->
        <div class="dashboard">
            @yield('content') {{-- Nội dung thay đổi theo view --}}
        </div>
        <!--end:dashboard-->
    </div>
    <!--end:main layout-->

    <!--star:bootstrap-js-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!--end:bootstrap-js-->
</body>

</html>
