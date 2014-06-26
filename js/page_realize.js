var pager = new Imtech.Pager();
			 
			
			 
$(document).ready(function() {
   			 // кол-во выводимых параграфов () или div )
   			 // на одной странице
			  
	$('#myselect').change(function(e) {
		e.preventDefault();
		pager.paragraphsPerPage = $('#myselect').val();
		pager.showPage(1);
	 });
			 
   			 
   			 // основной контейнер
    	pager.pagingContainer = $('#message_list'); 
   		pager.paragraphs = $('div.m', pager.pagingContainer); 
   		pager.showPage(1);
			
});
