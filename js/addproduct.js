
var ws;

ws = new WebSocket('ws://52.25.138.60:4551/');
  var catid;
  var prodid;
  var obj;
  var selectedcat;
    var prod_cat=document.getElementById('prod_cat');
ws.onopen = function(e) {
    console.log("Connection established!");
    ws.send('Hello Me!');
};

  function x_send(){
                alert("here");
        var con={
               'type':'addproduct',
                'catid':catid,
                'prodid':prodid                
                };  
        obj=JSON.stringify(con);
        ws.send(obj);
        window.location.href="productadminpanel.php";
   }
   
   $("#prod_name").change(function(e){
  //  alert('here');
     $("#p_name").attr('class','form-group');  
     $("#p_name span").remove();
     document.getElementById("name_error").innerHTML=" ";
        
   }); 

   $("#prod_price").change(function(e){
     $("#p_price").attr('class','form-group');  
     $("#p_price span").remove();
     document.getElementById("price_error").innerHTML=" ";
        
   }); 

    $('#add_prod').click(function(event){
       // alert('here');
            //event.preventDefault();
          selectedcat = prod_cat.options[prod_cat.selectedIndex].value;
          
         //   console.log(selectedcat);
                var con={
                'type':'addproduct',
                'catid':selectedcat
                     
                };  

               obj=JSON.stringify(con);
               ws.send(obj);
   });
