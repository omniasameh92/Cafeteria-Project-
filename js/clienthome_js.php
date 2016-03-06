 var ws ;
          var selectedcat ;
          var products=[];
          ws = new WebSocket('ws://127.0.0.1:4551/');
          var txt=document.getElementById('txt');
          var prod_cat=document.getElementById('prod_cat');
           var order=document.getElementById('order');
          var countele=0;
           var order_total=0;
           
      //    $("#error").hide();
          prod_cat.onchange = function(){
                selectedcat = prod_cat.options[prod_cat.selectedIndex].value;
                x_send(selectedcat);
            }
          

          ws.onmessage=function(e){
         
          if(e.data!='no product'){

          var obj=JSON.parse(e.data);
          console.log(obj); 
           
          if(obj[0].cat_id==selectedcat){
             txt.innerHTML="";

          for(var i=0;i<obj.length;i++){
                  if(obj[i].product_state !=0){    
                   txt.innerHTML+="<div class='product'><img id='"+obj[i].product_id+","+obj[i].product_name+","+obj[i].product_price+" ' width='60px' height='60px' src='/project/uploads/"+obj[i].product_pic+"'><span>"+obj[i].product_name+"</span><span>"+obj[i].product_price+"</span></div>";              
                    
                   }else{
                      countele+=1;
                   }
             }

            }
               if(countele==obj.length){

                     txt.innerHTML="all products are unavaliable now select another category "
              }
          }else{
              
            	 txt.innerHTML="sorry there are no products yet in that category<br>";  
              }        
            countele=0;
        }    	 	      

   function x_send(catid){
        
          txt.innerHTML="";
          var con={
               "type":"getproducts",
                "catid":catid
                };  
           obj=JSON.stringify(con);
           ws.send(obj);
       }

function order_send(arr){     
          var con={
               "type":"order"
                }; 
           arr.push(con);
           obj=JSON.stringify(arr);
           console.log(obj);
           ws.send(obj);
       }


      $("#txt").delegate("img","click", function(e){
                var pid=event.target.id;
                var arr=pid.split(',');
                if($('#'+arr[1]+'','#order').length == 1) {
                    $('#'+arr[1]+'').focus();              
                     }else{
                 $("#order").append('<div  class="product" id="'+arr[0]+'"><span>'+arr[1]+'</span>'+
                  '<input size="4" id='+arr[1]+' type="number" min="1" value="1">'+
                  '<span  class="glyphicon glyphicon-plus inc"></span>'+
                  '<span  style=" display:block;margin-left:78px;"class=" glyphicon glyphicon-minus dec"></span>'+
                  '<span id="'+arr[2]+'">'+arr[2]+'<span>EGP</span></span><span class="glyphicon glyphicon-remove remove"></span></div>');                
                  }

  
          }); 	


            $("#order").delegate(".inc","click", function(e){
                  var temp=parseInt($(this).siblings("input").val());
                      temp+=1;
                      $(this).siblings("input").val(temp);
              });


            $("#order").delegate(".dec","click", function(e){
                  var temp=parseInt($(this).siblings("input").val());
                    if(temp>1){
                      temp+=-1;
                    }
                  $(this).siblings("input").val(temp);
              });

             $("#order").delegate(".remove","click", function(e){
                  $(this).parent().remove();
                
              });

             $("#order_btn").click(function(e){ 

                    var arr =$("#order").children(".product");
                 
                       if(arr.length>0){
                      for(var j=0;j<arr.length;j++){
                                  console.log(arr[j]);
                           var child_id=$(arr[j]).attr('id');
                           var child_quantity=$(arr[j].childNodes[1]).val();
                           var child_price=$(arr[j].childNodes[4]).attr("id");
                            //   console.log(child_price);
                               var prod={
                                  "id":child_id,
                                  "quan":child_quantity
                               };
                            products.push(prod);
                            
                            order_total+=child_quantity*child_price;
                      }

                        $room_id=$("#ext_room").val();
                         
                        var order_inf={"room_id":$room_id,"user":
                        <?php 

                          if(isset($_SESSION['user_id'])){
                            echo $_SESSION['user_id'];
                          }elseif(isset($_COOKIE['user_id'])){
                            echo $_COOKIE['user_id'];
                                     
                        ?>};
                        
                        products.push(order_inf);
                         
                        $("#total").html("total:"+order_total);  
                        order_send(products);
                                       
                           

                       for(var j=0;j<arr.length;j++){    
                            $(arr[j]).remove();
                               }
                          
                          }else{
                            
                            $("#errors").html('Please choose any product to order <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>');
                            $("#errors").attr("class","alert alert-danger fade in"); 

                          }
             });
            