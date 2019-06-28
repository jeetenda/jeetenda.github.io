













 $( document ).ajaxStart(function() {
    $( "#loading" ).show();
 });

 $( document ).ajaxComplete(function() {
    $( "#loading" ).hide();
 });

$(document).ready(function(){
$("#submit").click(function(){
  //Get all input-----------------------------------------------------------------------------------------------------------
//alert("s"+sick+casual+current_date);
  var sick=document.getElementById('sick').innerHTML;
  var casual=document.getElementById('casual').innerHTML;
  var date_start = document.getElementById("date_start").value;
  var date_end = document.getElementById("date_end").value;
  var leave_type = document.getElementById("leave_type").value;
  var current_date = document.getElementById("current_date").innerHTML;
  var reason=document.getElementById("reason").value;
  var probation_period= document.getElementById("probation_period").value;
  var hd1=document.getElementById("hd1").checked;
  var hd2=document.getElementById("hd2").checked;
// alert(casual+sick+probation_period+current_date);

 if (date_start == '' || date_end == '' || leave_type == '' || reason=='') {  
 swal("Please Fill All Fields!","Try again", "error" );return false;}




//Check toatal leave days from gieven start and end date days ------------------------------------------------------------
  var d_current = new Date(current_date);
  var d_start = new Date(date_start);
  var d_end = new Date(date_end);
  var timeDiff = d_end.getTime() - d_start.getTime();
  var leave_days = timeDiff / (1000 * 3600 * 24)+1;

//Check outright leave  -----------------------------------------------------------
var outright_leave=['08/15/2019','10/02/2019','10/28/2019','10/29/2019','12//25/2019'];

for(x in outright_leave )
{

var leave=new Date(outright_leave[x]);
if( (leave - d_start)==0 || (leave - d_end==0)){swal("not allowed! you can't select   day "," you select the day which is already a holiday for outright calender  ","error");return false;} 
// alert(leave);
 }

  // alert(d_end - d_start);
  // alert( hd1);
  // alert( hd1);

 //dont select  weekend and previous date same date both half date  and date and less than date start check 
if( (d_end - d_start)==0 && hd1==true && hd2==true){swal("not allowed! you can't select  half day "," you select both half date  ","error");return false;}
if((d_end < d_current) || (d_start < d_current)){swal("not allowed! you can't select  previous day"," you select a wrong date  ","error");return false;}
if(d_end < d_start ){swal("not allowed! you can't select this"," date start is greater than date end end ","error");return false;}
if(d_start.getDay() == 0 || d_start.getDay() ==6){swal("not allowed! you can't select this"," your start date is weekend Days ","error");return false;}
if(d_end.getDay() == 0 || d_end.getDay()== 6){swal("not allowed! you can't select this"," your end date is weekend Days ","error");return false;}

  //check  leave day is weekend days  saturday sunday------------ --------------------------------------------------------
 var weekendDays = 0;
 var dayMilliseconds = 1000 * 60 * 60 * 24;

while (d_start <= d_end)
 {
  
          var day = d_start.getDay();
          
          if (day == 0 || day == 6)
           {

           
           weekendDays++;
           
           }
           
        d_start = new Date(+d_start + dayMilliseconds);
}


//if weekend days  minus  from leave days---------------------if not a sandwich laeve--------------------------------------------------------------
if(weekendDays<=2 && (hd1=="1" || hd2=="1")){leave_days=leave_days-weekendDays;}
//if half day selected-------------------------------- 
if(hd1){leave_days=leave_days-.5};
if(hd2){leave_days=leave_days-.5};
//alert(leave_days);
//check notice period days from gieven leave start and current date-----------------------------------------------------------

   var d_current = new Date(current_date);
   var d_date_start = new Date(date_start);
   var timeDiff = d_date_start.getTime() - d_current.getTime();
   var notice_period = timeDiff / (1000 * 3600 * 24);
   if(leave_type=='casual' && leave_days<2  && notice_period<10){swal("No leave permission!","1 day Casuals leaves need to be applied in advance at least 10 days prior to the day of leave","error");return false;}
   if(leave_type=='casual' && leave_days<2  && notice_period<10){swal("No leave permission!","1 day Casuals leaves need to be applied in advance at least 10 days prior to the day of leave","error");return false;}
   if(leave_type=='casual' && leave_days>=2 && notice_period<30){swal("No leave permission! ","2 and more than 2 days Casuals leaves need to be applied in advance at least one month prior to the day of leave !","error");return false;}  
   // alert(notice_period);


//add extra laeve balance if extra month leave is added in users leave balance ------------------------------------------------
       function diff_months(dt2, dt1) 
       {
            dt1.setDate(1);
            dt2.setDate(1);
         var diff =(dt2.getTime() - dt1.getTime()) / 1000;
          diff /= (60 * 60 * 24 * 7 * 4);
         return Math.abs(Math.round(diff));
         
  
       }
   var d_start = new Date(date_start);
   var add_extra_laeve_balance=diff_months(d_end,d_start);     //diff 2 dates 
  add_extra_laeve_balance=add_extra_laeve_balance+diff_months(d_start,d_current);  //diff from today

   //alert(add_extra_laeve_balance);
   if(probation_period=='1' && leave_type=='casual'){swal("not allowed! you are on probation_period","  you are on probation_period ","error");return false;  }
   casual=Number(casual)+Number(add_extra_laeve_balance);
   sick=Number(sick)+Number(add_extra_laeve_balance)*.5;
   // document.getElementById('sick').innerHTML=sick;
   // document.getElementById('casual').innerHTML=casual;
   
   if(leave_type=='sick' && sick<leave_days){swal("No leave balance!"," you have only "+sick+" days  sick leaves !","error"); return false;}
   if(leave_type=='casual' && casual<leave_days){swal("No leave balance!"," you have only "+casual+" days casual leaves !","error");return false;}

// Returns successful data submission message when the entered information is stored in database.
var dataString = 'date_start=' + date_start + '&date_end=' + date_end + '&leave_type=' + leave_type + '&reason=' + reason + '&leave_days=' + leave_days +'&hd1=' + hd1 +'&hd2=' + hd2;
//alert (dataString);
if (date_start == '' || date_end == '' || leave_type == '' || reason=='') {
alert("Please Fill All Fields start date & end date  & leave type");

} else {
// AJAX code to submit form.
$.ajax({
type: "POST",
url: "ajaxjs.php",
data: dataString,
cache: false,
success: function(html) {
 //alert(html);
 if(html=="error")
  { swal("ERROR! try again", html,"error").then( () => {
    location.href = 'logout.php'
})
}
else{

 swal("request submitted!", html,"success").then( () => {
    location.href = ''
})
// swal("request submitted ",html,"success");
// window.setTimeout(function(){ } ,3000);
 }
 
}
});
}
return false;
});
});