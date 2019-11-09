
function displayResults(results){
	let temperature = results.data[0].temp;
	let feelsTemperature = results.data[0].app_temp;
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
		console.log(results);
		displayResults(results);
	});

}