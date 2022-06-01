
//Autor: Stefan Ostojić

let nizSlika = localStorage.getItem("slike");
nizSlika = (nizSlika) ? JSON.parse(nizSlika) : [
    {
        ime : "_",
        redniBroj : "_",
        opis : "_"
    }
]

$(document).ready(function(){

    var chatbox = document.getElementById('chat_box');
    if (chatbox)
    chatbox.scrollTop = chatbox.scrollHeight;

    $("img").on("click", function(){
        $(this).toggleClass("img-thumbnail hoveruj");
        var slika = $(this).attr("src");
        
    });

    //ovaj deo je zaduzen za automatsko osvezavanje kada korisnik posalje novu poruku u chat
    $("#send_message").on('submit', function(e){
        e.preventDefault();
        
        $.ajax({
            url:$(this).attr('action'),
            method:$(this).attr('method'),
            data: new FormData(this),
            processData:false,
            dataType:'text',
            contentType: false,
            beforeSend:function(){
                
            },
            success:function(){
                tekst = document.getElementById("msg_input");
                $("#chat_box").append("<div class='container darker'><img src='/slike/profile_picture.jpg' class='right'><p>"+tekst.value+"</p></div>");
                tekst.value='';
                var chatbox = document.getElementById('chat_box');
                chatbox.scrollTop = chatbox.scrollHeight;
            }
        });
    });
    
});

function inicijalizujIzlozbu(){
    for (let i=1;i<nizSlika.length;i++){
        $("#tabela_uredjivanje").append("<tr><td><img src='"+nizSlika[i].ime+"' class='noHover'></td><td>Description<textarea cols='75' rows='10' name='imageDesc[]'></textarea>Ordinal number in exhibiton <input type='number' min='1' max='"+(nizSlika.length-1)+"' name='imageOrder[]'><input type='hidden' value='"+nizSlika[i].ime+"' name='imagePic[]'></td></tr>");
    }
}

function dodajSlike(){
    let provera = localStorage.getItem("slike");
    if (provera){
        localStorage.clear();
        nizSlika=[
            {
                ime : "_",
                redniBroj : "_",
                opis : "_"
            }
        ];
    }

    var table = document.getElementById("moja_tabela");
 	//iteriranje kroz redove
    for (var i = 1, row; row = table.rows[i]; i++) {
        if (i==table.rows.length-1){
            if (nizSlika.length==1){
                alert("You have to select at least one image to create an exhibition");
                return;
            }
            localStorage.setItem("slike", JSON.stringify(nizSlika));
            window.location.href="/myExhibition";
            return;
        }
        
 	//iteriranje kroz kolone
        for (var j = 0, col; col = row.cells[j]; j++) {
           //biranje slika
           var ozn = row.cells[j].querySelector('img').getAttribute('src');
    
           var bool = row.cells[j].querySelector('img').classList.contains('hoveruj');

                if (bool){
                    nizSlika.push(
                        {
                            ime: ozn,
                            redniBroj : "_",
                            opis : "_"
                        }
                    );
                }
        }
    }

    localStorage.setItem("slike", JSON.stringify(nizSlika));
}

function kreirajIzlozbu(){
    let vreme = document.getElementById("vreme_izlozbe");
    let naziv = document.getElementById("naziv_izlozbe");
    if (vreme.value == ''){
        alert("Please select the time of your exhibition");
        event.preventDefault();
        return;
    }
    if (!naziv.value){
        alert("The exhibition must have a name");
        event.preventDefault();
        return;
    }

    var table = document.getElementById("tabela_uredjivanje");

    for (var i = 1, row; row = table.rows[i]; i++) {
        var tekst = row.cells[1].querySelector('textarea').value;
        var broj = row.cells[1].querySelector('input').value;

        nizSlika[i].opis=tekst;
        nizSlika[i].redniBroj=broj;

    }
    
    window.location.href='nikola/nikola/pages/sve-izlozbe.html';
}

function sendMessage(tekst){
    alert(tekst);
    event.preventDefault();
    $("#chat_box").append("<div class='container darker'><img src='/slike/profile_picture.jpg' class='right'><p>"+tekst+"</p></div>");
}
