
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

    $("img").on("click", function(){
        $(this).toggleClass("img-thumbnail hoveruj");
        var slika = $(this).attr("src");
        
    });
    
});

function inicijalizujIzlozbu(){
    for (let i=1;i<nizSlika.length;i++){
        $("#tabela_uredjivanje").append("<tr><td><img src='"+nizSlika[i].ime+"' class='noHover'></td><td>Description<textarea cols='75' rows='10'></textarea>Ordinal number in exhibiton <input type='number' min='1' max='"+(nizSlika.length-1)+"'></td></tr>");
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
        if (i==4){
            if (nizSlika.length==1){
                alert("Morate odabrati slike za svoju izložbu");
                return;
            }
            localStorage.setItem("slike", JSON.stringify(nizSlika));
            window.location.href="myExhibition.html";
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
    if (vreme.value == ''){
        alert("Morate odabrati vreme izložbe");
        return;
    }
    window.location.href='nikola/nikola/pages/sve-izlozbe.html';
}