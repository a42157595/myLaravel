<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="css/welcome.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="nav">
        <div class="input-group mb-3" id="search">
            <form class="searchForm" method="get" role="search">
                <div class="chearchClearBtn">
                    <input class="searchInput" aria-label="搜尋" autocomplete="off" placeholder="搜尋" role="combobox" value="" name="q" type="text" aria-hidden="false">
                </div>
                <button class="chearchBtn" aria-label="搜尋" role="button" aria-hidden="false">
                    <svg focusable="false" height="24px" viewBox="0 0 24 24" width="24px" xmlns="http://www.w3.org/2000/svg">
                        <path d="M20.49,19l-5.73-5.73C15.53,12.2,16,10.91,16,9.5C16,5.91,13.09,3,9.5,3S3,5.91,3,9.5C3,13.09,5.91,16,9.5,16 c1.41,0,2.7-0.47,3.77-1.24L19,20.49L20.49,19z M5,9.5C5,7.01,7.01,5,9.5,5S14,7.01,14,9.5S11.99,14,9.5,14S5,11.99,5,9.5z"></path>
                        <path d="M0,0h24v24H0V0z" fill="none"></path>
                    </svg>
                </button>
            </form>
        </div>


        <div class="antialiased">
            <div>
                @if (Route::has('login'))
                <div>
                    @auth
                    <a href="{{ url('/dashboard') }}">儀表板</a>
                    @else
                    <a href="{{ route('login') }}">登入</a>

                    @if (Route::has('register'))
                    <a href="{{ route('register') }}">註冊</a>
                    @endif
                    @endauth
                </div>
                @endif
            </div>
        </div>
    </div>
    </div>
    <div class="main">
        <div id="addNote">新增事記...</div>
    </div>
    
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/29.0.0/inline/ckeditor.js"></script>
<script src="js/welcome.js"></script>

</html>