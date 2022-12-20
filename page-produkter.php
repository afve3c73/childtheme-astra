<?php
get_header();
?>
<template>
      <article id="toj_article">
        <img src="" alt=""/>
        <h4 class="title"></h4>
        <p class="kort_beskrivelse"></p>
		<p class= "storrelse"></p>
		<p class= "pris"></p> 
      </article>
    </template>
<div id="main" class="site-content">
    <div class="ast-container">
    <h1 class="rubrik">Produkter</h1>
	<nav id="filtrering"><button class ="alle" data-tojet="alle">Alle</button></nav>

<section class= "tojcontainer">
</section>
    </div>
    <script>
		let tojet;
		let categories;
		let filter = "alle";
		

	const url = "https://madelene.dk/kea/10_eksamen/chamoi/wp-json/wp/v2/toj?per_page=100";
	const caturl = "https://madelene.dk/kea/10_eksamen/chamoi/wp-json/wp/v2/categories";
	
async function getJson () {
	const data = await fetch (url);
	const catdata = await fetch (caturl);
	tojet = await data.json();
	categories = await catdata.json();
	console.log(categories);
	visTojet();
	opretknapper ();
}


function opretknapper () {
	categories.forEach(cat => {
		 {
			document.querySelector("#filtrering").innerHTML += '<button class="filter" data-tojet="'+cat.id+'">'+cat.name+'</button>'
	}	
	})
	addEventlistenersToButtons();
}

function addEventlistenersToButtons () {
document.querySelectorAll("#filtrering button"). forEach(elm => {
	elm.addEventListener("click", filtrering);
})
}

function filtrering (){
filter = this.dataset.tojet;
console.log(filter);

visTojet();
}


function visTojet() {
	let temp = document.querySelector("template");
	let container = document.querySelector(".tojcontainer");
	container.innerHTML=" ";
    tojet.forEach(toj => {
		if ((filter == "alle"  || toj.categories.includes(parseInt(filter)))) {
		
    let klon = temp.cloneNode(true).content;
    klon.querySelector("h4").textContent = toj.title.rendered;
	klon.querySelector("img").src = toj.billede.guid; 
	klon.querySelector(".kort_beskrivelse").textContent = toj.kort_beskrivelse;
	klon.querySelector(".storrelse").textContent = "Størrelse: " + toj.storrelse;
	klon.querySelector(".pris").textContent = toj.pris + (" kr");
	klon.querySelector("article").addEventListener("click", () => {location.href =toj.link; }) 
    
	container.appendChild(klon);

}
    });

}
getJson ();
</script>
	
</div>

<?php

get_footer();