
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
        $("#tabela_uredjivanje").append("<tr><td><img src='"+nizSlika[i].ime+"' class='noHover'></td><td>Opis slike<textarea cols='75' rows='10'></textarea>Redni broj slike u izložbi<input type='number' min='1' max='"+(nizSlika.length-1)+"'></td></tr>");
    }
}

function dodajSlike(){
    
    var table = document.getElementById("moja_tabela");
 	//iteriranje kroz redove
    for (var i = 1, row; row = table.rows[i]; i++) {
        if (i==4){
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