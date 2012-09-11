var Post_Importer = {

	ready: function() {
	
		jQuery(".categories").data("placeholder","Select A Category..").chosen();
		
		jQuery('.post-meta').append('<a href="#" class="submitdelete deletion">remove</a>').each(function(index, value){
			jQuery(this).append('<input type="hidden" name="post" />')
		});
		
		jQuery('.submitdelete').on('click', function() {
			var ok = confirm('are you sure you want to remove the post?')
			if(ok)
			jQuery(this).parents('.the_post_wrap').hide()
		});
	}

}

jQuery(document).ready(Post_Importer.ready);