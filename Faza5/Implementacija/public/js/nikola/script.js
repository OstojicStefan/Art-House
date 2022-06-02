function rateExhibition() {
    $.ajax({
        url: '/rate_exhibition',
        method: 'GET',
        data: $('input[name="rate"]:checked').serialize(),
        processData: false,
        contentType: false,
        beforeSend: function () {
        },
        success: function (response) {
            var json_data = JSON.parse(response);
            alert(json_data.vrednost);
        }
    });
}