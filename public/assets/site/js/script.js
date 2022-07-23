
$(function(){   

    //scroll animate ------------------------------------------------------- 
    ScrollOut();

    //viewbox --------------------------------------------------------------
    $('.image-ek-link').viewbox();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    

	//mobil button -------------------------------------------------------------
    $(".mobil-button").on("click", function(){     
        $(this).toggleClass("open");        
        $(".main-menu").toggleClass("menu-open");        
    });
    //--------------------------------------------------------------------------

    
    //e-posta validate ---------------------------------------------------------------
    function isEmail(email) {
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        return regex.test(email);
    }

    $("input").change(function(){
        $(this).removeClass("border-red");
    });

    $("select").change(function(){
        $(this).removeClass("border-red");
    });

    
    // mail list formu post -------------------------------------------------------------------
    $("#mailListForm").submit(function(e){
        e.preventDefault();       
        var mail     = $.trim( $("[name=bulten_mail]").val() );
        if(mail.length <= 0){
            Swal.fire({
                type: 'error', 
                text: 'Lütfen e-posta adresi yazın',
                confirmButtonText: 'Tamam',
                confirmButtonColor: '#333'
            });         
            return false;
        }else if(!isEmail(mail)){
            Swal.fire({
                type: 'error', 
                text: 'Lütfen geçerli bir e-posta adresi yazın',
                confirmButtonText: 'Tamam',
                confirmButtonColor: '#333'
            });         
            return false;
        }else{              
            
            var form_data = new FormData(this);

            $.ajax({
                type        : "post",
                url         : "/bulten-formu-post",
                data        : form_data,
                contentType : false,            
                processData : false,            
                dataType    :'json',
                success : function(result){

                    if( result.durum == "success"){

                        Swal.fire({
                            type: 'success', 
                            text: result.mesaj,
                            confirmButtonText: 'Tamam',
                            confirmButtonColor: '#333'
                        }); 
                       
                        $("[name=bulten_mail]").val("");
                        
                        return false;

                    }else if( result.durum == "error"){

                         Swal.fire({
                            type: 'error', 
                            text: result.mesaj,
                            confirmButtonText: 'Tamam',
                            confirmButtonColor: '#333'
                        });  

                        return false;
                    }  
                }               
            });
        }    
    });
    // -------------------------------------------------------------------------------------   


});//$(function) bitis *** *****------------------------------------------------------------




//yukarı çık butonu --------------------------------------------------------
$(window).scroll(function () {
    if ($(this).scrollTop() > 150) {
        $('#top').fadeIn("slow");
    } else {
        $('#top').fadeOut("slow");
    } 
});


