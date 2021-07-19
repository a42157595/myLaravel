$(document).ready(function () {
    InlineEditor
        .create(document.querySelector('#addNote'))
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
});
