<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Trombinoscope</title>
<link href="css/style.css" rel="stylesheet" type="text/css">


<script src="jquery.min.js" ></script>
<!-- Merci Mr.Samuel  -->
<script>
	function presentliste(etu){
		var dl = document.getElementById("lst"); 

		//AJOUTE DANS LA BASE
		$.get("ecrire.php"
				, {nom:etu.nom,cours:'LangagesWeb',raison:1},
				 function(message){
					var liste = document.createElement("div");
					liste.setAttribute('class', 'listeP');
					liste.innerHTML = message;
					dl.appendChild(liste);
				});
		
	};

	function absentliste(etu){

		var dl = document.getElementById("lst"); 
		var liste = document.createElement("div");
			liste.setAttribute('class', 'listeA');
			liste.innerHTML = etu.nom+' est abscent.';//etu.prenom+' '+etu.nom+' '+etu.diplome+' est absent';
		dl.appendChild(liste);
		
		
	};	
		function showRSS(url)
		{
			//merci ˆ http://stackoverflow.com/questions/10943544/how-to-parse-a-rss-feed-using-javascript
			$.ajax({
				  url      : document.location.protocol + '//ajax.googleapis.com/ajax/services/feed/load?v=1.0&num=100&callback=?&q=' + encodeURIComponent(url),
				  dataType : 'json',
				  success  : function (data) {
				    if (data.responseData.feed && data.responseData.feed.entries) {
				      $.each(data.responseData.feed.entries, function (i, e) {
				        console.log("------------------------");
				        console.log("image      : " + e.mediaGroups[0].contents[0].url);
				        console.log("title      : " + e.title);
				        console.log("author     : " + e.author);
				        console.log("description: " + e.description);
				        var oEtu = {nom:e.title,url:e.mediaGroups[0].contents[0].url};
				        showEtu(oEtu);
				        
				      });
				    }
				  }
				});
			console.log('FIN showRSS');
		}
		
		function showEtu(etu){
			var d=document.createElement("div");
			d.setAttribute('class', 'etu');
			d.innerHTML = etu.nom;
			document.body.appendChild(d);
			
			var tof = document.createElement("img");
			tof.setAttribute('src', etu.url);
			tof.setAttribute('class','photo');
			tof.setAttribute('width','300');
			tof.setAttribute('height','300');
			tof.setAttribute('alt', etu.nom);
			tof.setAttribute('title', etu.nom);
			tof.addEventListener("click", function(){presentliste(etu)});
			d.appendChild(tof);
		
			

			
		};		
	</script>
</head>
<body>
	<form>
			<select onchange="showRSS(this.value)" class="centre">
				<option value="">Selectioner un diplome</option>
				<option value="https://goo.gl/PB4Qqm">THYP 1314</option>
			</select>
		</form>
		<h1>Bienvenue ...</h1>
		<div id="rssOutput"></div>
		<div id="lst" class="centre"></div>
		
		
</body>
</html>