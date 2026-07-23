(function ($) {
	'use strict';

	$(function () {
		var frame;
		var $select = $('#ppf-hero-photo-select');
		var $remove = $('#ppf-hero-photo-remove');
		var $input = $('#hero_photo_id');
		var $preview = $('#ppf-hero-photo-preview');

		if (!$select.length) {
			return;
		}

		$select.on('click', function (event) {
			event.preventDefault();

			if (frame) {
				frame.open();
				return;
			}

			frame = wp.media({
				title: 'Selecionar imagem do hero',
				button: { text: 'Usar esta imagem' },
				multiple: false,
			});

			frame.on('select', function () {
				var attachment = frame.state().get('selection').first().toJSON();
				$input.val(attachment.id);
				$preview.html('<img src="' + attachment.url + '" style="max-width:300px;height:auto;" />');
			});

			frame.open();
		});

		$remove.on('click', function (event) {
			event.preventDefault();
			$input.val('');
			$preview.empty();
		});
	});
})(jQuery);
