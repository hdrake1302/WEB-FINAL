$(document).ready(function(){
    $(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });

    $("#menu-btn").click(function() {
        $(".sidebar").toggleClass("active");
    });
});
