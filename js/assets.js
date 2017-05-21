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

	$.fn.shakeIt = function(){
		var t = $(t);
		if ( t.hasClass('animated shake') )
			t.removeClass('animated shake');

		t.addClass('animated shake');
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
			.on('click', invoke('choose_stage', false), this.chooseStage)
			.on('submit', invoke('choose_worry', false), this.chooseWorry)
			.on('submit', invoke('concern', false), this.concern)
			.on('submit', invoke('begin', false), this.begin);
		},

		getUnique: function(b){
			return Object.id(b);
		},

		chooseStage: function(e){
			e.preventDefault();
			var t = $(this), s = t.data('stage');

			$.get(getAction(), {stage:s,action:'choose_stage'}, function(o){
				respondAJAX(o);

				if ( typeof o.status !== 'undefined' &&  o.status == true ){
					PDA.goToPage(t, 'next');
					return true;
				}
			}, 'JSON', true)
			.fail(function(e){ console.error(e.responseText) });
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
			var t = $(this), d = t.serialize(), c = $('#worry_answers');

			if ( t.isBlocked() )
				return false;

			t.block();
			$.post(getAction(), d, function(o){
				var s = o.status || false;
				respondAJAX(o);

				c.block();
				if ( s && typeof o.worry_answers !== 'undefined' ){
					PDA.goToPage(t,'next');

					c.html(''); // Clear the previous state.

					if ( o.worry_answers.length > 0 ){
						$.each(o.worry_answers, function(i,w){
							c.append(
								$('<tr/>')
								.append($('<td/>',{class:'enquiry'}).text(w.worry))
								.append($('<td/>').text(w.lumpectomy))
								.append($('<td/>').text(w.mastectomy))
								.append($('<td/>').text(w.alternative))
								.append($('<td/>').text(w.none))
							);
						});
					} else {
						c.append(
							$('<tr/>')
							.append(
								$('<td/>', {colspan:5,style:'text-align:center'})
								.append( $('<p/>').text('Nothing to compare. Please go back to the previous page and try again.') )
								.append(
									$('<div/>', {class:'btn-action',style:'margin-top:10px'})
									.append( $('<a/>',{class:'btn btn-dark btn-xs','data-invoke':'prev_page'}).html('&larr; Previous') )
								)
							)
						)
					}
				}
				c.unblock();
			}, 'JSON', true)
			.fail(function(e){ sendAlert(e.responseText,'red'); });
			t.unblock();
		},

		concern: function(e){
			e.preventDefault();
			var t = $(this), d = t.serialize();
			
			$.post(getAction(), d, function(o){
				var s = o.status || false;
				respondAJAX(o);

				if ( typeof o.empties !== 'undefined' ){
					$.each(o.empties, function(i,x){
						// var l = x.data('required');
						var x = $('input[name='+x+']'), l = x.data('required');
							l = $('[data-label_required='+l+']');

						l.addClass('red');
						x.on('change', function(){
							if ( x.val() !== '' ) l.removeClass('red');
						});
					});
				}

				if ( s ) PDA.goToPage(t, 'next');
			}, 'JSON', true)
			.fail(function(e){sendAlert(e.responseText, 'red')});
		},

		bindValue: function(b,v,c){ // bind_id, value, container
			var k = '[data-bind='+b+']', s;

			if ( typeof c !== 'undefined' ){
				c = c instanceof jQuery ? c : $(c);
				s = c.find(k);
			} else {
				s = $(k);
			}

			s.each(function(){
				var t = $(this), o = t.text();
				if ( typeof v === 'string' && v.length > 0 || typeof v !== 'string' )
					!t.is('input,select,textarea') ? t.html(v) : t.val(v);
			});
		},

		bindTo: function(b,v,c){
			this.bindValue(b,v,c);
		},

		begin: function(e){
			e.preventDefault();

			var t = $(this), d = parseQuery(t.serialize());

			d.action = 'begin';
			$.post(getAction(), d, function(o){
				var s = o.status || false;
				respondAJAX(o);

				if ( typeof o.shake !== 'undefined' ){
					var x = $(o.shake);
					if ( x.hasClass('animated shake') )
						x.removeClass('animated shake');

					// Allow 100 milliseconds for the script to totally remove the shake class.
					setTimeout(function(){
						x.addClass('animated shake');
					}, 100);
				}

				if ( s ){
					PDA.goToPage(t, 'next');
					t.find('.animated').removeClass('animated shake');
					PDA.bindTo('nickname', d.nickname);
				}
			}, 'JSON', true)
			.fail(function(e){ console.error(e.responseText) });
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