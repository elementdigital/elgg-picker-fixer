/*
elgg friendsPicker plugin
* adapted from Niall Doherty's excellent Coda-Slider - http://www.ndoherty.com/coda-slider

elgg friends picker fixes plugin
* adapted from elgg(unknow author), adapted from Niall Doherty's Coda-Slider.

Modified by: B.Pontius (ElementDigital)
* Makes elgg friends picker responsive 
* Added: $( window ).resize();
* Added animation stop();
*/

jQuery.fn.friendsPicker = function(iterator) {

	var settings; 
	settings = $.extend({ easeFunc: "easeOutExpo", easeTime: 1000, toolTip: false }, settings);
	
	//var wrapSelector = ".friends-picker";
	var wrapSelector = $(this).closest('form');
	if(wrapSelector.attr('class') != null){
		var wrapSelector = "."+wrapSelector.attr('class').replace(" ",".");
	}else{
		var wrapSelector = "#"+wrapSelector.attr('id');
	}
	
	return $(this).each(function() {
		
		var container = $(this);
		container.addClass("friends-picker");
		
		var panelWidth = $(wrapSelector).width();

		$('.friends-picker-wrapper').width(panelWidth);
		$('.friends-picker').width(panelWidth);
		$('.friends-picker .friends-picker-container .panel').width(panelWidth);

		// count the panels in the container
		var panelCount = container.find("div.panel").size();
		
		// calculate the width of all the panels lined up end-to-end
		var friendsPicker_containerWidth = panelWidth*panelCount;
		
		// specify width for the friendsPicker_container
		container.find("div.friends-picker-container").css("width" , friendsPicker_containerWidth);

		// global variables for container.each
		var distanceToMoveFriendsPicker_container;
		var friendsPickerNavigationWidth = 0;
		var currentPanel = 1;

		// generate appropriate nav for each container
		container.each(function(i) {
			// generate Left and Right arrows
			
			//$(this).before("<div class='friends-picker-navigation-l' id='friends-picker-navigation-l" + iterator + "'><a href='#'>Left</a><\/div>");
			$(this).append("<div class='friends-picker-navigation-l' id='friends-picker-navigation-l" + iterator + "'><a href='#'>Left</a><\/div>");
			
			//$(this).after("<div class='friends-picker-navigation-r' id='friends-picker-navigation-r" + iterator + "'><a href='#'>Right</a><\/div>");
			$(this).append("<div class='friends-picker-navigation-r' id='friends-picker-navigation-r" + iterator + "'><a href='#'>Right</a><\/div>");

			// generate a-z tabs
			$(this).before("<div class='friends-picker-navigation clearfix' id='friends-picker-navigation" + iterator + "'><ul><\/ul><\/div>");
			$(this).find("div.panel").each(function(individualTabItemNumber) {
				$("div#friends-picker-navigation" + iterator + " ul").append("<li class='tab" + (individualTabItemNumber+1) + "'><a href='#" + (individualTabItemNumber+1) + "'>" + $(this).attr("title") + "<\/a><\/li>");		
			});

			// tabs navigation
			$("div#friends-picker-navigation" + iterator + " a").each(function(individualTabItemNumber) {
				// calc friendsPickerNavigationWidth by summing width of each li
				friendsPickerNavigationWidth += $(this).parent().width();
				
				// set-up individual tab clicks
				$(this).bind("click", function() {
					var panelWidth = $(wrapSelector).width();
					$(this).addClass("current").parent().parent().find("a").not($(this)).removeClass("current"); 
					distanceToMoveFriendsPicker_container = - (panelWidth*individualTabItemNumber);
					currentPanel = individualTabItemNumber + 1;
					$(this).parent().parent().parent().next().find("div.friends-picker-container").stop(true,true).animate({ left: distanceToMoveFriendsPicker_container}, settings.easeTime, settings.easeFunc);
				});
			});

			// Right arow click function
			$("div#friends-picker-navigation-r" + iterator + " a").click(function() {
				var panelWidth = $(wrapSelector).width();
				var thissel = "div#friends-picker-navigation"+iterator;
				if (currentPanel == panelCount) { 
					distanceToMoveFriendsPicker_container = 0;
					currentPanel = 1; 
					$(thissel).find("a.current").removeClass("current").parentsUntil('div.friends-picker-navigation').find("a:eq(0)").addClass("current");
				} else { 
					distanceToMoveFriendsPicker_container = - (panelWidth*currentPanel);
					currentPanel += 1;
					$(thissel).find("a.current").removeClass("current").parent().next().find("a").addClass("current");
				};
				$(this).parent().parent().find("div.friends-picker-container").stop(true,true).animate({ left: distanceToMoveFriendsPicker_container}, settings.easeTime, settings.easeFunc);
				return false;
			});

			// Left arrow click function
			$("div#friends-picker-navigation-l" + iterator + " a").click(function() {
				var panelWidth = $(wrapSelector).width();
				var thissel = "div#friends-picker-navigation"+iterator;
				if (currentPanel == 1) { 
					distanceToMoveFriendsPicker_container = - (panelWidth*(panelCount - 1));
					currentPanel = panelCount;
					$(thissel).find("a.current").removeClass("current").parentsUntil('div.friends-picker-navigation').find("li:last a").addClass("current");
				} else { 
					currentPanel -= 1;
					distanceToMoveFriendsPicker_container = - (panelWidth*(currentPanel - 1));
					$(thissel).find("a.current").removeClass("current").parent().prev().find("a").addClass("current");
				};
				$(this).parent().parent().find("div.friends-picker-container").stop(true,true).animate({ left: distanceToMoveFriendsPicker_container}, settings.easeTime, settings.easeFunc);
				return false;
			});
			
			//cancel button
			$(".elgg-button.elgg-button-cancel").click(function(e) {
				var colid = $(this).closest('.collection').attr('id');
				collectionid = colid.split("-")
				$('a.collectionmembers'+collectionid[1]).click();
			});

			$( window ).resize(function() {
				
				var panelWidth = $(wrapSelector).width();

				var panelCount = $('.friends-picker').find("div.panel").size();

				$('.friends-picker').width(panelWidth);
				
				$('.friends-picker-wrapper').width(panelWidth);
				$('.friends-picker .friends-picker-container .panel').width(panelWidth);

				var friendsPicker_containerWidth = panelWidth*panelCount;
				$('.friends-picker .friends-picker-container').width(friendsPicker_containerWidth);

				var newpwidth = $('.friends-picker').find("div.panel").width();
				var distanceToMoveFriendsPicker_container = - (newpwidth*(currentPanel-1));

				$("div.friends-picker-container").css({ left: distanceToMoveFriendsPicker_container});
				
			});

			// apply 'current' class to currently selected tab link
			$('.friends-picker-container .panel').show();
			$("div#friends-picker-navigation" + iterator + " a:eq(0)").addClass("current");
		});
		
	});
};