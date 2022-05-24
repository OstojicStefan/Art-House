$( document ).ready(function() {
    $('#formaRegistrovanjeGotovo').hide();
});


function proveriTag(){

    let tag = document.getElementById("imeTaga").value;
    if(/^[a-zA-Z0-9_ ]{3,40}$/.test(tag) == false){
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

function proveriPasswordiUsername(){
    let a = document.getElementById('greskaServerLogin');
    if(a != null){
        a.innerHTML = " ";
    }
    let userName = document.getElementById("username").value;
    let password = document.getElementById("password").value; 
    document.getElementById("usernameGreskaLogin").innerHTML = " ";
    document.getElementById("passwordGreskaLogin").innerHTML = " ";
    if(/^\w{3,29}$/.test(userName) == false){
        document.getElementById("usernameGreskaLogin").innerHTML = "<div style = 'color:red'>Username has to be in required format!</div>";
        event.preventDefault();
    }
    if(/^\w{4,29}$/.test(password) == false){
        document.getElementById("passwordGreskaLogin").innerHTML = "<div style = 'color:red'>Password has to be in required format!</div>";
        event.preventDefault();
    }
}

function registracijaProvera(){
    let username = document.getElementById("username").value;
    let password = document.getElementById("password").value;
    let password2 = document.getElementById("password2").value;
    let email = document.getElementById("email").value;
    let brojKartice = document.getElementById("brojKartice").value;
    let ccvKartice = document.getElementById("ccvKartice").value;
    let iznos = document.getElementById("iznos").value;
    let zelimHotAukcijeNaMail = document.getElementById("zelimHotAukcijeNaMail").checked;
    let obavestMeOKrajuAukcije = document.getElementById("obavestMeOKrajuAukcije").checked;

    povratna = 0;

    document.getElementById("usernameGreskaRegistracija").innerHTML = "";
    document.getElementById("passwordGreskaRegistracija").innerHTML = "";
    document.getElementById("password2GreskaRegistracija").innerHTML = "";
    document.getElementById("emailGreskaRegistracija").innerHTML = "";
    document.getElementById("brojKarticeGreskaRegistracija").innerHTML = "";
    document.getElementById("ccvKarticeGreskaRegistracija").innerHTML = "";
    document.getElementById("iznosGreskaRegistracija").innerHTML = "";


    if(/^\w{3,29}$/.test(username) == false){
        document.getElementById("usernameGreskaRegistracija").innerHTML = "<div style = 'color:red'>Username has to be between 3 and 30 characters long!</div>";
        povratna++;
    }
    if(/^\w{8,29}$/.test(password) == false || /\d+/.test(password) == false){
        document.getElementById("passwordGreskaRegistracija").innerHTML = "<div style = 'color:red'>Password has to be between 8 and 30 characters long, with at least one number!</div>";
        povratna++;
    }
    if(password != password2){
        document.getElementById("password2GreskaRegistracija").innerHTML = "<div style = 'color:red'>Passwords do not match!</div>";
        povratna++;
    }
    if(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email) == false || /^.{3,29}$/.test(email) == false){
        document.getElementById("emailGreskaRegistracija").innerHTML = "<div style = 'color:red'>E-mail is not in required format!</div>";
        povratna++;
    }
    if(/^\d{6,10}$/.test(brojKartice) == false){
        document.getElementById("brojKarticeGreskaRegistracija").innerHTML = "<div style = 'color:red'>Card number has to be between 6 and 10 digits long!</div>";
        povratna++;
    }
    if(/^\d{3,3}$/.test(ccvKartice) == false){
        document.getElementById("ccvKarticeGreskaRegistracija").innerHTML = "<div style = 'color:red'>CCV has to be 3 digits long!</div>";
        povratna++;
    }
    if(iznos > 10000000 || iznos < 0){
        document.getElementById("iznosGreskaRegistracija").innerHTML = "<div style = 'color:red'>Emount can not be greater then 10000000!</div>";
        povratna++;
    }

    if(povratna > 0){
        event.preventDefault();
    }
}

function test(){
    alert("das");
}

function createAuctionProvera(){

    document.getElementById("myfileGreska").innerHTML = "";
    let povratna = 0;
    //provera ekstenzije file-a
    var fileInput = document.getElementById('myfile');  
    if(fileInput.files[0] != null){
    var filePath = fileInput.value;
    var allowedExtensions =/(\.jpg|\.png)$/i;
    if (!allowedExtensions.exec(filePath)) {
        document.getElementById("myfileGreska").innerHTML = "<div style = 'color:red'>Invalid file type(.jpg and .png are supported!</div>";
        fileInput.value = '';
        povratna++;
    }
    else if(fileInput.files[0].size > 1048576){
        document.getElementById("myfileGreska").innerHTML = "<div style = 'color:red'>Invalid file size(must be less or equal to 1MB)!</div>";
        fileInput.value = '';
        povratna++;
    }}
    else{
        document.getElementById("myfileGreska").innerHTML = "<div style = 'color:red'>Image is required!</div>";
    }

    let imeSlike = document.getElementById('imeSlike').value;
    let opisniTekst = document.getElementById('opisniTekst').value;
    let Autor = document.getElementById('Autor').value;
    let godinaSlikanja = document.getElementById('godinaSlikanja').value;
    let PhysicalVirtual = document.getElementById('PhysicalVirtual').value;
    let vremeTrajanja = document.getElementById('vremeTrajanja').value;
    let pocetnaCena = document.getElementById('pocetnaCena').value;
    let tagoviCA = document.querySelector("#tagoviCA").options;

    document.getElementById("imeSlikeGreska").innerHTML = " ";
    document.getElementById("opisniTekstGreska").innerHTML = " ";
    document.getElementById("AutorGreska").innerHTML = " ";
    document.getElementById("godinaSlikanjaGreska").innerHTML = " ";
    if(PhysicalVirtual == 'physical')
        document.getElementById("lokacijaSlikeGreska").innerHTML = " ";
    document.getElementById("vremeTrajanjaGreska").innerHTML = " ";
    document.getElementById("pocetnaCenaGreska").innerHTML = " ";
    document.getElementById("tagoviCAGreska").innerHTML = " ";

    
    if(/^[a-zA-Z0-9_ ]{4,30}$/.test(imeSlike) == false){
        document.getElementById("imeSlikeGreska").innerHTML = "<div style = 'color:red'>Image name has to be between 4 and 30 characters long!</div>";
        povratna++;
    }
    if(/^.{10,512}$/.test(opisniTekst) == false){
        document.getElementById("opisniTekstGreska").innerHTML = "<div style = 'color:red'>Description has to be between 10 and 512 characters long!</div>";
        povratna++;
    }
    if(/^[a-zA-Z0-9_ ]{3,30}$/.test(Autor) == false){
        document.getElementById("AutorGreska").innerHTML = "<div style = 'color:red'>Author name has to be between 3 and 30 characters long!</div>";
        povratna++;
    }
    if(/^\d+$/.test(godinaSlikanja) == false || godinaSlikanja < 0 || godinaSlikanja > 2022){
        document.getElementById("godinaSlikanjaGreska").innerHTML = "<div style = 'color:red'>Year of creation has to be between 0 and 2022!</div>";
        povratna++;
    }
    if(PhysicalVirtual == 'physical'){
        if(/^[a-zA-Z0-9_ ]{4,50}$/.test(document.getElementById('lokacijaSlike').value) == false){
            document.getElementById("lokacijaSlikeGreska").innerHTML = "<div style = 'color:red'>Location has to be between 4 and 50 characters long!</div>";
            povratna++;
        }
    }
    if(/^\d+$/.test(vremeTrajanja) == false || vremeTrajanja < 1 || vremeTrajanja >30){
        document.getElementById("vremeTrajanjaGreska").innerHTML = "<div style = 'color:red'>Auction duration has to be between 1 and 30!</div>";
        povratna++;
    }
    if(/^\d+$/.test(pocetnaCena) == false || pocetnaCena <= 0 || pocetnaCena > 9999999999.999){
        document.getElementById("pocetnaCenaGreska").innerHTML = "<div style = 'color:red'>Starting price has to be between 0 and 10000000000!</div>";
        povratna++;
    }

    brojTagova = 0;
    for (var option of document.getElementById('tagoviCA').options)
    {
        if (option.selected) {
            brojTagova++;
        }
    }
    if(brojTagova >5 || brojTagova < 1){
       document.getElementById("tagoviCAGreska").innerHTML = "<div style = 'color:red'>You must choose 1-5 tags!</div>";
       povratna++;
    }

    if(povratna>0){
        event.preventDefault();
    }
}

$(function(){
    $("#registerform").on('submit', function(e){
        e.preventDefault();

        $.ajax({
            url:$(this).attr('action'),
            method:$(this).attr('method'),
            data: new FormData(this),
            processData:false,
            dataType:'json',
            contentType: false,
            beforeSend:function(){
                
            },
            success:function(data){
                if(data['status'] == 1){
                    document.getElementById("usernameGreskaRegistracija").innerHTML = "<div style = 'color:red'>" + data['msg'] + "</div>";
                }
                else if(data['status'] == 2){
                    document.getElementById("emailGreskaRegistracija").innerHTML = "<div style = 'color:red'>" + data['msg'] + "</div>";
                }
                else if(data['status'] == 3){
                    document.getElementById("GreskaUopste").innerHTML = "<div style = 'color:red'>" + data['msg'] + "</div>";
                }
                else{
                    $('#formaRegistrovanje').hide();
                    $('#formaRegistrovanjeGotovo').show();
                    document.getElementById("PovratnaUspeh").innerHTML = "<div style = 'color:blue'>" + data['msg'] + "</div>";
                }
            }
        });
    });
});


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
                if(data['status'] == 1 || data['status'] == 2){
                    if(data['status']==2){
                        document.getElementById("RemoveTagsGreska").innerHTML = "<font color = 'red'>Tags are referenced in another table!</font>";
                    }
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