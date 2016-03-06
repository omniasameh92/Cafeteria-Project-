 <script type='text/javascript'> 
      
        var ws = new WebSocket('ws://127.0.0.1:4551/');
      
        ws.onmessage=function(e){
                  if(e.data=="order"){                
                        $.ajax({
                          type: "GET",
                          url: "request_orders.php",
                          cache: false,
                     success: function(data)
                         {
                                 
                         }
                  
                      });
                     }  
                   }
           function add_prod_send(cat,pid){
               
                var con={
                       'type':'addproduct',
                        'catid':cat,
                        'pid':pid
                        };  
                     
                obj=JSON.stringify(con);
                ws.send(obj);
           }  
  
</script>
