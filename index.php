<html>
<head>
<title>Bond Web Service Demo</title>
<style>
body {font-family:georgia;}

.film{
	border:1px solid #E77DC2;
	border-radius: 5px;
	padding: 5px;
	margin-bottom:5px;
	position:relative;	
}

.pic{
	position:absolute;
	right:10px;
	top:10px;
}

</style>
<script src="https://code.jquery.com/jquery-latest.js" type="text/javascript"></script>

<script type="text/javascript">
$(document).ready(function() {  

	$('.category').click(function(e){
        e.preventDefault(); //stop default action of the link
		cat = $(this).attr("href");  //get category from URL
		loadAJAX(cat);  //load AJAX and parse JSON file
	});
});	


function loadAJAX(cat)
{
	//AJAX connection will go here
    //alert('cat is: ' + cat);
	
	$.ajax({
		type: "GET",
		dataType: "json",
		url: "api.php?cat=" + cat,
		success: bondJSON 
	});


}
    
function toConsole(data)
{//return data to console for JSON examination
	console.log(data); //to view,use Chrome console, ctrl + shift + j
}

function bondJSON(data){
	console.log(data);
/*
	//identifies the type of data returned
	$('#filmtitle').html(data.title);
	$('#films').html("");//clears
	$.each(data.films,function(i,item){
		let myFilm = bondTemplate(item);
		$('<div></div>').html(myFilm).appendTo('#films');
	});
*/
	
	let myData = JSON.stringify(data,null,4);
	myData = "<pre>" + myData + "</pre>";
	$("#output").html(myData);
	
}

function bondTemplate(game){

	return`
		<div class="film">
			<b>Title: </b>${game.Title}<br />
			<b>Genre: </b>${game.Genre}<br />
			<b>Developer: </b>${game.Developer}<br />
			<b>Year: </b>${game.Year}<br />
			<b>Rating: </b>${game.Rating}<br />
			<div class="pic"><img src="thumbnails/${game.Image}"></div>
		</div>
	`;
	/*
				"Title":"Sonic The Hedgehog",
				"Genre":"Platformer",
				"Developer":"Sega",
				"Year":1991,
                "Rating":"E",
				"Image":"sonic-the-hedgehog.jpg"
				*/
}

</script>
</head>
	<body>
	<h1>Bond Web Service</h1>
		<a href="year" class="category">Video Games By Year</a><br />
		<a href="title" class="category">Video Games By Title</a>
		<h3 id="filmtitle">Title Will Go Here</h3>
		<div id="films">

		</div>
		<div id="output">Results go here</div>
	</body>
</html>