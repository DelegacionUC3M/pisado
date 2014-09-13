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

		var pisados = $('.delegacion #pisados li');

		if (this.dataset['active'] == 'false') {
			var that = $(this);
			this.dataset['active'] = true;

			pisados.addClass('vibrate');
			$.each(pisados, function() {
				$(this).on('click', function(e) {
					e.preventDefault();
					that.html('Agrupar seleccionados');

					if ( !$(this).hasClass('selected') ) {
						if ( $(this).hasClass('vibrate') ) {
							var titulacion = $(this).data('titulacion'),
								curso = $(this).data('curso');

							pisados.removeClass('vibrate');
							pisados.filter('[data-titulacion='+titulacion+'][data-curso='+curso+']:not(.selected)', pisados).addClass('vibrate');
							$(this).removeClass('vibrate').addClass('selected');
						} else {
							$('.delegacion p.info.hide').slideDown();
						}
					} else {
						$(this).removeClass('selected');

						if (pisados.filter('.selected').length > 0) {
							var titulacion = pisados.filter('.selected').data('titulacion'),
								curso = pisados.filter('.selected').data('curso');

							pisados.removeClass('vibrate');
							pisados.filter('[data-titulacion='+titulacion+'][data-curso='+curso+']:not(.selected)', pisados).addClass('vibrate');
						} else {
							pisados.addClass('vibrate');
						}
					}
				})
			})
		} else {
			var pisados = $('.delegacion #pisados li.selected');
			var form = $('<form>', {
				action: '/pisado/group/group',
				method: 'POST'
			});
			var formData = new FormData( form );

			pisados.filter('#pisado').each(function() {
				form.append($('<input>', {
					name: 'pisado[]',
					value: $(this).data('id'),
					type: 'text'
				}))				
			});

			pisados.filter('#group').each(function() {
				form.append($('<input>', {
					name: 'group[]',
					value: $(this).data('id'),
					type: 'text'
				}))	
			})

			if (pisados.filter('#group').length != 1) {
				var name = $('<input>', {
					type: 'text',
					placeholder: 'Nombre del grupo',
					name: 'name'
				});
				var submit = $('<button>', {
					value: 'Agrupar'
				});

				$(this).parent().append('<div>'+name+' '+submit+'</div>');
				$(this).hide();

				submit.on('click', function(e) {
					e.preventDefault();

					form.append(name);
					form.submit();
				})
			} else {
				form.submit();
			}

		}
	})

})
