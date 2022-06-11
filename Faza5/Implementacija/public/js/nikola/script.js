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
                var i, obrisi;
        
                   document.getElementById("star5").checked = false;
                if(data['msg']<1.5){
                    document.getElementById("star1").checked = true;
                    obrisi = 2;
                }else if(data['msg'] <2.5){
                    document.getElementById("star2").checked = true;
                    obrisi = 3;
                }else if(data['msg'] < 3.5){
                    document.getElementById("star3").checked = true;
                    obrisi = 4;
                }else if(data['msg'] < 4.5){
                    document.getElementById("star4").checked = true;
                    obrisi = 5;
                }else{
                    document.getElementById("star5").checked = true;
                    obrisi = 6;
                }
                for (let i=obrisi;i<=5;i++){
                    $("#zvezda"+i).css({"color" : "#ffffff"});
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
