
  var ws=new WebSocket('ws://52.25.138.60:4551/'); 

   ws.onopen = function(e) {
    console.log("Connection established!");
    ws.send('Hello Me!');
 };

 ws.onmessage=function(e){

  console.log(e.data);
 }



   $("#prod_name").change(function(e){
  //  alert('here');
     $("#p_name").attr('class','form-group');  
     $("#p_name span").remove();
     document.getElementById("name_error").innerHTML=" ";
        
   }); 

   $("#prod_price").change(function(e){
  //  alert('here');
     $("#p_price").attr('class','form-group');  
     $("#p_price span").remove();
     document.getElementById("price_error").innerHTML=" ";
        
   }); 


   $('#submit_product').click(function(){
               //alert(last_update);
                var con={
                'type':'editproduct',
                'catid':catid,
                'prodid':prodid,
                'last_update':last_update
                      
                };  

               obj=JSON.stringify(con);
               ws.send(obj);
   });

