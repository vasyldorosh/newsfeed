<!doctype html>
<html lang="en">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="description" content="">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="/css/style.css">
        <link rel="stylesheet" href="/css/article-side.css">
        <link rel="stylesheet" href="/css/ad-side.css">
        <!-- <link rel="stylesheet" href="/stylesheets/level2.css"> -->
        <title>Лента</title>
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col">
                <nav class="site-nav">
                    <a href="/" class="site-logo"></a>
                </nav>
            </div>
        </div>
    </div>
    <div class="root-container">
        <div class="container mt-3">
            <div class="row">
                <div class="col card-container">
                    
                    @yield('content')
                    
                </div>    
            </div>
        </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="/js/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="/js/ejs.min.js"></script>
    <script src="/js/vibrant.min.js"></script>
    <script src="/js/rgbaster.min.js"></script>
    <script src="/js/clamp.min.js"></script>
    <script src="/js/s.js?<?= time()?>"></script>
</body>

</html>