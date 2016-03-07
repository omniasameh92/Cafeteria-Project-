
var ws = new WebSocket('ws://127.0.0.1:4551/');
ws.onopen = function(e) {
             console.log("Connection established!");
              ws.send('Hello Me!');
  };

$("#my_orders").delegate("#show",'click',function(){
   //    alert('here');
   $(this).attr('class','glyphicon glyphicon-minus');
   $(this).attr('id','hide');
    
});

/*
  ws.onmessage=function(e){
          var obj=JSON.parse(e.data); 
       
        console.log(obj);  
        if(obj.type =="order" || obj.type=="deliverorder"){
                console.log("1");
             $.ajax({
                  type: "POST",
                  url: "get_my_orders.php",
                  cache: false,
             success: function(data){
                 // console.log(data);
                  $("#my_orders").html(data);         
              
              }
           
           });  

            
              
        }
      }
*/
 if(typeof(EventSource) !== "undefined") {
            var source = new EventSource("../test1.php");
            source.onmessage = function(event){
                    $.ajax({
                    type: "POST",
                    url:"get_my_orders_date.php",
                    data:{"date_from":date_from,"date_to":date_to},
                    cache: false,
             success: function(data){
                      
                 $("#my_orders").html(data);
                     //  alert(data);
                 }                    
                 
                 });
                };
             }
              

$("#my_orders").delegate("#hide",'click',function(){
  $(this).attr('id','show');
  $(this).attr('class','glyphicon glyphicon-plus');
});

    $("#my_orders").delegate(".delete","click", function(e){
               
               var order_id=e.target.id;
                   order_id=order_id.split(',');
                 //   alert(order_id[1]);
            $.ajax({
                  type: "POST",
                  url: "deleteorder.php",
                  data: {'order_id':order_id[1]},
                  cache: false,
             success: function(data)
                 {
                 	//alert(data);
                  var con={            
                     "type":"deleteorder",
                      'order_id':order_id[1]       
                        }; 
                 obj=JSON.stringify(con);
            
                 ws.send(obj);
             
                    
                 }

               });
             if($(this).parent().parent().parent().children().length ==4){
             	//alert("here");
                    $(this).parent().parent().remove();
                            $("#tr"+order_id[1]).remove();
                       $("#my_orders").html("there is orders yet");
                       }
                  else{
           // alert($(this).parent().parent().parent().children().length);
             //     alert('here1');
              $(this).parent().parent().remove();
               $("#tr"+order_id[1]).remove();
             // $("#ord_products").remove();
        
               }
        });