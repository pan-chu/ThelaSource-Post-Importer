jQuery(document).ready(function(){
   jQuery('.categories input').each(function(){
   
   	var count = jQuery(this).parent().parent().parent().attr('id');
   	jQuery(this).attr('name','post['+count.substring(4)+'][categories][]');
   });
});