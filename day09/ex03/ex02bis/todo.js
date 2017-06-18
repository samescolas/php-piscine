var $toDoList = [];

function cookieToList() {
	var $list = [];
	var $cooks = document.cookie;
	if ($cooks) {
		$.each($cooks.split(";"), function(key, val) {
			if (val.indexOf("toDoList=") >= 0) {
				val = decodeURI(val.substr(val.indexOf("toDoList=") + 9));
				$.each($(val.split(',')), function(key, val) {
					createElement(val);
				});
			}
		});
	}
}

function updateCookies() {
	var $d = new Date();
	var $expires = "";
	$d.setTime($d.getTime() + (3*24*60*60*1000));
	$expires = "expires=" + $d.toUTCString();
	document.cookie = "toDoList=" + encodeURI($toDoList.join()) + "; " + $expires + ";";
}

function createElement($label) {
	if (!$label) {
		return ;
	}
	$toDoList.push($label);
	updateCookies();
	$("#ft_list").append($('<div>').addClass('todo').append(
			$('<p>').addClass('num').html('1')).append(
			$('<h3>').addClass('title').html($label)).append(
			$('<button>').html('&#10003;')));
	adjustIDs();
	addListeners();
}

function adjustIDs() {
	$(".num").each(function(ix) {
		$(this).html(ix + 1);
	});
}

function addElement() {
	var $item = prompt("Task:", "Code");
	createElement($item);
}

function addListeners() {
	$(".todo").each(function(key, val) {
		$(this).on('click', function() {
			$(this).fadeOut(function() {
				$(this).remove();
			var $toRemove = $toDoList.indexOf($(this).find("h3").html());
			$toDoList.splice($toRemove, 1);
			updateCookies();
			adjustIDs();
			});
		});
	});
}

var main = function() {
	cookieToList();
	adjustIDs();
	addListeners();
	$("#new").on('click', function() {
		addElement();
	});
}

$( document ).ready(main);
