(function($) {
    "use strict";




	 jQuery('.dz-chat-user-box .dz-chat-user').on('click',function(){
		 jQuery('.dz-chat-user-box').addClass('d-none');
		 jQuery('.dz-chat-history-box').removeClass('d-none');
	 });

	jQuery('.dz-chat-history-back').on('click',function(){
		 jQuery('.dz-chat-user-box').removeClass('d-none');
		  jQuery('.dz-chat-history-box').addClass('d-none');
	 });




})(jQuery);
