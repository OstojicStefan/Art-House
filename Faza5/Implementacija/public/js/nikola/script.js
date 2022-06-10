function rateExhibition() {
    $.ajax({
        url: '/rate_exhibition',
        method: 'GET',
        data: $('input[name="rate"]:checked').serialize(),
        processData: false,
        dataType: 'json',
        contentType: false,
        beforeSend: function () {
          
        },
        success: function (data) {
            if(data['status'] == 1){                
                var x = document.getElementsByName("rate");
                var i;
                if(data['msg']<1.5){
                    document.getElementById("star1").checked = true;
                }else if(data['msg'] <2.5){
                    document.getElementById("star2").checked = true;
                }else if(data['msg'] < 3.5){
                    document.getElementById("star3").checked = true;
                }else if(data['msg'] < 4.5){
                    document.getElementById("star4").checked = true;
                }else{
                    document.getElementById("star5").checked = true;
                }
                for (i = 0; i < x.length; i++) {
                    x[i].disabled = true;
                }
            } else {
                alert('Illegal operation!');
            }
        }
    });
}
