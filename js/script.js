$(function(){

    $('.res').hide();


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
                
            $('.mess').html('<div class="alert cc alert-success" role="alert">You have betted on '+ data + ' Please wait for result</div>');

            }

        }

    })



//  Time functions here
    var doUpdate = function() {
        $('.countdown').each(function() {
          var count = parseInt($(this).html());
          if (count !== 0) {
            $(this).html(count - 1);



            
          }
          else{
            $(this).html('0');
            $(this).css('background-color', 'red');
            $(this).css('color', '#fff');

            $myrecord  ={
                url :'process.php?action=bet',
                type:'post',
                data:{'data':data},
                success:function(response){
                    alert(response);
                }

            }

            $.ajax($myrecord);

          }
        });
      };

    setInterval(doUpdate, 1000);
    



    

})