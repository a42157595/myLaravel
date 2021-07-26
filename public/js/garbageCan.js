var editor;
var id;
var Note;
var noteVueData, searchVueData = [];
var noteTemplate;
$(document).ready(function () {
    $('.myTooltip').tooltip();

    Vue.component('note-template', {
        props: ['post'],
        template: `
        <div class="card" :id="post.id" v-bind:style="{backgroundColor: post.bgcolor}">
        <div class="recovery myTooltip" :data-did="post.id" data-toggle="tooltip" data-placement="bottom" title="回復">
        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000">
        <path d="M0 0h24v24H0V0z" fill="none"/>
        <path d="M19 8l-4 4h3c0 3.31-2.69 6-6 6-1.01 0-1.97-.25-2.8-.7l-1.46 1.46C8.97 19.54 10.43 20 12 20c4.42 0 8-3.58 8-8h3l-4-4zM6 12c0-3.31 2.69-6 6-6 1.01 0 1.97.25 2.8.7l1.46-1.46C15.03 4.46 13.57 4 12 4c-4.42 0-8 3.58-8 8H1l4 4 4-4H6z"/>
        </svg>
        </div>
        <div class="cardContent">
            {{ post.content }}
        </div>
    </div>
        `
    })

    $.ajax({
        type: "get",
        url: "garbageCan/index",
        dataType: "json",
        async: false,
        success: function (r) {
            noteVueData = r;
        }
    });

    $(".searchInput").focus(function (e) {
        e.preventDefault();
        $("#search").addClass("searchSelected");
        $(this).addClass("inputSelected");
    });

    $(".searchInput").blur(function (e) {
        e.preventDefault();
        $("#search").removeClass("searchSelected");
        $(this).removeClass("inputSelected");
    });

    $(".option").click(function (e) {
        url = $(this).data('url');
        if (url != "null")
            window.location.replace(`http://127.0.0.1:8000/${url}`);
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    Note = new Vue({
        el: '#noteArea',
        data: {
            posts: noteVueData,
        },
        updated: function () {
            noteRead();
        },
        created: function () {
            noteRead();
        }
    });

    $(".searchForm").submit(function (e) {
        e.preventDefault();
    });

    $(".cearchBtn").click(function (e) {
        search = $(".searchInput").val();
        noteVueData.forEach(e => {
            if (e.content.indexOf(search) > 0) {
                searchVueData.push(e);
            }
        });
        Note.posts = searchVueData;
    })

    $(".cearchCloseBtn").click(function (e) {
        searchVueData = [];
        Note.posts = noteVueData;
        $(".searchInput").val("");
    })

    noteRead();
});

function noteRead() {
    $(".recovery").unbind();
    $(".recovery").click(function () {
        id = $(this).closest(".card").attr('id');
        Swal.fire({
            title: '確定要從垃圾桶中復原嗎?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: 'green',
            cancelButtonColor: '#d33',
            confirmButtonText: '復原'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "post",
                    url: `garbageCan/recovery/${id}`,
                    data: {
                        _method: "put"
                    },
                    dataType: "json",
                    success: function (r) {
                        if (r['status']) {
                            data = noteVueData.find(function (item, Index, array) {
                                item.index = Index
                                return item.id == id;
                            });
                            noteVueData.splice(data.index, 1);
                        }
                    }
                });
            }
        })
    })
}
