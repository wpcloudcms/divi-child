jQuery(function($){
   // alert('Hi! This is working!');
      // var remove = $('a.item-delete');
      // $('ul#menu-to-edit li.menu-item').append(remove); 

      $('div#header,div#sidebar,div#footer').each(function() {      
      if($(this).is(':contains("Header")')) {
        $(this).prepend('<span class="et_pb_widget_area_remove"> Dividose </span>'); 
        $(this).append('<span class="library_id">[library id=""]</span>');
        }    
        if($(this).is(':contains("Sidebar")')) {
        $(this).prepend('<span class="et_pb_widget_area_remove"> Dividose </span>'); 
        }  
      if($(this).is(':contains("Footer")')) {
        $(this).prepend('<span class="et_pb_widget_area_remove"> Dividose </span>'); 
        }  
      
   });
  
  
  
}); // Jquery end