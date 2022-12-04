$(function(){
    var data = [];
    $('.demo').click( function(){
        var $id = $(this).attr('id');
       
        if(jQuery.inArray($id, data) == -1){
            $(this).css('background-image', 'url(images/bg.png)');
            data.push($id);
            ischecked = true;

            
        }
        else {
            $(this).css('background-image', 'none');
            $(this).css('color', '#000');
            data.splice(data.indexOf($id), 1);
            ischecked = false;
            
            
        }

    }); 


    $('.bet').click( function(){

        if(data.length == 0){

            $('.mess').html('<div class="alert cc alert-danger" role="alert">Please select a number</div>');
            $('.cc').fadout(3000);
        }

        else if(data.length > 5){

            $('.mess').html('<div class="alert cc alert-danger" role="alert">Please select  5 numbers</div>');

        }
        else if(data.length < 5){
            
            $('.mess').html('<div class="alert cc alert-danger" role="alert">Please select  5 numbers</div>');


            
            
        }
        else {

            if(confirm('Are you sure you want to bet?')){
                
            $('.mess').html('<div class="alert cc alert-success" role="alert">You have betted on '+ data + '</div>');

            }

        }

    })



    

})