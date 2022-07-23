
$(function(){

    $('.image-link').viewbox();    

    $('[data-bs-toggle="tooltip"]').tooltip();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    //---- sidebar menu index active clas atama ----------------
	$(".sb-main-item").on("click", function(eq){
		var i = $(".sb-main-item").index(this);		

		$.ajax({
			type	: 'post',
			url		: '/panel/menu-index-post',
			data	: {'i':i},
			success : function(result){
				$(".sb-main-item").removeClass("active");
				$(".sidebar-dropdown").removeClass("show");
				$(".sb-main-item").eq(result).addClass("active");				
			}
		});		
	});
	//--------------------------------------------------------

	tinymce.init({  
        height:400, 
        selector: ".editor",
        language: 'tr', 
        plugins: [
            "advlist autolink lists link image charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars code fullscreen",
            "insertdatetime media nonbreaking save table contextmenu directionality",
            "emoticons template paste textcolor colorpicker textpattern"
        ],
        toolbar: 'undo redo | formatselect | fontsizeselect | bold italic strikethrough blockquote bullist numlist backcolor | link image media | removeformat fullscreen | code',
        block_formats: 'Başlık 1=h1; Başlık 2=h2; Başlık 3=h3; Başlık 4=h4; Başlık 5=h5; Başlık 6=h6',
        menubar: false,
        forced_root_block : "",
        content_style: ".mce-content-body {font-size:15px;font-family:Arial,sans-serif;}"
    });

    tinymce.init({  
        height:120, 
        selector: ".editor-small",
        language: 'tr', 
        plugins: [
            "advlist autolink lists link image charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars code fullscreen",
            "insertdatetime media nonbreaking save table contextmenu directionality",
            "emoticons template paste textcolor colorpicker textpattern"
        ],
        toolbar: 'undo redo | formatselect | fontsizeselect | bold italic strikethrough blockquote bullist numlist backcolor | link image media | removeformat fullscreen | code',
        block_formats: 'Başlık 1=h1; Başlık 2=h2; Başlık 3=h3; Başlık 4=h4; Başlık 5=h5; Başlık 6=h6',
        menubar: false,
        forced_root_block : "",
        content_style: ".mce-content-body {font-size:15px;font-family:Arial,sans-serif;}"
    });

    //çoklu resim ön izleme ------------------------------------------------------   
    var imagesPreview = function(input, placeToInsertImagePreview) 
    {
        if (input.files) {
            var filesAmount = input.files.length;
            for (i = 0; i < filesAmount; i++) {
                var reader = new FileReader();
                reader.onload = function(event) {
                    $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(placeToInsertImagePreview);
                }
                reader.readAsDataURL(input.files[i]);
            }
        }
    };

    $(document).on("change",".add-image", function(e) {
		
        var i =  $(".add-image").index(this);
        var fileName = e.target.files[0].name;
		$(".resim-prev").eq(i).html("");
        imagesPreview(this, ".resim-prev:eq("+i+")");
    });
    //---------------------------------------------------------------------------

    $("input").change(function(){
        $(this).removeClass("border-red");
    });

    $("select").change(function(){
        $(this).removeClass("border-red");
    });
    

    //////////////////////////////
    //yeni resim ekleme alanı ekleme -------------------------------------------
    $(".alan-ekle").on("click", function(){
        $(".oncesine-ekle").before('<div class="col-sm-6 col-md-4 col-xl-3 my-3 rprv-wrap">'+ 
						'<input type="file" name="resim[]" class="add-image" accept="image/*">'+  
						'<div class="p-1 bg-white position-relative mt-1 resim-prev-wrap w-100">'+
						'<div class="resim-prev"></div></div>'+
						'<button type="button" class="btn resim-kaldir text-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Kaldır"><i class="fas fa-times-circle"></i></button></div>');
    });
    //-------------------------------------------------------------------


    //resim ekleme alanı kaldırma -----------------------------------------------
    $(document).on("click", ".resim-kaldir", function(){
        var i = $(".resim-kaldir").index(this);        
        $('.rprv-wrap').eq(i).fadeOut(400, function(){ $(this).remove();});
    })
	



});