document.addEventListener("DOMContentLoaded", function(event) {

	var search = document.getElementById("search");

	search.addEventListener("keyup", function(e) {
		var first = true;
		var cats = document.getElementsByClassName("search-category");
		for (var i=0; i < cats.length; i++) {
			if ((cats[i].children[0].innerHTML.toLowerCase()).match(search.value.toLowerCase()) !== null && search.value != "")
			{
				cats[i].style.display = "block";
				if (first)
				{
					cats[i].id = "active";
					first = false;
				}
			}
			else
			{
				cats[i].style.display = "none";
				cats[i].id = "";
			}
		}
	});

	document.body.addEventListener("click", function(e) {
		if (e.currentTarget.id == "search-category-container") {
			var visible_cats = document.getElementsByClassName("search-category");
			for (var i = 0; i < visible_cats.length; i++) {
				visible_cats[i].style.display = "none";
			}
		}
	});

	document.getElementById("search-category-container").addEventListener("mouseover", function(e) {
		if (document.getElementById("active") != null)
			document.getElementById("active").id = "";
	});

	document.getElementById("search-category-container").addEventListener("mouseleave", function(e) {
		var cats = document.getElementsByClassName("search-category");
		for (var i = 0; i < cats.length; i++) {
			if (cats[i].style.display == "block") {
				cats[i].id = "active";
				break ;
			}
		}
	});

});
