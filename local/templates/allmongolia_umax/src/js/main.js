// (function() {
//     var origOpen = XMLHttpRequest.prototype.open;
//     XMLHttpRequest.prototype.open = function() {
//         console.log('request started!');
//         this.addEventListener('load', function() {
//             console.log('request completed!');
//             console.log(this.readyState); //will always be 4 (ajax is completed successfully)
//             console.log(this.responseText); //whatever the response was
//             console.log(this);
//         });
//         origOpen.apply(this, arguments);
//     };
// })();

document.addEventListener('DOMContentLoaded', function () {
    lozadInit();
})

window.lozadInit = () => {
    let lozad = require('lozad');

    const observer = lozad('.lozad', {
        threshold: 0.4,
        enableAutoReload: true
    });
    observer.observe();
}

number_format = function ( number, decimals, dec_point, thousands_sep ) {
	var i, j, kw, kd, km;

	if( isNaN(decimals = Math.abs(decimals)) ){
		decimals = 2;
	}
	if( dec_point == undefined ){
		dec_point = ",";
	}
	if( thousands_sep == undefined ){
		thousands_sep = ".";
	}

	i = parseInt(number = (+number || 0).toFixed(decimals)) + "";

	if( (j = i.length) > 3 ){
		j = j % 3;
	} else{
		j = 0;
	}

	km = (j ? i.substr(0, j) + thousands_sep : "");
	kw = i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thousands_sep);
	kd = (decimals ? dec_point + Math.abs(number - i).toFixed(decimals).replace(/-/, 0).slice(2) : "");

	return km + kw + kd;
}
