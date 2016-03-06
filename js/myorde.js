
$("table").delegate(".show",'click',function(){

   $(this).attr('class','glyphicon glyphicon-minus hide');
});



$("table").delegate(".hide",'click',function(){

   $(this).attr('class','glyphicon glyphicon-plus show');
});