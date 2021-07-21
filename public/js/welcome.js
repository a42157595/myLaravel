var editor;
var id;
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
            url: "notes/store",
            data: {
                content: editor.getData()
            },
            dataType: "json",
            success: function (r) {
                if (r['status']) {
                    console.log("a");
                }

                swal({
                    title: r['msg'],
                    timer: 2000,
                    showConfirmButton: false
                });
            }
        });
    });

    $(".dialog .color").click(function (e) {
        $(".dialog .color").removeClass("colorSelected");
        $(this).addClass("colorSelected");
    })

    $(".changeColor").hover(function () {
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
});

function dialogOver() {

}

function dialogOut() {
    $(`#${id} div[class='dialog']`).css('display', 'none');
}
