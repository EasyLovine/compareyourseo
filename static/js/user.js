$(document).ready(function() {
  $('button.add-champ').click(popupAddChamp);
  $("td.editChamp a").click(popupEditChamp);
  $("td.delChamp a").click(popupDelChamp);

  $("button.addKeyword").click(popupAddKeyword);
  $("td.editKeyword").click(popupEditKeyword);
  $("td.delKeyword").click(popupDelKeyword);

  $("button.addSite").click(popupAddSite);
  $("td.editSite a").click(popupEditSite);
  $("td.delSite a").click(popupDelSite);

  $("button.addSiteChamp").click(popupAddSiteChamp);
  $("td.delSiteChamp a").click(popupDelSiteChamp);


  $("p.chooseChamp select").change(function(){
  	var id = $("option:selected", this).attr("id_champ");
  	window.location = "/user/keywords/"+id;
  });

  $("p.chooseSite select").change(function(){
  	var id = $("option:selected", this).attr("id_site");
  	window.location = "/user/gestion/"+id;
  });

  $("span.close_overlay").click(function(){
	$(this).parent().parent().hide();
  });
});

function showOverlay(sel){
	var overlay = $(sel);
	overlay.show();
	centerDiv(sel +" div.overlay-content");
	overlay.click(function(){
		overlay.hide();
	}).children().click(function(e){
		return false;
	});
}

function closeOverlay(sel){
	restoreInput(sel);
	$(sel).hide();
}

function clearOverlayInput(sel){
 	$(sel + " input[title]").each(function(){
 		$(this).click(function(){
 			if($(this).attr("title") == $(this).val())
 			$(this).val("");
 		});
 	});
}

function restoreInput(sel){
	$(sel + " input[title]").each(function(){
 		$(this).val($(this).attr("title"));
 	});
}

function centerDiv(sel){
	$(sel).css({
        position:'absolute',
        left: ($(window).width() - $(sel).outerWidth())/2,
        top: ($(window).height() - $(sel).outerHeight())/2
    });
}

