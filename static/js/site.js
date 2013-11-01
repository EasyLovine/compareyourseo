$(document).ready(function() {
	$("input[name=pw]").each(function(){
 		$(this).one("click", function(){
 			$(this).val("");
 			$(this).attr("type", "password");
 			$(this).unbind("focus");
 		});
 		$(this).one("focus", function(){
 			$(this).val("");
 			$(this).attr("type", "password");
 			$(this).unbind("click");
 		});
 	});

 	$("input[name=email]").each(function(){
 		clearInput($(this));
 	});
	$("input.exp").each(function(){
		clearInput($(this));
	});
});

function clearInput(elem){
	elem.one("click", function(){
 		$(this).val("");
 		$(this).unbind("focus");
 	});
 	elem.one("focus", function(){
 		$(this).val("");
 		$(this).unbind("click");
 	});
}
