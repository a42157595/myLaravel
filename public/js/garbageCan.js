var editor;
var id;
var Note;
var noteVueData;
var noteTemplate;
$(document).ready(function () {
    $('.myTooltip').tooltip();

    Vue.component('note-template', {
        props: ['post'],
        template: `
        <div class="card" :id="post.id" v-bind:style="{backgroundColor: post.bgcolor}">
        <div class="pushpin myTooltip" :data-did="post.id" data-toggle="tooltip" data-placement="bottom" title="固定記事">
            <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                <path fill="none" d="M0 0h24v24H0z" />
                <path fill="#000" d="M17 4v7l2 3v2h-6v5l-1 1-1-1v-5H5v-2l2-3V4c0-1.1.9-2 2-2h6c1.11 0 2 .89 2 2zM9 4v7.75L7.5 14h9L15 11.75V4H9z" />
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

    noteRead();
});

function noteRead() {
    $(".pushpin").unbind();
    $(".pushpin").click(function () {
        type = $(this).data("type");
        id = $(this).closest(".card").attr('id');
        console.log(type, id);
        $.ajax({
            type: "post",
            url: `garbageCan/updateFixed/${id}/${type}`,
            data: {
                _method: "put"
            },
            dataType: "json",
            success: function (r) {
                if (r['status']) {
                    if (type) {
                        data = fixedVueData.find(function (item, Index, array) {
                            item.index = Index
                            return item.id == id;
                        });
                        fixedVueData.splice(data.index, 1);
                        otherVueData.unshift({
                            type: '1',
                            id: data.id,
                            content: data.content,
                            bgcolor: data.bgcolor
                        })
                    } else {
                        data = otherVueData.find(function (item, Index, array) {
                            item.index = Index;
                            return item.id == id;
                        });
                        otherVueData.splice(data.index, 1);
                        fixedVueData.unshift({
                            type: '1',
                            id: data.id,
                            content: data.content,
                            bgcolor: data.bgcolor
                        })
                    }
                }
            }
        });
    })
}
