<html>

	<head>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	
		<script type="text/javascript">
					
					/*function get_window_width()
					 {
				    	return  window.innerWidth;
					 }


					function get_window_height()
					 {
				    	return  window.innerHeight;
					 }
					*/

		</script>				


        <style>
	
			.dropbtn {
			background-color: #4CAF50;
			color: white;
			padding: 5px;
			font-size: 16px;
			border: none;
			cursor: pointer;
			}

			.dropbtn:hover, .dropbtn:focus {
			background-color: #3e8e41;
			}

			.dropdown {
			position: relative;
			display: inline-block;
			}
			
			.dropdown-content {
			display: none;
			position: absolute;
			background-color: #f9f9f9;
			overflow: auto;
			box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
			}
			
			.dropdown a:hover {background-color: #f1f1f1}

			.show {display:block;}

			.block
			{
				font-size: 16px;
			}

		</style>
	</head>

	<body>

		<h2></h2>
		
		
		<div class="dropdown">
			<button onclick="myFunction()" class="dropbtn">Notifications</button>
			<div id="myDropdown" class="dropdown-content">
			 <div id="div1"></div>
   
				<script>
					$.ajax({
							url: "small.php",
							async: false,
							success: function(result)
							{ $("#div1").html(result);}
							
						   });
				



				</script>

							
				<form action="large.php" method ="post">
					<input type="hidden" id="W" name="ScreenWidth" />
					<input type="hidden" id= "H" name="ScreenHeight" />
					<input type="submit" class='block' width ="500px" value="                       See all Notifications                     " />
				</form>


				<script>
				/*document.getElementById("W").value=get_window_width();
				document.getElementById("H").value=get_window_height();
				*/
				</script> 


				
				
			</div>
		</div>

	<script>
		/* When the user clicks on the button, 
		toggle between hiding and showing the dropdown content */
		function myFunction() 
		{
		    document.getElementById("myDropdown").classList.toggle("show");
		}

		// Close the dropdown if the user clicks outside of it	
		window.onclick = function(event) 
		{
			if (!event.target.matches('.dropbtn')) 
			{

				var dropdowns = document.getElementsByClassName("dropdown-content");
				var i;
				for (i = 0; i < dropdowns.length; i++)
				{
					var openDropdown = dropdowns[i];
					if (openDropdown.classList.contains('show')) 
					{
						openDropdown.classList.remove('show');
					}
				}
			}
		}
	</script>
	</body>
</html>
