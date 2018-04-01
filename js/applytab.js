$(document).ready(function(){
	$("#colorful").colorfulTab();    
	$("#colorful-elliptic").colorfulTab({
		theme: "elliptic"
	}); 
   $("#colorful-flatline").colorfulTab({
		theme: "flatline"
	});    
	$("#colorful-background-image").colorfulTab({
		theme: "flatline",
		backgroundImage: "true",
		overlayColor: "#002F68",
		overlayOpacity: "0.8"
	});   
});