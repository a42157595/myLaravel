<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.0.20/sweetalert2.min.css" rel="stylesheet">

    <link href="css/garbageCan.css" rel="stylesheet">
</head>

<body>
    <div class="nav">
        <div class="input-group mb-3" id="search">
            <form class="searchForm" method="get" role="search">
                <div class="cearchClearBtn">
                    <input class="searchInput" aria-label="搜尋" placeholder="搜尋" type="text">
                </div>
                <button class="cearchBtn" aria-label="搜尋" role="button" aria-hidden="false">
                    <svg focusable="false" height="24px" viewBox="0 0 24 24" width="24px" xmlns="http://www.w3.org/2000/svg">
                        <path d="M20.49,19l-5.73-5.73C15.53,12.2,16,10.91,16,9.5C16,5.91,13.09,3,9.5,3S3,5.91,3,9.5C3,13.09,5.91,16,9.5,16 c1.41,0,2.7-0.47,3.77-1.24L19,20.49L20.49,19z M5,9.5C5,7.01,7.01,5,9.5,5S14,7.01,14,9.5S11.99,14,9.5,14S5,11.99,5,9.5z"></path>
                        <path d="M0,0h24v24H0V0z" fill="none"></path>
                    </svg>
                </button>
            </form>
            <button class="cearchCloseBtn" aria-label="清除" role="button" aria-hidden="false">
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000">
                    <path d="M0 0h24v24H0V0z" fill="none" />
                    <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12 19 6.41z" />
                </svg>
            </button>
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

    <div class="main">
        <div class="optionalArea">
            <div class="option" data-url="">
                <div class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path d="M9 21c0 .55.45 1 1 1h4c.55 0 1-.45 1-1v-1H9v1zm3-19C8.14 2 5 5.14 5 9c0 2.38 1.19 4.47 3 5.74V17c0 .55.45 1 1 1h6c.55 0 1-.45 1-1v-2.26c1.81-1.27 3-3.36 3-5.74 0-3.86-3.14-7-7-7zm2.85 11.1l-.85.6V16h-4v-2.3l-.85-.6A4.997 4.997 0 0 1 7 9c0-2.76 2.24-5 5-5s5 2.24 5 5c0 1.63-.8 3.16-2.15 4.1z"></path>
                    </svg>
                    <span> 記事 </span>
                </div>
            </div>
            <div class="option" data-url="null">
                <div class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path d="M20.41 4.94l-1.35-1.35c-.78-.78-2.05-.78-2.83 0L13.4 6.41 3 16.82V21h4.18l10.46-10.46 2.77-2.77c.79-.78.79-2.05 0-2.83zm-14 14.12L5 19v-1.36l9.82-9.82 1.41 1.41-9.82 9.83z"></path>
                    </svg>
                    <span> 編輯標籤 </span>
                </div>
            </div>
            <div class="option optionSelected" data-url="garbageCan">
                <div class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path d="M15 4V3H9v1H4v2h1v13c0 1.1.9 2 2 2h10c1.1 0 2-.9 2-2V6h1V4h-5zm2 15H7V6h10v13z"></path>
                        <path d="M9 8h2v9H9zm4 0h2v9h-2z"></path>
                    </svg>
                    <span>垃圾桶</span>
                </div>
            </div>
        </div>

        <div class="note">
            <div id="noteArea">
                <note-template v-for="post in posts" v-bind:key="post.id" v-bind:post="post"></note-template>
            </div>
        </div>
    </div>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.hoverintent/1.10.1/jquery.hoverIntent.min.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/29.0.0/inline/ckeditor.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.0.20/sweetalert2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
<script src="js/garbageCan.js"></script>

</html>