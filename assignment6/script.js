
function displayResults(results){
	let temperature = Number.parseFloat(results.data[0].temp).toFixed(0);
	let feelsTemperature = Number.parseFloat(results.data[0].app_temp).toFixed(0);
	let description = results.data[0].weather.description;

	$("#degrees").html(temperature + '&#xb0;');
	$("#feelsDegrees").html(feelsTemperature + '&#xb0;');
	$("#description").text(description);
}

window.onload = function(){
	// let weatherEndpoint = "https://api.weatherbit.io/v2.0/current?city=LA,CA&key=bd7e593327364861a7cd49a500973827"

	$.ajax({
		method: "GET",
		url: "https://api.weatherbit.io/v2.0/current",
		data: {
			city: "LA,CA",
			key: "bd7e593327364861a7cd49a500973827",
			units: "I"
		}

	})
	.done(function(results){
		displayResults(results);
	});

}
// function to cross out task and uncross out when clicked
$("#ulElement").on("click", "span",function(event){
	console.log(this);
	$(this).toggleClass("linethrough");

});

//function to fadeout and delete the clicked list element
$("#ulElement").on("click","i", function(event){
	console.log(this);
	console.log(this.parentElement);
	$(this.parentElement).fadeOut(function(){
		$(this).remove();
	});
});

$("#formBoi").on("submit",function(event){
	event.preventDefault();
	if($("#userInput").val().length > 0){
		let $liElement = $("<li class = 'task'><i class='far fa-square boxSpacing'></i></li>");
		let $spanElement = $("<span class = 'taskText'> </span>");
		$spanElement.text($("#userInput").val());
		$liElement.append($spanElement);
		$("#ulElement").append($liElement);
		$("#userInput").val("");
	}
});

$("#plusIcon").on("click",function(event){
	$("#userInput").slideToggle("slow");
});