function url(txt){
	var urlPattern = /(http|ftp|https):\/\/[\w-]+(\.[\w-]+)+([\w.,@?^=%&amp;:\/~+#-]*[\w@?^=%&amp;\/~+#-])?/;
	return urlPattern.test(txt);
}

function setOverlayTitle(elem, overlay){
	var setTitle = $(overlay + " h1 strong");
	var title = $("td.important_data", $(elem).parent().parent().parent()).html();
	setTitle.html(title);
}

function setOverlayinputTitle(elem, overlay){
	var setTitle = $(overlay + " input");
	var title = $("td.important_data", $(elem).parent().parent().parent()).html();
	setTitle.val(title);
}

function popupAddChamp(event){
	var overlay = "div.addChamp";
	showOverlay(overlay);
	clearOverlayInput(overlay);
	var closeButton = $(overlay + " button.save-data");
	closeButton.unbind("click");
	closeButton.click(function(){
		var champ = $(overlay + " input[name=champName]");
		var datas = {};
		datas["action"]="addChamp";
		datas["name"]=champ.val();
		if(champ.val() && champ.val()!=champ.attr("title")){
			var request = $.ajax({
				url: "/ajax.php",
				type: "POST",
				data: datas,
				dataType: "json"
		  	});
			request.done(function(data){
				closeOverlay(overlay);
				window.location = "/user/champs";
			});
	}
	else
		closeOverlay(overlay);
	});
}


function popupEditChamp(event){
	var overlay = "div.editChamp";
	showOverlay(overlay);
	setOverlayinputTitle(event.target, overlay);
	var closeButton = $(overlay + " button.save-data");
	closeButton.unbind("click");
	closeButton.click(function(){
		var champ = $(overlay + " input[name=champName]");
		var datas = {};
		datas["action"]="editChamp";
		datas["name"]=champ.val();
		datas["id_champ"] = $(event.currentTarget).attr("id_champ");
		if(champ.val()){
		var request = $.ajax({
			url: "/ajax.php",
			type: "POST",
			data: datas,
			dataType: "json"
	  	});
		request.done(function(data){
			closeOverlay(overlay);
			window.location = "/user/champs";
		});
	}
	else
		closeOverlay(overlay);
	});
}

function popupDelChamp(event){
	var overlay = "div.delChamp";
	showOverlay(overlay);
	$(overlay + " h1 strong").html($("td.important_data", $(event.currentTarget).parent().parent()).html());
	var closeButton = $(overlay + " button.save-data");
	closeButton.unbind("click");
	closeButton.click(function(){
		var datas = {};
		datas["action"]="delChamp";
		datas["id_champ"] = $(event.currentTarget).attr("id_champ");
		var request = $.ajax({
			url: "/ajax.php",
			type: "POST",
			data: datas,
			dataType: "json"
	  	});
		request.done(function(data){
			closeOverlay(overlay);
			window.location = "/user/champs";
		});
	});
}

function popupAddKeyword(event){
	var overlay = "div.addKeyword";
	showOverlay(overlay);
	clearOverlayInput(overlay);
	var closeButton = $(overlay + " button.save-data");
	closeButton.unbind("click");
	closeButton.click(function(){
		var champ = $(overlay + " input[name=keywordName]");
		var datas = {};
		datas["action"]="addKeyword";
		datas["name"]=champ.val();
		datas["id_champ"] = $("option:selected", "p.chooseChamp select").attr("id_champ");
		datas["pond"] = $(overlay + " select").val();
		if(champ.val() && champ.val()!=champ.attr("title")){
			var request = $.ajax({
				url: "/ajax.php",
				type: "POST",
				data: datas,
				dataType: "json"
		  	});
			request.done(function(data){
				closeOverlay(overlay);
				location.reload();
			});
		}
		else
			closeOverlay(overlay);
	});
}

function popupEditKeyword(event){
	var overlay = "div.editKeyword";
	showOverlay(overlay);
	$(overlay + " h1 strong").html($("td.important_data", $(event.currentTarget).parent()).html());
	$(overlay + " input").val($(overlay + " h1 strong").html());
	$(overlay + " select").val($(event.currentTarget).parent().children().eq(1).html());
	var closeButton = $(overlay + " button.save-data");
	closeButton.unbind("click");
	closeButton.click(function(){
		var champ = $(overlay + " input[name=keywordName]");
		var datas = {};
		datas["action"]="editKeyword";
		datas["name"]=champ.val();
		datas["id_keyword"] = $("a", event.currentTarget).attr("id_expression");
		datas["pond"] = $(overlay + " select").val();
		if(champ.val()){
			var request = $.ajax({
				url: "/ajax.php",
				type: "POST",
				data: datas,
				dataType: "json"
		  	});
			request.done(function(data){
				closeOverlay(overlay);
				location.reload();
			});
		}
		else
			closeOverlay(overlay);
	});
}

function popupDelKeyword(event){
	var overlay = "div.delKeyword";
	showOverlay(overlay);
	$(overlay + " h1 strong").html($("td.important_data", $(event.currentTarget).parent()).html());
	var closeButton = $(overlay + " button.save-data");
	closeButton.unbind("click");
	closeButton.click(function(){
		var datas = {};
		datas["action"]="delKeyword";
		datas["id_keyword"] = $("a", event.currentTarget).attr("id_expression");
		var request = $.ajax({
			url: "/ajax.php",
			type: "POST",
			data: datas,
			dataType: "json"
	  	});
		request.done(function(data){
			closeOverlay(overlay);
			location.reload();
		});
	});
}

function popupAddSite(event){
	var overlay = "div.addSite";
	showOverlay(overlay);
	clearOverlayInput(overlay);
	var closeButton = $(overlay + " button.save-data");
	closeButton.unbind("click");
	closeButton.click(function(){
		var champ = $(overlay + " input[name=siteName]");
		var urlChamp = $(overlay + " input[name=url]");
		var datas = {};
		datas["action"]="addSite";
		datas["name"]=champ.val();
		datas["url"]=urlChamp.val();
		if(champ.val() && champ.val()!=champ.attr("title")){
			if(url(datas["url"])){
				var request = $.ajax({
					url: "/ajax.php",
					type: "POST",
					data: datas,
					dataType: "json"
			  	});
				request.done(function(data){
					closeOverlay(overlay);
					location.reload();
				});
			}
			else
				urlChamp.val("URL incorrect !");
		}
		else
			closeOverlay(overlay);
		});
}

function popupEditSite(event){
	var overlay = "div.editSite";
	showOverlay(overlay);
	$(overlay + " h1 strong").html($("td.important_data", $(event.currentTarget).parent().parent()).html());
	$(overlay + " input[name=siteName]").val($(overlay + " h1 strong").html());
	$(overlay + " input[name=url]").val($(event.currentTarget).parent().parent().children().eq(1).children().html());
	var closeButton = $(overlay + " button.save-data");
	closeButton.unbind("click");
	closeButton.click(function(){
		var champ = $(overlay + " input[name=siteName]");
		var urlChamp = $(overlay + " input[name=url]");
		var datas = {};
		datas["action"]="editSite";
		datas["name"]=champ.val();
		datas["url"]=urlChamp.val();
		datas["id_site"] = $(event.currentTarget).attr("id_site");
		if(champ.val()){
			if(url(datas["url"])){
				var request = $.ajax({
					url: "/ajax.php",
					type: "POST",
					data: datas,
					dataType: "json"
			  	});
				request.done(function(data){
					closeOverlay(overlay);
					location.reload();
				});
			}
			else
				urlChamp.val("URL incorrect !");
		}
		else
			closeOverlay(overlay);
	});
}

function popupDelSite(event){
	var overlay = "div.delSite";
	showOverlay(overlay);
	$(overlay + " h1 strong").html($("td.important_data", $(event.currentTarget).parent().parent()).html());
	var closeButton = $(overlay + " button.save-data");
	closeButton.unbind("click");
	closeButton.click(function(){
		var datas = {};
		datas["action"]="delSite";
		datas["id_site"] = $(event.currentTarget).attr("id_site");
		var request = $.ajax({
			url: "/ajax.php",
			type: "POST",
			data: datas,
			dataType: "json"
	  	});
		request.done(function(data){
			closeOverlay(overlay);
			location.reload();
		});
	});
}

function popupDelSiteChamp(event){
	var overlay = "div.delSiteChamp";
	showOverlay(overlay);
	$(overlay + " h1 strong").first().html($("p.chooseSite label").html());
	$(overlay + " h1 strong").eq(1).html($(event.currentTarget).parent().parent().children().eq(0).html());
	var closeButton = $(overlay + " button.save-data");
	closeButton.unbind("click");
	closeButton.click(function(){
		var datas = {};
		datas["action"]="delSiteChamp";
		datas["id_champ"] = $(event.currentTarget).attr("id_champ");
		datas["id_site"] = $("p.chooseSite select option:selected").attr("id_site");
		var request = $.ajax({
			url: "/ajax.php",
			type: "POST",
			data: datas,
			dataType: "json"
	  	});
		request.done(function(data){
			closeOverlay(overlay);
			location.reload();
		});
	});
}

function popupAddSiteChamp(event){
	var overlay = "div.addSiteChamp";
	var datas = {};
	var select = $(overlay + " select");
	var info = $(overlay + " div.empty-user-data");
	var closeButton = $(overlay + " button.save-data");
	
	closeButton.html("Ajouter le champ sémantique");
	info.hide();
	select.parent().show();
	select.html("");
	select.append("<option></option>");
	showOverlay(overlay);
	datas["action"] = "getNotAssignedChamps";
	datas["id_site"] = $("p.chooseSite select option:selected").attr("id_site");
	var request = $.ajax({
		url: "/ajax.php",
			type: "POST",
		data: datas,
		dataType: "json"
	});
	request.done(function(data){
		if(!jQuery.isEmptyObject(data)){
			for(var key in data){
				select.append('<option id_champ="'+data[key].id_champ+'">'+data[key].nom_champ+'</option>')
			}
		}
		else{
			closeButton.html("Fermer");
			select.parent().hide();
			info.show();
		}
	});

	closeButton.unbind("click");
	closeButton.click(function(){
		datas["action"] = "addSiteChamp";
		datas["id_champ"] = $("option:selected", select).attr("id_champ");
		if(datas["id_champ"]){
			var request = $.ajax({
				url: "/ajax.php",
				type: "POST",
				data: datas,
				dataType: "json"
		  	});
			request.done(function(data){
				closeOverlay(overlay);
				location.reload();
			});
		}
		else
			closeOverlay(overlay);
	});
}
