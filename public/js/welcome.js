let editor;
$(document).ready(function () {
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
});
