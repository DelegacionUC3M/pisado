$(function() {

	$('a#print').on('click', function(e) {
		e.preventDefault();

		if ( $('#dpersonales ul').length > 0 && !confirm('¿Incluir datos personales del autor?')) {
			$('#dpersonales').hide();
		}

		if ( $('#comentarios li').length > 1 && !confirm('¿Incluir comentarios?')) {
			$('#comentarios').hide();
		}

		window.print();

		$('#dpersonales, #comentarios').show();
	})

	$('section#panel a#agrupar').on('click', function(e) {
		e.preventDefault();

	})

})
