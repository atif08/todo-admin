
$(document).ready(function(){
    $("#burger-menu").on('click',function(){
        if(!$("#side-menu").hasClass("header-fixed")){
        $("#side-menu").removeClass("w-0");
        $("#side-menu").addClass("header-fixed");
        $("body").addClass("overflow-hidden");
        $("#bg-overlay").addClass("bg-overlay");
        }
    else{
        $("#side-menu").addClass("w-0");
        $("body").removeClass("overflow-hidden");
        $("#bg-overlay").removeClass("bg-overlay");
        $("#logo").removeClass("ml-8");
    }
    });

    $("#burger-menu").on('click',function(){
        if($("#side-menu").hasClass("w-0")){
            setTimeout(function(){
                $("#side-menu").removeClass("header-fixed");
            });
        }
    });

    $("#accent-color-picker").on('input',function(){    
        $('#accent-color').val($(this).val()).css("text-transform" , "uppercase")
      });

      

    $("#main-color-picker").on('input',function(){    
        $('#main-color').val($(this).val()).css("text-transform" , "uppercase")
      });
})


$("#side-menu").outclick(function(){
        if($("#side-menu").hasClass("header-fixed")){
            $("#side-menu").addClass("w-0");
            $("#side-menu").removeClass("header-fixed");
            $("body").removeClass("overflow-hidden");
        $("#bg-overlay").removeClass("bg-overlay");
        }
});

function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}
