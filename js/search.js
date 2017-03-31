$('button').on('click',function(){
 //console.log(event);
 $("div .link_tasks_abonents" ).css('display', 'none');



 var text = $('input').val();
 var count = 0;

if(text) {
 	$("div .link_tasks_abonents:contains('"+text+"')" ).css('display', 'inline-block');
 	 count = 1;
} 
 


 if(count === 0) {
 	$(".notFind").text("По заданим параметрам абонента не знайдено!");
 
 }
 
});


