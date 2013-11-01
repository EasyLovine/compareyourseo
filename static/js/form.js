$(document).ready(function() {
	clearInputs($("input[title]"));
	verifInscription();
	$("input.pw").each(function(){
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
});

function clearInputs(elems, fun){
 	elems.each(function(){
 		$(this).one("click", function(){
 			$(this).val("");
 			$(this).unbind("focus");
 		});
 		$(this).one("focus", function(){
 			$(this).val("");
 			$(this).unbind("click");
 		});
 	});
}

function verifInscription(){
	var register = $("input.register-submit");
	var name = $("input[name=nom]");
	var prenom = $("input[name=prenom]");
	var phone = $("input[name=phone]");
	var mail = $("input[name=mail]");
	var pCgu = $("p.cgu");
	register.click(function(event){
		event.preventDefault();
		var click = true;
		click = checkEmptyInput(name) && click; 
		click = checkEmptyInput(prenom) && click; 
		click = checkEmptyInput(phone) && click;
		click = checkEmptyInput(mail) && checkEmail(mail) && click;
		click = verifPw() && click;
		if(!$("input[name=cgu]").is(":checked")){
			pCgu.addClass("empty");
			click = click && false;
		}
		else
		{
			pCgu.removeClass("empty");
		}

		if(click){
			register.unbind("click");
			register.trigger("click");
		}
	});
}

function checkEmptyInput(elem){
	if(!elem.val() || elem.val() == elem.attr("title")){
		elem.addClass("empty");
		return false;
	}
	else{
		elem.removeClass("empty");
		return true;
	}
}

function checkEmail(elem){
	var pattern = /^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i;
	if(!pattern.test(elem.val())){
		elem.addClass("empty");
		return false;
	}
	else{
		elem.removeClass("empty");
		return true;
	}
}

function verifPw(){
	var mdp1 = $("input[name=mdp1]");
	var mdp2 = $("input[name=mdp2]");
	if(mdp1.val() == mdp2.val() && mdp1.val().length > 6){
		mdp1.removeClass("empty");
		mdp2.removeClass("empty");
		return true;
	}
	else{
		mdp1.addClass("empty");
		mdp2.addClass("empty");
		return false;
	}
}