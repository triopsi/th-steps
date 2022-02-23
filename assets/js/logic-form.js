;(function($){
    $(document).ready(function (){ 

       // Function get icon from inputfield.
       function iconget(input){
            var reviewfield = $('.thiconReview');
            var inputVal = input.val();
            if(inputVal!=''){
                reviewfield.html('');
                reviewfield.append( "<i class='"+inputVal+"'></i>" );
            }
       }

       // Init.
       iconget($('#thsteps-icon'));

       // Change event on Field.
       $('#thsteps-icon').on('change',function(){
                iconget($(this));
        });
    });

})(jQuery);