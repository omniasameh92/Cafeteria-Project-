  var ws;

    ws = new WebSocket('ws://52.25.138.60:4551/');

    var obj;

   ws.onopen = function(e) {
    console.log("Connection established");
    ws.send('Hello Me!');
   };


    $("#txt").delegate(".delete","click", function(e){
               var pid=e.target.id;
                var arr=pid.split(',');
            $.ajax({
                  type: "POST",
                  url: "deleteproduct.php",
                  data: {'pid':arr[0]},
                  cache: false,
             success: function(data)
                 {
                 
                 //     console.log(data);
                        
                  var con={            
                     "type":"deleteproduct",
                      'catid':arr[1],
                      'prodid':arr[0]       
                        }; 
                obj=JSON.stringify(con);
            
                ws.send(obj);
             
                    
                 }

               });
        
                 if($(this).parent().parent().parent().children().length ==2){
                    $(this).parent().parent().remove();
                       $("#txt").html("there is products yet");
                       }else{
              $(this).parent().parent().remove();
                      }
    });


    $("#txt").delegate(".aval","click", function(e){
               var pid=e.target.id;
                var arr=pid.split(',');
            $.ajax({
                  type: "POST",
                  url: "update_product_avaliablity.php",
                  data: {'pid':arr[0],'ava':arr[2]},
                  cache: false,
             success: function(data)
                 {                       
                  var con={            
                     "type":"updateproductava",
                     'catid':arr[1],
                     'prodid':arr[0]      
                        }; 
                obj=JSON.stringify(con);
            
                ws.send(obj);
                    
                

                 }
               });
           var id=arr[0]+','+arr[1]+','+1;
         $(this).text("unavaliable");
         $(this).attr("class","unaval btn btn-default");
         $(this).attr("id",""+id);

    });
     $("#txt").delegate(".unaval","click", function(e){
               var pid=e.target.id;
                var arr=pid.split(',');
            $.ajax({
                  type: "POST",
                  url: "update_product_avaliablity.php",
                  data: {'pid':arr[0],'ava':arr[2]},
                  cache: false,
             success: function(data)
                 {

                  var con={            
                     "type":"updateproductava",
                     'catid':arr[1],
                     'prodid':arr[0]      
                        }; 
                obj=JSON.stringify(con);
            
                ws.send(obj);
                    
                 }

               });
            
            var id=arr[0]+','+arr[1]+','+0;
            $(this).attr("id",""+id);
            $(this).text("avaliable");
            $(this).attr("class","aval btn btn-default");

    });




