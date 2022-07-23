$(function(){

	//index slider -------------------------------------------------------------
    var indexSlider = $('.owl-slider');

    indexSlider.owlCarousel({
        loop:false,
        nav:false, 
        dots:false,               
        items:1
    });

    /*
    $('#sliderNext').click(function() {
        indexSlider.trigger('next.owl.carousel');
    });

    $('#sliderPrev').click(function() {
        indexSlider.trigger('prev.owl.carousel');
    });
    //animated
    indexSlider.on("changed.owl.carousel", function(e){
        var item = e.item.index-2;       
        $(".slider-head").removeClass("sagdan-gel");
        $(".owl-item").not(".cloned").eq(item).find(".slider-head").addClass("sagdan-gel");
        
    })
    */
    //./ index slider -------------------------------------------------------------


    //yorum carousel ----------------------------------------------------------
    var yorumSlider = $('.owl-yorum');
    yorumSlider.owlCarousel({
        loop:true,
        nav:false,       
        dots:true,
        items:1
    });

    //marka carousel ----------------------------------------------------------
    var referansSlider = $('.owl-referans');
    referansSlider.owlCarousel({
        loop:true,
        autoplay:true,
        autoplayTimeout:1500,
        autoplayHoverPause:true, 
        margin:7,
        responsiveClass:true,
        responsive:{
            0:{
                items:2,
                nav:false,
                dots:true,
            },
            576:{
                items:3,
                nav:false,
                dots:true,
            },
            768:{
                items:4,
                nav:3,
                nav:false,
                dots:true,
            },
            1000:{
                items:6,
                nav:false,
                dots:true,
            }
        }
    });

    //referans nav
    $('#referansNext').click(function() {
        referansSlider.trigger('next.owl.carousel');
    });

    $('#referansrPrev').click(function() {
        referansSlider.trigger('prev.owl.carousel');
    });

   

    

    function isEmail(email) {
      var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
      return regex.test(email);
    }
 
});