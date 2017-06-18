var toDoList = [];
document.addEventListener("DOMContentLoaded", function(event) {

	cookieCreateList();
	addListRemover();

	document.getElementById("new").addEventListener("click", function(event) {
		createItem(prompt("Title", "Laundry"));
		addListRemover();
		resetIDs();
	});

});

function createItem(label) {
	if (label == "")
		return ;
	var list = document.getElementById("ft_list");

	var id = document.createElement("p");
	id.className = "num";
	id.innerHTML = "1";

	var title = document.createElement("h3");
	title.className = "title";
	title.innerHTML = label;

	var button = document.createElement("button");
	button.innerHTML = "&#10003;";

	var newItem = document.createElement("div");
	newItem.className = "todo";
	newItem.appendChild(id);
	newItem.appendChild(title);
	newItem.appendChild(button);
	list.insertBefore(newItem, list.childNodes[0]);
	toDoList.unshift(label);
	addCookie();
	resetIDs();
}

function addCookie() {
	var d = new Date();
	d.setTime(d.getTime() + (3*24*60*60*1000));
	var expires = "expires=" + d.toUTCString();
	document.cookie = "toDoList=" + encodeURI(toDoList.join()) + "; " + expires + "; path=/";
}

function cookieCreateList() {
	var c = document.cookie.split(";");
	for (i=0; i < c.length; i++) {
		if (c[i].startsWith("toDoList=") || c[i].startsWith(" toDoList=")) {
			break ;
		}
	}
	if (c[i] == undefined) {
		return ;
	}
	var list = decodeURI(c[i]).substr(9).split(",");
	for (let i=list.length - 1; i>=0; i--) {
		createItem(list[i]);
	}
	toDoList = list;
	resetIDs();
}

function resetIDs() {
	var nums = document.getElementsByClassName("num");
	for (var i=1; i<=nums.length; i++) {
		nums[i - 1].innerHTML = i;
	}
}

function addListRemover() {
	var items = document.getElementsByClassName("todo");
	for (var j=1; j<=items.length; j++) {
		items[j - 1].addEventListener("click", function(e) {
			var x = toDoList.indexOf(this.childNodes[1].innerHTML);
			this.remove();
			toDoList.splice(x, 1);
			resetIDs();
			addCookie();
		});
	}
}
