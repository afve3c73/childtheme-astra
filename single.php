<?php
get_header();
?>
   
   <div id="main" id="main" class="site-content">
    <div class="ast-container">
	<section id="tilbage">
		<button class="luk">Tilbage</button>
</section>
<section class="indhold">
<article class="toj_single">
	<div class=single_billede>
		
	<img class="billede" src="" alt=""/></div>
	<div class=single_tekst> <h2 class="title"></h2>
		<p class= "beskrivelse"></p>
		<p class= "storrelse"></p>
		<p class= "pris"></p></div>
      </article>
	<figure class="wp-block-image size-full"><img decoding="async" src="https://madelene.dk/kea/10_eksamen/chamoi/wp-content/uploads/2022/12/femte_element.svg" alt="" class="wp-image-1126"></figure>
</section>
</div>
	<script>
	let toj;
	const url = "https://madelene.dk/kea/10_eksamen/chamoi/wp-json/wp/v2/toj/"+<?php echo get_the_ID() ?>;
//hent en enkelt ret udfra id'et
async function getJson () {
	const data = await fetch (url);
	toj = await data.json();
	console.log();
	visTojet();
	
}
// vis data om tøjet
function visTojet() {
	
      document.querySelector("h2").textContent = toj.title.rendered;
	 document.querySelector(".billede").src = toj.billede.guid; 
	  document.querySelector(".beskrivelse").textContent = toj.beskrivelse;
	document.querySelector(".storrelse").textContent = "Størrelse: " + toj.storrelse;
	 document.querySelector(".pris").textContent = toj.pris + (" kr");

}
document.querySelector(".luk").addEventListener("click", () => {
            //link tilbage til den foregående side på "luk" knappen
            history.back();
        })

getJson ();
</script>
	
	</div>

<?php

get_footer();
