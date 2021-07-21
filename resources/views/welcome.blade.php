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
    <link href="css/welcome.css" rel="stylesheet">
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
        <div class="optionalArea">
            <div class="option optionSelected">
                <div class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path d="M9 21c0 .55.45 1 1 1h4c.55 0 1-.45 1-1v-1H9v1zm3-19C8.14 2 5 5.14 5 9c0 2.38 1.19 4.47 3 5.74V17c0 .55.45 1 1 1h6c.55 0 1-.45 1-1v-2.26c1.81-1.27 3-3.36 3-5.74 0-3.86-3.14-7-7-7zm2.85 11.1l-.85.6V16h-4v-2.3l-.85-.6A4.997 4.997 0 0 1 7 9c0-2.76 2.24-5 5-5s5 2.24 5 5c0 1.63-.8 3.16-2.15 4.1z"></path>
                    </svg>
                    <span> 記事 </span>
                </div>
            </div>
            <div class="option">
                <div class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path d="M20.41 4.94l-1.35-1.35c-.78-.78-2.05-.78-2.83 0L13.4 6.41 3 16.82V21h4.18l10.46-10.46 2.77-2.77c.79-.78.79-2.05 0-2.83zm-14 14.12L5 19v-1.36l9.82-9.82 1.41 1.41-9.82 9.83z"></path>
                    </svg>
                    <span> 編輯標籤 </span>
                </div>
            </div>
            <div class="option">
                <div class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path d="M15 4V3H9v1H4v2h1v13c0 1.1.9 2 2 2h10c1.1 0 2-.9 2-2V6h1V4h-5zm2 15H7V6h10v13z"></path>
                        <path d="M9 8h2v9H9zm4 0h2v9h-2z"></path>
                    </svg>
                    <span>垃圾桶</span>
                </div>
            </div>
        </div>
        <div class="addNote">
            <div id="addNote">新增事記...</div>
            <button class="btn" id="addNoteBtn">新增</button>
        </div>

        <div class="note">
            <div class="card" id="d_1">
                <div class="pushpin myTooltip" data-toggle="tooltip" data-placement="bottom" title="固定記事">
                    <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path fill="none" d="M0 0h24v24H0z" />
                        <path fill="#000" d="M17 4v7l2 3v2h-6v5l-1 1-1-1v-5H5v-2l2-3V4c0-1.1.9-2 2-2h6c1.11 0 2 .89 2 2zM9 4v7.75L7.5 14h9L15 11.75V4H9z" />
                    </svg>
                </div>
                <div class="cardContent">
                    你好你好你好你好你好你好你好你好你好你好你好qwsdqwdqwddddddddddddddddddddddddddd<br>qwdqwd
                </div>
                <div class="dialog" id="a" style="display: none">
                    <div class="color myTooltip presetColor" style="background-color: #fff;" data-color="#fff" data-toggle="tooltip" data-placement="bottom" title="預設"></div>
                    <div class="color myTooltip" style="background-color: #f28b82;" data-color="#f28b82" data-toggle="tooltip" data-placement="bottom" title="紅色"></div>
                    <div class="color myTooltip" style="background-color: #fbbc04;" data-color="#fbbc04" data-toggle="tooltip" data-placement="bottom" title="橘色"></div>
                    <div class="color myTooltip" style="background-color: #fff475;" data-color="#fff475" data-toggle="tooltip" data-placement="bottom" title="黃色"></div>
                    <div class="color myTooltip" style="background-color: #ccff90;" data-color="#ccff90" data-toggle="tooltip" data-placement="bottom" title="綠色"></div>
                    <div class="color myTooltip" style="background-color: #a7ffeb;" data-color="#a7ffeb" data-toggle="tooltip" data-placement="bottom" title="藍綠色"></div>
                    <div class="color myTooltip" style="background-color: #cbf0f8;" data-color="#cbf0f8" data-toggle="tooltip" data-placement="bottom" title="藍色"></div>
                    <div class="color myTooltip" style="background-color: #aecbfa;" data-color="#aecbfa" data-toggle="tooltip" data-placement="bottom" title="深藍色"></div>
                    <div class="color myTooltip" style="background-color: #d7aefb;" data-color="#d7aefb" data-toggle="tooltip" data-placement="bottom" title="紫色"></div>
                    <div class="color myTooltip" style="background-color: #fdcfe8;" data-color="#fdcfe8" data-toggle="tooltip" data-placement="bottom" title="粉紅色"></div>
                    <div class="color myTooltip" style="background-color: #e6c9a8;" data-color="#e6c9a8" data-toggle="tooltip" data-placement="bottom" title="棕色"></div>
                    <div class="color myTooltip" style="background-color: #e8eaed;" data-color="#e8eaed" data-toggle="tooltip" data-placement="bottom" title="灰色"></div>
                </div>
                <div class="footer">
                    <div class="icon">
                        <div class="changeColor myTooltip" data-did='d_1' data-toggle="tooltip" data-placement="bottom" title="變更顏色">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="#000">
                                <path d="M12 22C6.49 22 2 17.51 2 12S6.49 2 12 2s10 4.04 10 9c0 3.31-2.69 6-6 6h-1.77c-.28 0-.5.22-.5.5 0 .12.05.23.13.33.41.47.64 1.06.64 1.67A2.5 2.5 0 0 1 12 22zm0-18c-4.41 0-8 3.59-8 8s3.59 8 8 8c.28 0 .5-.22.5-.5a.54.54 0 0 0-.14-.35c-.41-.46-.63-1.05-.63-1.65a2.5 2.5 0 0 1 2.5-2.5H16c2.21 0 4-1.79 4-4 0-3.86-3.59-7-8-7z" />
                                <circle cx="6.5" cy="11.5" r="1.5" />
                                <circle cx="9.5" cy="7.5" r="1.5" />
                                <circle cx="14.5" cy="7.5" r="1.5" />
                                <circle cx="17.5" cy="11.5" r="1.5" />
                            </svg>
                        </div>
                    </div>
                    
                    <div class="icon">
                        <div class="myTooltip" data-id='d_1' data-toggle="tooltip" data-placement="bottom" title="刪除記事">
                            <svg width="24" height="24" viewBox="-47 0 512 512" xmlns="http://www.w3.org/2000/svg">
                                <path d="m416.875 114.441406-11.304688-33.886718c-4.304687-12.90625-16.339843-21.578126-29.941406-21.578126h-95.011718v-30.933593c0-15.460938-12.570313-28.042969-28.027344-28.042969h-87.007813c-15.453125 0-28.027343 12.582031-28.027343 28.042969v30.933593h-95.007813c-13.605469 0-25.640625 8.671876-29.945313 21.578126l-11.304687 33.886718c-2.574219 7.714844-1.2695312 16.257813 3.484375 22.855469 4.753906 6.597656 12.445312 10.539063 20.578125 10.539063h11.816406l26.007813 321.605468c1.933594 23.863282 22.183594 42.558594 46.109375 42.558594h204.863281c23.921875 0 44.175781-18.695312 46.105469-42.5625l26.007812-321.601562h6.542969c8.132812 0 15.824219-3.941407 20.578125-10.535157 4.753906-6.597656 6.058594-15.144531 3.484375-22.859375zm-249.320312-84.441406h83.0625v28.976562h-83.0625zm162.804687 437.019531c-.679687 8.402344-7.796875 14.980469-16.203125 14.980469h-204.863281c-8.40625 0-15.523438-6.578125-16.203125-14.980469l-25.816406-319.183593h288.898437zm-298.566406-349.183593 9.269531-27.789063c.210938-.640625.808594-1.070313 1.484375-1.070313h333.082031c.675782 0 1.269532.429688 1.484375 1.070313l9.269531 27.789063zm0 0"/><path d="m282.515625 465.957031c.265625.015625.527344.019531.792969.019531 7.925781 0 14.550781-6.210937 14.964844-14.21875l14.085937-270.398437c.429687-8.273437-5.929687-15.332031-14.199219-15.761719-8.292968-.441406-15.328125 5.925782-15.761718 14.199219l-14.082032 270.398437c-.429687 8.273438 5.925782 15.332032 14.199219 15.761719zm0 0"/><path d="m120.566406 451.792969c.4375 7.996093 7.054688 14.183593 14.964844 14.183593.273438 0 .554688-.007812.832031-.023437 8.269531-.449219 14.609375-7.519531 14.160157-15.792969l-14.753907-270.398437c-.449219-8.273438-7.519531-14.613281-15.792969-14.160157-8.269531.449219-14.609374 7.519532-14.160156 15.792969zm0 0"/><path d="m209.253906 465.976562c8.285156 0 15-6.714843 15-15v-270.398437c0-8.285156-6.714844-15-15-15s-15 6.714844-15 15v270.398437c0 8.285157 6.714844 15 15 15zm0 0"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>

    </div>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.hoverintent/1.10.1/jquery.hoverIntent.min.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/29.0.0/inline/ckeditor.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="js/welcome.js"></script>

</html>