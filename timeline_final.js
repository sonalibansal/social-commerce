
var start_key1=0;
     var start_key2=0;
     var start_key3=0;
    
    var exclusivestartkey1=" ";
      var exclusivestartkey2=" ";
      var exclusivestartkey3=" ";
     	var loadFlag = false;
     function insert_votes(id,reaction_value)
        {

	//alert("hey sonali");
            $.ajax({
	url: "vote.php",
	data:'id='+id+'&reaction='+reaction_value,
	type: "POST",
	success: function(data){
       // alert("hi");
		alert(data);
         $('#btn-votes-'+id).css('color', 'blue');
        
       // document.getElementById("btn-votes-"+id).style.color="blue";
		//votes = votes+1;     
		//alert(votes);   	
	       }
        });
            
        
        }
    function load()
    {
        
        $.ajax({
            url:"load_initial.php",
                type:"POST",
            success:function(data1)
            {
                //alert(data1);
               // alert("hi");
                var myjson=data1;
                //var j=JSON.parse('{"name":sonali,"branch";cse}');
                var j=JSON.parse(myjson);
                //alert(j.data);
               // var j=jQuery.parseJSON(myjson);
                document.getElementById("content").innerHTML=j.data;
               // alert(j.key_value);
                start_key1=j.key_value1;
                start_key2=j.key_value2;
                start_key3=j.key_value3;
               /* alert(start_key1);
                 alert(start_key2);
                 alert(start_key3);*/
                //alert(data1);
            }
        });
    }
    
$(window).scroll(function() {
 		
 		if($(window).scrollTop() + $(window).height() >= $(document).height()) {
            //alert(start_key);
 			if(loadFlag==false) {
 			  exclusivestart_key1=parseInt(start_key1);
                exclusivestart_key2=parseInt(start_key2);
                exclusivestart_key3=start_key3;
                //alert(exclusivestart_key1);
               //     alert(exclusivestart_key2);
                //  alert(exclusivestart_key3);
              
                
	 			loadFlag = true;
               // if(exclusivestart_key!=null)
                 $.ajax({
                    url:"final.php",
                     data:"exclusivestartkey1="+exclusivestart_key1+"&exclusivestartkey2="+exclusivestart_key2+"&exclusivestartkey3="+exclusivestart_key3,
                    type:"POST",
                success:function(data)
                    {
                        loadFlag=false;
                       //alert(data);
                       // alert("hi");
                        var myjson=data;
                      var j=JSON.parse(myjson);
                       // var j=jQuery.parseJSON(myjson);
                        document.getElementById("content").innerHTML+=j.data;
                       // alert(j.key_value);
                        //start_key=j.key_value;
                       // alert(start_key);
                         start_key1=j.key_value1;
                start_key2=j.key_value2;
                start_key3=j.key_value3;
                        //alert(data1);
                    }
                 });
               
			}
 		}
 	}); 
