

document.getElementById("divBid").style.display = "none";


var cookie = document.cookie;

if (cookie !== "") {

	//'transportistas' may want to do a bid
	if (cookie.search("transportistas") != -1){
		// do something with this role

		document.getElementById("divBid").style.display = "initial";
		
	}

}