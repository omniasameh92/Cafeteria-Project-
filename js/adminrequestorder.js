 var ws ;
          var selectedcat ;
          var products=[];
          ws = new WebSocket('ws://52.25.138.60:4551/');
          var txt=document.getElementById('txt');
          var prod_cat=document.getElementById('prod_cat');
          var order=document.getElementById('order');
          var countele=0;
          var order_total=0;
          var user_order;
           ws.onopen = function(e) {
             console.log("Connection established!");
              ws.send('Hello');
           };

          $("#order_submit").hide();
          prod_cat.onchange = function(){
                selectedcat = prod_cat.options[prod_cat.selectedIndex].value;
                if(selectedcat!=-1){
                 $.ajax({
                    type: "POST",
                    url: "get_products_order.php",
                    data:{"cat":selectedcat},
                    cache: false,
             success: function(data){
                      
                 $("#txt").html(data);
                     //  alert(data);
                 }                    
                 
                 });
              }else{
                   $("#txt").html(" ");
                 }
            }
          
            $("#regbtn").click(function(){
                   $.ajax({
                     type:"GET",
                     url: "regular_order.php",
                     cache: false,
             success: function(data){
          
                $("#reg_order").html(data);
                 
                 }                    
                 
                 });

           });

          ws.onmessage=function(e){

                var msg=JSON.parse(e.data);
                     console.log(msg);
                     console.log(selectedcat);
                if(msg.type=="updateproductava" || msg.type=="deleteproduct" ||msg.type=="addproduct" && msg.catid==selectedcat){
                         
                        
                          $.ajax({
                            type: "POST",
                            url: "get_products_order.php",
                            data:{"cat":selectedcat},
                            cache: false,
                            success: function(data){
                                 
                                     
                                 $("#txt").html(data);
                    
                           }                    
                 
                          }); 
                         
                    
                         // $("#order #"+msg.prodid).remove();

                          
                }else if (msg.type=="editproduct"){
                        // alert('here'); 
                        $.ajax({ 
                           type: "POST",
                            url: "update_check.php",   
                            data:{"prodid":msg.prodid,"last_mod":msg.last_update},
                            cache: false,
                            success: function(data){
                             
                        $.ajax({
                            type: "POST",
                            url: "get_products_order.php",
                            data:{"cat":selectedcat},
                            cache: false,
                            success: function(data){
                                 
                                     
                                 $("#txt").html(data);
                    
                           }                    
                
                          }); 
                
                      }
                });
                
                }
                   
          
           }   


                      function order_send(arr,room_id,order_total,notes,foruser){     
               

                $.ajax({
                  type: "POST",
                  url: "request_order_by_admin.php",
                  data: {'arr':arr,'room_id':room_id,'order_total':order_total,"notes":notes,"foruser":foruser},
                  cache: false,
             success: function(data)
                 {
                        
                    var usid=parseInt(data);   
                   
                var con={            
                     "type":"order",
                      "user_id":foruser,
                      "requested_user_id":usid       
                        }; 
                obj=JSON.stringify(con);
            
                ws.send(obj);
                 
                 }

            });

       }
      $(".order").delegate("img","click", function(e){
                //....
                var pid=e.target.id;
                var arr=pid.split(',');
                if($('#'+arr[1]+'','#order').length == 1) {
                    $('#'+arr[1]+'').focus();              
                     }else{
                 $("#order").append('<div style="width:350px;height:50px;" class="product container" id="'+arr[0]+','+arr[2]+'"><div class="row"><div class="col-sm-6 col-md-6 col-lg-6 col-xs-6"style="display:inline"><span>'+arr[1]+'</span>'+
                  '<input  class="input_ord" size="4" id='+arr[1]+' type="number" min="1" value="1"></div>'+
                  '<div class="col-sm-2 col-md-2 col-lg-2 col-xs-2" style="display:inline;"><span class="glyphicon glyphicon-plus inc"></span>'+
                  '<span  class=" glyphicon glyphicon-minus dec"></span></div>'+
                  '<div class="col-sm-4 col-md-4 col-lg-4 col-xs-4" style="display:inline"><span id="'+arr[2]+'">'+arr[2]+'<span>&nbsp;EGP</span></span><span class="glyphicon glyphicon-remove remove"></span></div></div></div>');                
                  }

  
          });   


            $("#order").delegate(".inc","click", function(e){
           
              //alert($("#order .input_ord").val());
              var arr=$(this).parent().siblings("div");
              var inp = arr[0].childNodes[1];
              var temp=parseInt($(inp).val());
                      temp+=1;

                      $(inp).val(temp);
                    
              });


            $("#order").delegate(".dec","click", function(e){
                        //alert($("#order .input_ord").val());
              var arr=$(this).parent().siblings("div");
              var inp = arr[0].childNodes[1];
              var temp=parseInt($(inp).val());                      
                    if(temp>1){
                      temp+=-1;
                    }
                      $(inp).val(temp);
              });

             $("#order").delegate(".remove","click", function(e){
             
                  $(this).parent().parent().parent().remove();
                
              });

             $("#order_btn").click(function(e){ 
                          //$(this).attr("disabled","disabled");
                         
                    var arr =$("#order").children(".product");
                 
                       if(arr.length>0){
                       $("#order_submit").fadeIn();
                       $("#order_submit").delay(3000).slideUp(400);
                      $(this).prop('disabled', true);
                      for(var j=0;j<arr.length;j++){
                           //    console.log();
                           var temp =$(arr[j]).attr('id').split(',');
                           var child_id=temp[0];
                           var child_quantity=$(arr[j].childNodes[0].childNodes[0].childNodes[1]).val();
                           var child_price=temp[1];
                         
                               var prod={
                                  "id":child_id,
                                  "quan":child_quantity
                               };
                            products.push(prod);
                            
                            order_total+=child_quantity*child_price;
                      }

                        var room_id=$("#ext_room").val();
                        var notes=$("#order_notes").val().trim();

                     // alert(notes);
                        if(notes==""){
                          notes="no notes";
                           

                        } 
                        $("#total").html("total:"+order_total); 
                         var repeat=4;
                         setInterval(function(){
                                if(repeat>0){
                                  $("#total").fadeOut();
                                  $("#total").fadeIn();
                                  repeat--;
                                }
                         },100);
                     
                          var foruser = $("#user").val();

                      order_send(products,room_id,order_total,notes,foruser);    
                      order_total=0;
                       setTimeout(function(){
                       for(var j=0;j<arr.length;j++){
                            $(arr[j]).slideUp(400);
                            $(arr[j]).remove();
                               }
                            $("#total").slideUp(400);
                            $("#total").html(" ");
                            $("#order_notes").val("");
                            $("#order_btn").prop('disabled',false);

                          },5000);                                                      
                          }else{
                            
                            $("#errors").html('Please choose any product to order <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>');
                            $("#errors").attr("class","alert alert-danger fade in"); 

                
                                   }

             });
            