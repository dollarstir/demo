$(function(){

    // $('.res').hide();


    // game functions here
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


// function for ajax responses
    function response(resp){
        resp  = $.trim(resp);

        if(resp == 'success'){
            $('.mess').html('<div class="alert cc alert-success" role="alert">Bet placed successfuly</div>');
            $('.mess').fadeOut(5000);
        }
        else if(resp == 'won'){
            $('.res').fadeIn('slow');
            $('.results').html('You won');
            $('.win').load('process.php?action=winnumber');

            $('.countdown').html('waiting');


            
        }
        else if(resp == 'lost'){
            $('.res').fadeIn('slow');
            $('.results').html('You lost');
             $('.win').load('process.php?action=winnumber');
             $('.countdown').html('waiting');
            
        }
        else if(resp == 'nobet'){
            $('.res').fadeIn('slow');
            $('.results').html('No bet ');
            $('.win').load('process.php?action=winnumber');
            $('.countdown').html('waiting');
        }
        else if(resp == 'error'){
            $('.mess').html('<div class="alert cc alert-danger" role="alert">Error placing bet</div>');
        }
        else{
            $('.mess').html('<div class="alert cc alert-danger" role="alert">Error placing bet</div>');
        }

    }

// Bet buttons here
    $('.bet').click( function(){

        if(data.length == 0){

            $('.mess').html('<div class="alert cc alert-danger" role="alert">Please select a number</div>');
            $(".cc").fadeOut(5000);
        }

        else if(data.length > 5){

            $('.mess').html('<div class="alert cc alert-danger" role="alert">Please select  5 numbers</div>');
            $(".cc").fadeOut(5000);
        }
        else if(data.length < 5){
            
            $('.mess').html('<div class="alert cc alert-danger" role="alert">Please select  5 numbers</div>');
            $(".cc").fadeOut(5000);

            
            
        }
        else {

            if(confirm('Are you sure you want to bet?')){
                $myrecord  ={
                    url :'process.php?action=bet',
                    type:'post',
                    data:{'data':data},
                    success: response,
    
                }
    
                $.ajax($myrecord);
                
            

            }

        }

    })



//  Time functions here
    var doUpdate = function() {
        $('.countdown').each(function() {
          var count = parseInt($(this).html());
          if (count !== 0) {
            if($(this).html() == 'waiting'){
                $(this).html('waiting');
            }
            else{
                $(this).html(count - 1);
            }
            
          }
          else{
            $(this).html('0');
            // $(this).css('background-color', 'red');
            // $(this).css('color', '#fff');


            

          }
        });


        $('.countdown1').each(function() {
            var count1 = parseInt($(this).html());
            if (count1 !== 0) {
                $(this).html(count1 - 1);
              
            }
            else{
              $(this).html('0');
              
  
  
              
  
            }
          });
      };

    setInterval(doUpdate, 1000);

    setInterval(function(){
        if($('.countdown').html() == '0'){

            $dd = {
                url:'process.php?action=result',
                type:'post',
                success:response,
            }
            $.ajax($dd);
            
        }
        if($('.countdown1').html() == '0'){
            $('.countdown').html('30');
        }
    },3000);
    



    

})