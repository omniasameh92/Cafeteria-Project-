
   
     var ws = new WebSocket('ws://52.25.138.60:4551/');
     ws.onopen = function(e) {
       console.log("Connection established!");
       ws.send('Hello Me');
     
     };

         ws.onmessage=function(e){
          var obj=JSON.parse(e.data); 
       
        console.log(obj);  
        

        if(obj.type=="order" || obj.type=="deleteorder" ){
               
          $.ajax({
                  type: "POST",
                  url: "adminorders.php",
                  cache: false,
             success: function(data){
                  
           $("#orders").html(data);         
              
              }
           
           });  

           if(obj.type=="deleteorder"){
                  $("#admin_orders").html('An order is cancelled .<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>');
                  $("#admin_orders").attr("class","alert alert-danger fade in"); 
               
               setTimeout(function(){$("#admin_orders").fadeOut(); }, 3000); 
              
           }     
        }    

       }
         
      $("#orders").delegate(".deliver",'click',function(e){
      //  alert('here');
                    var order_id=e.target.id;
                 $.ajax({
                  type: "POST",
                  url: "deliver_order.php",
                  data:{"order_id":order_id},
                  cache: false,
                  success:function(data){
                      
                              
                     var con={            
                      "type":"deliverorder",
                      'order_id':order_id       
                        }; 
                 obj=JSON.stringify(con);
            
                 ws.send(obj);   

                   }

                   });
                         
                      if($(this).parent().parent().parent().children().length ==4){
          
                          $(this).parent().parent().remove();
                          $("#tr"+order_id).remove();
                          $("#orders").html('<div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>There are  no orders yet wait for making orders please .</div>');
                       }
                       else{
                
                       $(this).parent().parent().remove();
                       $("#tr"+order_id).remove();   
                            }

                    });



   $("#orders").delegate("#show",'click',function(){
   //    alert('here');
   $(this).attr('class','glyphicon glyphicon-minus');
   $(this).attr('id','hide');
    
});



$("#orders").delegate("#hide",'click',function(){
  $(this).attr('id','show');
  $(this).attr('class','glyphicon glyphicon-plus');
});
              
     
  