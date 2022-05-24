
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
    if (vreme.value == ''){
        alert("Please select the time of your exhibition");
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
