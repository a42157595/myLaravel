$(document).ready(function () {
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

    InlineEditor
        .create(document.querySelector('#addNote'))
        .catch(error => {
            console.error(error);
        });
});
