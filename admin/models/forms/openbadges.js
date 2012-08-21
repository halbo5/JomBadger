window.addEvent('domready', function() {
	document.formvalidator.setHandler('charsmax',
		function (value) {
			regex=/^.{1,128}$/;
			return regex.test(value);
	});
	document.formvalidator.setHandler('date',
			function (value) {
				regex=/^(\d{4}[\/\-](0?[0-9]|1[012])[\/\-](0?[0-9]|[12][0-9]|3[01]))*$/;
				return regex.test(value);
		});
});

