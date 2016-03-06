var ws;
ws = new WebSocket('ws://52.25.138.60:4551/');
  var catid;
  var prodid;
  function x_send(){
                alert('here');
        var con={
               'type':'addproduct',
                'catid':catid
               // 'prodid':prodid                
                };  
        obj=JSON.stringify(con);
        ws.send("hi");
   }  