
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

/* Animation */
var title = jQuery('.post-template-single-custom h1');
console.log(title);
console.log(title);
jQuery(document).ready(function(){
var tl = new TimelineLite();
tl.from(".cover", 1, {scaleY:0, transformOrigin:"left top"})
  .to(".cover", 1, {scaleY:0, transformOrigin:"left bottom"}, "reveal")
  .from(".img-anim", 1, {opacity:0}, "reveal")
  .staggerFromTo(title, 0.5, 
    {y: -100, autoAlpha: 0}, 
    {y: 0, autoAlpha: 1, ease:Power1.easeInOut},
    0.1);
});
