function ajax(endpoint, returnFuntion){
	let xhr = new XMLHttpRequest();
	//open request two parameters, Method and the Endpoint
	xhr.open("GET",endpoint);
	xhr.send();
	//we wait for some kind of response from iTune
	//when we get a response lets run this function
	xhr.onreadystatechange = function(){
		//console.log(this);
		if(this.readyState == this.DONE){
			//received a response from iTunes and its done
			//if we got a success response back 
			if(xhr.status == 200){
				//display the results on the browser
				let movieResults = JSON.parse(xhr.responseText);
				//JSON.parse() - converts JSON string into JS objects
				returnFuntion(movieResults);
			}
			else{
				console.log("AJAX error");
				console.log(xhr.status);
			}
		}
	}
}

function clearElement(element){
	let rcElement = document.querySelector(element);

	while(rcElement.hasChildNodes()){
		rcElement.removeChild(rcElement.lastChild);
	}
}

function displayResults(results){
	clearElement("#movie-row");
	let movierowElement = document.querySelector("#movie-row");
	document.querySelector("#displayed-results").innerHTML = results.results.length;
	document.querySelector("#num-results").innerHTML = results.total_results;
	let resultsLength = results.results.length;
	let imageSrc = "https://image.tmdb.org/t/p/original"
	for(let i = 0 ; i< resultsLength; i++){
		let colElement = document.createElement("div");
		let movieElement = document.createElement("div");
		let imgContainerElement = document.createElement("div");
		let imgElement = document.createElement("img");
		let overLayElement = document.createElement("div");
		let textElement = document.createElement("div");
		let ratingsElement = document.createElement("p");
		let votesElement = document.createElement("p");
		let synopsisElement = document.createElement("p");
		let titleElement = document.createElement("div");
		let releaseElement = document.createElement("div");
		colElement.classList.add("col-6");
		colElement.classList.add("movie-col");
		colElement.classList.add("col-md-4");
		colElement.classList.add("col-lg-3");
		colElement.setAttribute("id", "");
		movieElement.classList.add("movie");
		imgContainerElement.classList.add("imgContainer");
		overLayElement.classList.add("overlay");
		if(results.results[i].poster_path == null){
			imgElement.src = "images/notavailable.jpg"; 
		}
		else{
			imgElement.src = imageSrc + results.results[i].poster_path;
		}
		textElement.classList.add("text");
		textElement.setAttribute("id", "overlayText");
		ratingsElement.innerHTML = "Rating: " + results.results[i].vote_average + "/10.0 ";
		votesElement.innerHTML = "Votes: " + results.results[i].vote_count;
		let overview = results.results[i].overview;
		if(overview.length > 200){
			let shortOverview = overview.substr(0,200);
			shortOverview = shortOverview + "...";
			synopsisElement.innerHTML = shortOverview;
		}
		else{
			synopsisElement.innerHTML = overview;
		}
		titleElement.innerHTML = results.results[i].original_title;
		titleElement.setAttribute("id", "movieTitle");
		releaseElement.innerHTML = results.results[i].release_date;
		releaseElement.setAttribute("id", "releaseDate");

		textElement.appendChild(ratingsElement);
		textElement.appendChild(votesElement);
		textElement.appendChild(synopsisElement);
		overLayElement.appendChild(textElement);
		imgContainerElement.appendChild(imgElement);
		imgContainerElement.appendChild(overLayElement);
		movieElement.appendChild(imgContainerElement);
		movieElement.appendChild(titleElement);
		movieElement.appendChild(releaseElement);
		colElement.appendChild(movieElement);
		movierowElement.appendChild(colElement);
	}
}

window.onload = function(){
	let movieEndpoint = "https://api.themoviedb.org/3/discover/movie?api_key=67a850af465dea8afca0697f5f5c21f8&language=en-US&sort_by=popularity.desc&include_adult=false&include_video=false&page=1&primary_release_date.gte=2019-08-01&primary_release_date.lte=2019-09-26";
	ajax(movieEndpoint,displayResults);
}

document.querySelector("#search-form").onsubmit = function(event){
	event.preventDefault();
	let search = document.querySelector("#search-id").value.trim();
	if(search.length > 0){
		clearElement("#movie-row");
		let movieEndpoint = "https://api.themoviedb.org/3/search/movie?api_key=67a850af465dea8afca0697f5f5c21f8&language=en-US&query=" + search + "&include_adult=false";
		ajax(movieEndpoint, displayResults);
		document.querySelector("#inputError").innerHTML = "";
		document.querySelector("#search-id").classList.remove("is-invalid");		
	}
	else{
		document.querySelector("#inputError").innerHTML = "Please enter a search query";
		document.querySelector("#inputError").style.color = "red";
		document.querySelector("#search-id").classList.add("is-invalid");
	}
}


