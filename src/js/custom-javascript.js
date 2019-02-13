
/* Ajax functions */
jQuery(document).on('click','.load-more', function(){

    var that = jQuery(this);
    var page = jQuery(this).data('page');
    var newPage = page+1;
    var ajaxurl = that.data('url');
    
    that.addClass('loading').find(".text").text("Loading..."),

    jQuery.ajax({
        
        url : ajaxurl,
        type : 'post',
        data : {
            
            page : page,
            action: 'load_more'
            
        },
        error : function( response ){
            console.log(response);
        },
        success : function( response ){
            setTimeout(function (){

                that.data('page', newPage);
                jQuery('.posts-container').append( response );

                that.removeClass('loading').find(".text").text("Load more");

            }, 1000);
        }   
    });

    

});
