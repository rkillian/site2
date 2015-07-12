window.addEvent('domready', function() {
var myAccordion = new Accordion($('footermenu'), '#footermenu h2', '#footermenu .content', {
opacity:true,
display: -1,
duration: 300,
alwaysHide: true,

		onActive: function(menuheader, menucontent){
			menuheader.setStyle('font-weight', 'normal');
		},
		onBackground: function(menuheader, menucontent){
			menuheader.setStyle('font-weight', 'normal');
		}
});
});