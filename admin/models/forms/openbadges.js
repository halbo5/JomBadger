window.addEvent('domready', function() {
	document.formvalidator.setHandler('charsmax128',
		function (value) {
			regex=/^.{1,128}$/;
			return regex.test(value);
	});
	document.formvalidator.setHandler('charsmax150',
			function (value) {
				regex=/^.{1,150}$/;
				return regex.test(value);
		});
	document.formvalidator.setHandler('charsmax255',
			function (value) {
				regex=/^.{1,255}$/;
				return regex.test(value);
		});
	document.formvalidator.setHandler('date',
			function (value) {
				regex=/^(\d{4}[\/\-](0?[0-9]|1[012])[\/\-](0?[0-9]|[12][0-9]|3[01]))*$/;
				return regex.test(value);
		});
});

