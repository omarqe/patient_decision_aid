(function($){
	var doc = $(document);

	doc.on('click', '.ribbon a.dismiss', function(){
		var t = $(this), p = t.parents('.ribbon'), id = p.attr('id');
		p.remove();
	});

	window.sendAlert = function(m,y,i){
		return PDA.alert(m,y,i);
	}

	window.invoke = function(e,o){
		o = (typeof o === 'undefined') ? true : false;
		e = (typeof e === 'undefined' || !e || e == '') ? '[data-invoke]' : '[data-invoke~='+e+']';
		return o ? $(e) : e;
	}

	

	window.PDA = {
		init: function(){
			doc
			.on('mouseover click', function(){
				window.masonry = $('.masonry').masonry({
					itemSelector:'.grid-item'
				});
			})
			.on('click', invoke('next_page', false), this.nextPage)
			.on('click', invoke('prev_page', false), this.prevPage);
		},

		alert: function(m,y,i){
			if ( typeof m === 'undefined' || m == '' )
				return false;

			m = m || 'Undefined';
			var b = $('body'), c = $('#ribbon_container'),
				a = $('<div/>',{class:'ribbon animated fadeInDown'}).text(m)
					.append($('<a/>',{class:'dismiss'}).html('&times;'));

			if ( typeof y !== 'undefined' )
				a.addClass(y);

			// If there's previous ribbon, delete.
			if ( c.find('.ribbon').length > 0 )
				c.find('.ribbon').remove();

			c.append(a);
			console.log(c.length);
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