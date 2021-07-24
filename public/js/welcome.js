var editor;
var id;
var fixedNote, otherNote;
var fixedVueData,
    otherVueData;
var noteTemplate;
$(document).ready(function () {
    $('.myTooltip').tooltip();

    InlineEditor
        .create(document.querySelector('#addNote'))
        .then(newEditor => {
            editor = newEditor;
        })
        .catch(error => {
            console.error(error);
        });

    Vue.component('note-template', {
        props: ['post'],
        template: `
        <div class="card" :id="post.id" v-bind:style="{backgroundColor: post.bgcolor}">
        <div class="pushpin myTooltip" :data-did="post.id" :data-type="post.type" data-toggle="tooltip" data-placement="bottom" title="固定記事">
            <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                <path fill="none" d="M0 0h24v24H0z" />
                <path fill="#000" d="M17 4v7l2 3v2h-6v5l-1 1-1-1v-5H5v-2l2-3V4c0-1.1.9-2 2-2h6c1.11 0 2 .89 2 2zM9 4v7.75L7.5 14h9L15 11.75V4H9z" />
            </svg>
        </div>
        <div class="cardContent">
            {{ post.content }}
        </div>

        <div class="footer">
            <div class="dialog" style="display: none">
                <div class="color myTooltip presetColor" style="background-color: #fff;" data-color="#fff" data-toggle="tooltip" data-placement="bottom" title="預設"></div>
                <div class="color myTooltip" style="background-color: #f28b82;" data-color="#f28b82" data-toggle="tooltip" data-placement="bottom" title="紅色"></div>
                <div class="color myTooltip" style="background-color: #fbbc04;" data-color="#fbbc04" data-toggle="tooltip" data-placement="bottom" title="橘色"></div>
                <div class="color myTooltip" style="background-color: #fff475;" data-color="#fff475" data-toggle="tooltip" data-placement="bottom" title="黃色"></div>
                <div class="color myTooltip" style="background-color: #a7ffeb;" data-color="#a7ffeb" data-toggle="tooltip" data-placement="bottom" title="藍綠色"></div>
                <div class="color myTooltip" style="background-color: #ccff90;" data-color="#ccff90" data-toggle="tooltip" data-placement="bottom" title="綠色"></div>
                <div class="color myTooltip" style="background-color: #cbf0f8;" data-color="#cbf0f8" data-toggle="tooltip" data-placement="bottom" title="藍色"></div>
                <div class="color myTooltip" style="background-color: #aecbfa;" data-color="#aecbfa" data-toggle="tooltip" data-placement="bottom" title="深藍色"></div>
                <div class="color myTooltip" style="background-color: #d7aefb;" data-color="#d7aefb" data-toggle="tooltip" data-placement="bottom" title="紫色"></div>
                <div class="color myTooltip" style="background-color: #fdcfe8;" data-color="#fdcfe8" data-toggle="tooltip" data-placement="bottom" title="粉紅色"></div>
                <div class="color myTooltip" style="background-color: #e6c9a8;" data-color="#e6c9a8" data-toggle="tooltip" data-placement="bottom" title="棕色"></div>
                <div class="color myTooltip" style="background-color: #e8eaed;" data-color="#e8eaed" data-toggle="tooltip" data-placement="bottom" title="灰色"></div>
            </div>
            <div class="icon">
                <div class="changeColor myTooltip" :data-did="post.id" data-toggle="tooltip" data-placement="bottom" title="變更顏色">
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
                <div class="delete myTooltip" :data-did="post.id" :data-type="post.type" data-toggle="tooltip" data-placement="bottom" title="刪除記事">
                    <svg width="24" height="24" viewBox="-47 0 512 512" xmlns="http://www.w3.org/2000/svg">
                        <path d="m416.875 114.441406-11.304688-33.886718c-4.304687-12.90625-16.339843-21.578126-29.941406-21.578126h-95.011718v-30.933593c0-15.460938-12.570313-28.042969-28.027344-28.042969h-87.007813c-15.453125 0-28.027343 12.582031-28.027343 28.042969v30.933593h-95.007813c-13.605469 0-25.640625 8.671876-29.945313 21.578126l-11.304687 33.886718c-2.574219 7.714844-1.2695312 16.257813 3.484375 22.855469 4.753906 6.597656 12.445312 10.539063 20.578125 10.539063h11.816406l26.007813 321.605468c1.933594 23.863282 22.183594 42.558594 46.109375 42.558594h204.863281c23.921875 0 44.175781-18.695312 46.105469-42.5625l26.007812-321.601562h6.542969c8.132812 0 15.824219-3.941407 20.578125-10.535157 4.753906-6.597656 6.058594-15.144531 3.484375-22.859375zm-249.320312-84.441406h83.0625v28.976562h-83.0625zm162.804687 437.019531c-.679687 8.402344-7.796875 14.980469-16.203125 14.980469h-204.863281c-8.40625 0-15.523438-6.578125-16.203125-14.980469l-25.816406-319.183593h288.898437zm-298.566406-349.183593 9.269531-27.789063c.210938-.640625.808594-1.070313 1.484375-1.070313h333.082031c.675782 0 1.269532.429688 1.484375 1.070313l9.269531 27.789063zm0 0" />
                        <path d="m282.515625 465.957031c.265625.015625.527344.019531.792969.019531 7.925781 0 14.550781-6.210937 14.964844-14.21875l14.085937-270.398437c.429687-8.273437-5.929687-15.332031-14.199219-15.761719-8.292968-.441406-15.328125 5.925782-15.761718 14.199219l-14.082032 270.398437c-.429687 8.273438 5.925782 15.332032 14.199219 15.761719zm0 0" />
                        <path d="m120.566406 451.792969c.4375 7.996093 7.054688 14.183593 14.964844 14.183593.273438 0 .554688-.007812.832031-.023437 8.269531-.449219 14.609375-7.519531 14.160157-15.792969l-14.753907-270.398437c-.449219-8.273438-7.519531-14.613281-15.792969-14.160157-8.269531.449219-14.609374 7.519532-14.160156 15.792969zm0 0" />
                        <path d="m209.253906 465.976562c8.285156 0 15-6.714843 15-15v-270.398437c0-8.285156-6.714844-15-15-15s-15 6.714844-15 15v270.398437c0 8.285157 6.714844 15 15 15zm0 0" />
                    </svg>
                </div>
            </div>
        </div>
    </div>
        `
    })

    $.ajax({
        type: "get",
        url: "note/index",
        dataType: "json",
        async: false,
        success: function (r) {
            fixedVueData = r.fixed;
            otherVueData = r.other;
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
        $(".option").removeClass("optionSelected");
        $(this).addClass("optionSelected");
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("#addNoteBtn").click(function (e) {
        $.ajax({
            type: "post",
            url: "note/store",
            data: {
                content: editor.getData()
            },
            dataType: "json",
            success: function (r) {
                if (r['status']) {
                    otherNote.posts.push({
                        fixed: '0',
                        id: r['id'],
                        content: r['content'],
                        bgcolor: 'rgb(255, 255, 255)'
                    });
                    console.log(otherNote.posts);
                }

                Swal.fire({
                    icon: 'success',
                    title: r['msg'],
                    showConfirmButton: false,
                    timer: 1500
                })
            }
        });
    });

    fixedNote = new Vue({
        el: '#fixedArea',
        data: {
            posts: fixedVueData,
            type: "fixed"
        },
        updated: function () {
            noteRead();
        },
        created: function () {
            noteRead();
        }
    });

    otherNote = new Vue({
        el: '#otherArea',
        data: {
            posts: otherVueData,
            type: "other"
        },
        updated: function () {
            noteRead();
        },
        created: function () {
            noteRead();
        }
    });

    noteRead();

    // otherNote.posts.push({
    //     id: '3',
    //     content: '3',
    //     fixed: '0'
    // });
});

function dialogOver() {

}

function dialogOut() {
    $(`#${id} div[class='dialog']`).css('display', 'none');
}

function noteRead() {
    $(".dialog .color").unbind();
    $(".dialog .color").click(function (e) {
        $(".dialog .color").removeClass("colorSelected");
        $(this).addClass("colorSelected");
    })

    $(".changeColor").unbind();
    $(".changeColor").hover(function (e) {
        id = $(this).data("did");
        $(`#${id} div[class='dialog']`).css('display', 'block');
        $(`#${id} div[class='dialog']`).unbind();
        $(`#${id} div[class='dialog']`).hoverIntent({
            sensitivity: 3, //滑鼠滑動的敏感度,最少要設定為1    
            interval: 200, //滑鼠滑過後要延遲的秒數    
            timeout: 200, //滑鼠滑出前要延遲的秒數    
            over: dialogOver,
            out: dialogOut //滑鼠滑出要執行的函式  
        });
    }, function () {

    });

    $(".color").unbind();
    $(".color").click(function (e) {
        $(this).closest(".card").css("background-color", $(this).data("color"));
    })

    $(".pushpin").unbind();
    $(".pushpin").click(function () {
        type = $(this).data("type");
        id = $(this).data("did");
        console.log(type, id);
        $.ajax({
            type: "post",
            url: `note/updateFixed/${id}/${type}`,
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
                        otherVueData.push({
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
                        fixedVueData.push({
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

    $(".delete").unbind();
    $(".delete").click(function (e) {
        type = $(this).data("type");
        id = $(this).data("did");
        Swal.fire({
            title: '確定要刪除嗎?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '刪除'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "delete",
                    url: `note/delete/${id}`,
                    dataType: "json",
                    success: function (r) {
                        if (r['status']) {
                            if (type) {
                                index = fixedVueData.find(function (item, Index, array) {
                                    if (item.id == id)
                                        return Index;
                                });
                                fixedVueData.splice(index, 1);
                            } else {
                                index = otherVueData.find(function (item, Index, array) {
                                    if (item.id == id)
                                        return Index;
                                });
                                otherVueData.splice(index, 1);
                            }
                        }
                        Swal.fire({
                            icon: 'success',
                            title: r['msg'],
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }
                });
            }
        })
    })
}
