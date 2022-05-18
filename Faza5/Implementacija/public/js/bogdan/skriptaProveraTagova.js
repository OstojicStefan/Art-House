function proveriTag(){

    let tag = document.getElementById("imeTaga").value;
    if(/^\w{3,39}$/.test(tag) == false){
        document.getElementById("imeTagaGreska").innerHTML = "<div style = 'color:red'>Tag has to be in required format!</div>";
        event.preventDefault();
    }

}

function proveriKorisnickoIme(){
    let userName = document.getElementById("usernameUK").value;
    if(/^\w{3,29}$/.test(userName) == false){
        document.getElementById("usernameUKGreska").innerHTML = "<div style = 'color:red'>Username has to be in required format!</div>";
        event.preventDefault();
    }
}

$(function(){
    $("#unapredjivanjeUloga").on('submit', function(e){
        e.preventDefault();

        $.ajax({
            url:$(this).attr('action'),
            method:$(this).attr('method'),
            data: new FormData(this),
            processData:false,
            dataType:'json',
            contentType: false,
            beforeSend:function(){
                document.getElementById("usernameUKGreska").innerHTML = "";
            },
            success:function(data){
                if(data['status'] == 1){
                    document.getElementById("usernameUKGreska").innerHTML = data['msg'];
                }
            }
        });
    });
});


$(function(){
    $("#tagZaDodavanje").on('submit', function(e){
        e.preventDefault();

        $.ajax({
            url:$(this).attr('action'),
            method:$(this).attr('method'),
            data: new FormData(this),
            processData:false,
            dataType:'json',
            contentType: false,
            beforeSend:function(){
                document.getElementById("imeTagaGreska").innerHTML = "";
            },
            success:function(data){
                if(data['status'] == 1){
                    document.getElementById("imeTagaGreska").innerHTML = data['msg'];
                }
            }
        });
    });
});


$(function(){
    $("#tagoviZaUklanjanje").on('submit', function(e){
        e.preventDefault();

        $.ajax({
            url:$(this).attr('action'),
            method:$(this).attr('method'),
            data: new FormData(this),
            processData:false,
            dataType:'json',
            contentType: false,
            beforeSend:function(){
                document.getElementById("RemoveTagsGreska").innerHTML = "";
            },
            success:function(data){
                if(data['status'] == 1){
                    let a = data['svitagovi'];
                    select = document.getElementById('tagovi');
                    select.innerHTML = "";
                    a.forEach(element => {
                        var opt = document.createElement('option');
                        opt.value = element['IDTag'];
                        opt.innerHTML = element['Name'];
                        select.appendChild(opt);
                    });
                }
            }
        });
    });
});