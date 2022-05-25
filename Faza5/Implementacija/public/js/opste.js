function cancelBid(){
    
    let bid_div = document.getElementById("bid_div");
    document.getElementById("bidInput").value="";
    bid_div.style.display="none";
    
    
}
function confirmBid(){
    let $inputBid = document.getElementById("bidInput").value;
    if ($inputBid)
        confirm("Are you sure you want to bid" + $inputBid + " din?")
}
function areaForBidding(){
    let bid_div = document.getElementById("bid_div")
    bid_div.style.display="block"
}

function checkUsername(){
    let username = document.getElementById("usernameInput").value;
    if(/^\w{3,29}$/.test(username) == false){
        document.getElementById("usernameError").innerHTML = "<div style = 'color:red'>Username has to be in required format!</div>";
        event.preventDefault();
    }
}
