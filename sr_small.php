<?php

require 'aws.phar';
?>

<html>

<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>


</head>

<body>
	
	
	<div id="test"></div>
	
	<div id="wrapper" style="height: 400px; width : 370px ; overflow: scroll;">
		<div id="content"> 
		
			<div id=1></div>
	        <div id=2> </div>
	        <div id=3></div>
	        <div id=4> </div>
	        <div id=5> </div>
	        <div id=6> </div>
	        <div id=7>	</div>
	        <div id=8>	</div>
	        <div id=9>	</div>
			<div id=10> </div>
			<div id=11> </div>
			<div id=12> </div>

		</div>
		
	</div>

    	
	<script language="JavaScript">
		
		
		var wrapper = document.getElementById("wrapper");
		var content = document.getElementById("content");
		
		var test = document.getElementById("test");
		var start_key=0;
		var flag=0;
		var x=0;
		var old_key=0;
		var i,j;

		$.post
				( 
                  "sr_load_initial.php",
                  
				  function(result)
                  {	

                     var pos1 = result.indexOf("~");                     
                     var pos2 = result.indexOf("^")

                     var key=result.substring(pos1+1,pos2);					                     
                     start_key=parseInt(key);
                                         
                     var new_result=result.substring(0, pos1); 
                     
                     
                     var parts=new_result.split("</html>");
                     
                     
                     
  					  
                     for (i=3,j=0;i<=8;i++,j++)
                     	{	
                     		document.getElementById("content").children[i].innerHTML=parts[j];
                     		
                      	}
                                 	 
                      for(i=0;i<=11; i++)
						{
							if(document.getElementById("content").children[i].innerHTML=="undefined")
										document.getElementById("content").children[i].innerHTML="";

						}
  					 
                     

                  }
               );
		

     	function addEvent(obj,ev,fn)
		{
			
			if(obj.addEventListener) obj.addEventListener(ev,fn,false);
			else if(obj.attachEvent) obj.attachEvent("on"+ev,fn);    

		}

		
		function scroller() 
		{
			

			//test.innerHTML = "outer if"+wrapper.scrollTop+"+"+wrapper.offsetHeight+"+100>"+content.offsetHeight;
			
			
			  
				if(wrapper.scrollTop+wrapper.offsetHeight>content.offsetHeight )
				{  	
					if(old_key!=start_key)
					{ old_key=start_key;
			


						x=x+100;
				    	$.post
					      ( 
                  			"sr_load_later.php",
                  		 	{ start_key: start_key },
				  		  	
				  		  	function(result,status)
                  		 	{	
                    			
                    			if(status="success")
                    				{flag=flag+1;
                    			     
                    				}

                    			//alert(result);
                    			var pos1 = result.indexOf("~");
                                  
		            	        var pos2 = result.indexOf("^")
        			            var key=result.substring(pos1+1,pos2);
					            if(result[pos2+1])          
                     					return;
                  		 			                     			
                     			start_key=parseInt(key);
                     			
                     			var new_result=result.substring(0, pos1); 
                     			//content2.innerHTML+=new_result;

                     			var parts=new_result.split("\n\n");


								for (i=0;i<=5;i++)
			                     	{	
			                     		document.getElementById("content").children[i].innerHTML=document.getElementById("content").children[i+3].innerHTML;
			                     
					
			                     	}
			                    
								
								for (i=9,j=0;i<=11;i++,j++)
			                     	{	
			                     		document.getElementById("content").children[i].innerHTML=parts[j];
			                     
					
			                     	}
			                                       	  			
                  		 			

			                     for(i=0;i<=11; i++)
									{
										if(document.getElementById("content").children[i].innerHTML=="undefined")
											document.getElementById("content").children[i].innerHTML="";

									}
  					 	


                  		 	}
               			  

               		      );    
	  				}
				
				
				}
		  			
		
		}
		
		// hook the scroll handler to scroll event
			
		 addEvent(wrapper,"scroll",scroller);
	
    	
	
	
	</script>
</body>


</html>