(function($){
	if ( typeof Object.id == "undefined" ) {
		var id = 0;

		Object.id = function(o) {
			if ( typeof o.__uniqueid == "undefined" ) {
				Object.defineProperty(o, "__uniqueid", {
					value: ++id,
					enumerable: false,
					// This could go either way, depending on your 
					// interpretation of what an "id" is
					writable: false
				});
			}

			return o.__uniqueid;
		};
	}

	var doc = $(document);
	doc.on('click', '.ribbon a.dismiss', function(){
		var t = $(this), p = t.parents('.ribbon'), id = p.attr('id');
		p.remove();
	});

	window.sendAlert = function(m,y,i){
		return PDA.alert(m,y,i);
	}

	window.respondAJAX = function(o){
		if ( typeof o.message === 'undefined' )
			return false;

		var m = o.message, c = o.color || 'blue';
		PDA.alert(m,c,7000); // Message hides in 5 seconds
	}

	window.invoke = function(e,o){
		o = (typeof o === 'undefined') ? true : false;
		e = (typeof e === 'undefined' || !e || e == '') ? '[data-invoke]' : '[data-invoke~='+e+']';
		return o ? $(e) : e;
	}

	window.parseQueryString = function( string ){
		var obj = {}, b = string.split('&');
		for ( i in b ){
			var kv = b[i].split('=');

			obj[decodeURIComponent(kv[0])] = decodeURIComponent(kv[1]);
		}

		return obj;
	}

	window.parseQuery = function( s ){
		return parseQueryString(s);
	}

	window.getAction = function(){
		return window.location.pathname;
	}

	$.fn.block = function( b, d ){
		var t = $(this);
		PDA.block( t, b, d );
	}

	$.fn.unblock = function(){
		var t = $(this);
		PDA.unblock(t);
	}

	$.fn.isBlocked = function(){
		return PDA.isblocked($(this));
	}

	window.PDA = {
		blocked:[],
		init: function(){
			doc
			.on('mouseover click', function(){
				window.masonry = $('.masonry').masonry({
					itemSelector:'.grid-item'
				});
			})
			.on('click', invoke('next_page', false), this.nextPage)
			.on('click', invoke('prev_page', false), this.prevPage)
			.on('submit', invoke('choose_worry', false), this.chooseWorry);
		},

		getUnique: function(b){
			return Object.id(b);
		},

		block: function( element, template, data ){
			element = element instanceof jQuery ? element : $(element);

			var overlay = $('<div/>', {class:'white-overlay'}), loadingtmpl, content, circle = '';
			overlay.appendTo(element)

			loadingtmpl = $('<div/>', {class:'content border-rounded', style:'background:(255,255,255,.8)'});
			$('<div/>', {class:'loader'}).appendTo(loadingtmpl);

			if ( template ) content = template;
			else if ( template == false ) content = '';
			else content = loadingtmpl;

			$(content).appendTo(overlay);

			PDA.blocked.push( PDA.getUnique(element) );
		},

		unblock: function( element ){
			element = element instanceof jQuery ? element : $(element);

			element.css('position', 'relative');

			element.find('.white-overlay').hide(0, function(){
				$(this).remove();
			});

			var list = PDA.blocked, i = list.indexOf(PDA.getUnique(element));

			// Remove element from the blocked list
			PDA.blocked.splice(i);
		},

		isblocked: function( element ){
			element = element instanceof jQuery ? element : $(element);

			var exists = element.find('.white-overlay').length, b = PDA.blocked;
			if ( exists )
				return true;

			if (b.length === 0)
				return false;

			return $.inArray(PDA.getUnique(element), PDA.blocked);
		},

		isBlocked: function( element ){
			return this.isblocked(element);
		},

		chooseWorry: function(e){
			e.preventDefault();
			var t = $(this), d = t.serialize(), b = t.find('button.btn-submit'), c = $('#worry_answers');

			if ( t.isBlocked() )
				return false;

			t.block();
			$.post(getAction(), d, function(o){
				var s = o.status || false;
				respondAJAX(o);

				c.block();
				if ( s && typeof o.worry_answers !== 'undefined' ){
					PDA.goToPage(b,'next');

					c.html(''); // Clear the previous state.

					$.each(o.worry_answers, function(i,w){
						c.append(
							$('<tr/>')
							.append($('<td/>').text(w.worry))
							.append($('<td/>').text(w.lumpectomy))
							.append($('<td/>').text(w.mastectomy))
							.append($('<td/>').text(w.alternative))
							.append($('<td/>').text(w.none))
						);
					});
				}
				c.unblock();
			}, 'JSON', true)
			.fail(function(e){ sendAlert(e.responseText,'red'); });
			t.unblock();
		},

		alert: function(m,y,i){
			if ( typeof m === 'undefined' || m == '' )
				return false;

			m = m || 'Undefined';
			var b = $('body'), c = $('#ribbon_container'),
				a = $('<div/>',{class:'ribbon animated fadeInDown'}).html(m)
					.append($('<a/>',{class:'dismiss'}).html('&times;'));

			if ( typeof y !== 'undefined' )
				a.addClass(y);

			// If there's previous ribbon, delete.
			if ( c.find('.ribbon').length > 0 )
				c.find('.ribbon').remove();

			c.stop().append(a);

			// More than 1sec
			if ( typeof i !== 'undefined' && i > 1000 ){
				setTimeout(function(){
					c.find('.ribbon').addClass('animated fadeOutUp');
					if ( c.find('.ribbon').css('opacity') == 0 )
						c.find('.ribbon').remove();
				}, i);
			}

			return true;
		},

		goToPage: function(t,g){
			var t = t instanceof jQuery ? t : $(t), p = t.parents('section'), n = p.next('section'), fx = t.data('anim');
			if ( typeof g !== 'undefined' && g === 'prev' )
				n = p.prev('section');

			if ( n.length < 1 ){
				sendAlert("Sorry, there is an error occured. Please try again.", "red");
				return false;
			}

			doc.trigger('click');

			fx = fx || 'fadeIn';
			p.removeClass('active').hide();
			n.addClass('active').show().find('.section-container > .content, .main-overlay > .content').addClass('animated ' + fx);
		},

		nextPage: function(e){
			e.preventDefault();
			PDA.goToPage($(this), 'next');
		},

		prevPage: function(e){
			e.preventDefault();
			PDA.goToPage($(this), 'prev');
		}
	}

	PDA.init();
})(jQuery);