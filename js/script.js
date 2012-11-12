$(document).ready(function() {
/* 
    $("#photos li a").fancybox({
        padding: 0,
        maxWidth: 1440,
        maxHeight: 810,
        aspectRatio: true,
        closeBtn: false,
        loop: false,
        prevEffect: 'none',
        nextEffect: 'none',
        afterLoad: function() {
            if(!$(this.element).hasClass('clicked')) {
                sendAction(this.element.id, 'view');
            } else {
                $(this.element).removeClass('clicked');
            }
        }
    });

    function sendAction(id, action) {
        $.ajax({
            url: root + 'clicks/' + action + ':photo=' + id
        });
    }

    function afterLoad() {
        $.each($('#photos .open'), function(i, el) {
            $(el).unbind('click').bind('click', function() {
                sendAction($(el).attr('id'), 'initial');
                $(el).addClass('clicked');
            });
        });
    }
    afterLoad();
*/


getvars=$.parseQuery(window.location);
getuser = getvars.user;
getpage = getvars.page;

if ( getuser ) {
	clearandfill(getuser);
}  else { 
	clearandfill();
}


});

function clearandfill(user1) {
if (user1) {
	arguments = "user=" + user1;
} else { 
	arguments = "";
}
$.ajax({
        type : "GET",
        url : 'json.php?' + arguments,
        dataType : "json",
        success: function(data) {
                $("#photos").empty();
                if ( data.users ) {
                        $.each(data.users, function() {
                                // $("#photos").append("<li><a id='" + this.user + "' class='open' rel='timelapse' title='" + this.user + "' onClick='clearandfill(\"" + this.url + "\")'><div class='info'>" + this.user + "</div><img src='" + this.thumb + "' class='thumb'><img src='/images/fill.gif' class='fill'></a></li>");
                                $("#photos").append("<li><a id='" + this.user + "' class='open' rel='timelapse' title='" + this.user + "' href='?user=" + this.url + "'><div class='info'>" + this.user + "</div><img src='" + this.thumb + "' class='thumb'><img src='/images/fill.gif' class='fill'></a></li>");
                        });
                } else if ( data.images ) {
                        $.each(data.images, function() {
                                $("#photos").append("<li><a id='" + this.name + "' class='open' rel='timelapse' title='" + this.title + "' href='" + this.url + "'><div class='info'>" + this.title + "</div><img src='" + this.thumb + "' class='thumb'><img src='/images/fill.gif' class='fill'></a></li>");
                        });

                }
        },
        error : function() {
                alert("Sorry, The requested property could not be found.");
        }
        });
$("#nextalink")[0].href="http://jjrosent.zrg.cc/json.php?" + arguments + "&page=2"
addscroller();
}

function addscroller() {
    if($('a.next-page').length) {
        $('#photos').infinitescroll({
            	navSelector: 'a.next-page',
            	nextSelector: 'a.next-page',
           	 itemSelector: '#photos li',
		debug: true,
		dataType: 'json',
		appendCallback: false,
            	loading: {
                	img: '/images/ajax-loader.gif',
                	finishedMsg: '',
                	msgText: ''
            	}
        },function (newElements) {
		data = $.parseJSON(newElements);
		if ( data.images ) {
			$.each(data.images, function () {
				$("#photos").append("<li><a id='" + this.name + "' class='open' rel='timelapse' title='" + this.title + "' href='" + this.url + "'><div class='info'>" + this.title + "</div><img src='" + this.thumb + "' class='thumb'><img src='/images/fill.gif' class='fill'></a></li>");
			});
		}
	});
    }
}
