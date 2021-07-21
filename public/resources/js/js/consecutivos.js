$(document).ready(function() {
	URL = URI() + "/controller/consecutivos.php";
    ACTION = 3;
    Ajax(URL, ACTION, null, function(response) {
        tempfacdata = response;
        for (var i = 31; i >= 1; i--) {
        	li = '' 
        	h3 = ''
        	tempfacdata.forEach(function(index, element) {        		       
	    		if (index.DIA == i) {
	    			h3 = '<h3>Consecutivo del '+index.FECHA+'<span class="fa fa-angle-down"></span></h3>'
	    			li += 
	    			'<li>'+
	    			'<p>'+index.CODIGO+'</p>'+
	    			'<p>'+index.NOMBRE+'</p>'+
	    			'<p>'+index.CANTIDAD+'</p>'+
	    			'<p>$'+number_format(+index.PRECIO)+'</p>'+
	    			'<p>$'+number_format(index.TOTAL)+'</p>'+
	    			'</li>'	      			
	    		}      		
	    	});
	    	if (li != '') {
	    		$('#accordion').append('<div>'+h3+'<ul>'+li+'</ul>'+'</div>') 
	    	}
        }
    });

    $(document).on('click', '#accordion div', function() {
        box = $(this).find('ul')
		$('#accordion div').find('ul').slideUp(300)
		$('#accordion div').find('h3').find('span').addClass('fa-angle-down')
        $('#accordion div').find('h3').find('span').removeClass('fa-angle-up')  
        if (box.css('display') === 'none') {
            $(this).find('h3').find('span').removeClass('fa-angle-down')
            $(this).find('h3').find('span').addClass('fa-angle-up')
            box.slideDown(300)
        } else {
        	$(this).find('h3').find('span').addClass('fa-angle-down')
            $(this).find('h3').find('span').removeClass('fa-angle-up')
            box.slideUp(300)
        }
    });
});