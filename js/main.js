jQuery(document).ready(function($) {

	$('article.post').hover(function(){
		$('a.edit-post').show();
	},function(){
		$('a.edit-post').hide();
	});

	// Prevent submission of empty form
	$('[placeholder]').parents('form').submit(function() {
		$(this).find('[placeholder]').each(function() {
			var input = $(this);
			if (input.val() == input.attr('placeholder')) {
				input.val('');
			}
		});
	});

	// bs alert
	$('.alert-message').alert();

	// bs dropdown
	$('.dropdown-toggle').dropdown();

	// Smooth scroll to element by ID
	$('a[href^="#"]:not(a[href="#"]):not(a[data-toggle="collapse"])').click(function(e) {
		e.preventDefault();

		var target = this.hash;
		var $target = $(target);

		$('html, body').stop().animate({
			'scrollTop': $target.offset().top
		}, 900, 'swing');
	});

});

// blueimp lightbox gallery
var galleries = document.getElementsByClassName('gallery');
for(var i = 0; i < galleries.length; i++) {
	var gallery = galleries[i];
	gallery.onclick = function(event) {
		event = event || window.event;
		var target = event.target || event.srcElement,
		link = target.src ? target.parentNode : target,
		options = {
			index: link,
			event: event,
			stretchImages: false,
		},
		links = this.getElementsByTagName('a');
		blueimp.Gallery(links, options);
	};
}
