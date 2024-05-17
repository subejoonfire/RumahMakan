// Input
function Berhasil() {
}
$(document).ready(function () {
    $('#ajax-form').submit(function (e) {
        e.preventDefault();
        $('#response-message').text('');
        var form = $(this);
        var url = form.attr('action');
        var method = form.attr('method');
        var data = form.serialize();
        $.ajax({
            type: method,
            url: url,
            data: data,
            success: function (response) {
                $('#response-message').text(response);
            }
        });
    });
});
// Menampilkan
$(document).ready(function () {
    function getContentFromPHP() {
        $.ajax({
            url: "layouts.table",
            type: "GET",
            success: function (response) {
                $("#ajax-container").html(response);
            }
        });
    }
    setInterval(getContentFromPHP, 1000);
});