<?php
include 'session.php';
$src=" ";
$data=" ";
$tableName="Friends";

    $params = [
	'TableName' => $tableName,
	'Key' => [
     'User_id'=>['N'=>$login_id]
]

];
     try
{
	$result = $dynamodb->getItem($params);
	echo "successfully executed getitem operation \n";



}

catch (DynamoDbException $e)
{
	echo "Unable to get item:\n";
	echo $e->getMessage() . "\n";
}


 $src=$result['Item']["profile_pic"]["S"];

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Social Commerce</title>

    <!-- CSS   links-->
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    <link href="font-awesome-4.6.3/css/font-awesome.min.css" rel="stylesheet">
     <link rel="stylesheet" href="rating.css">

    <!-- js links-->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.1.1.min.js" type="text/javascript"></script>
<script src="home.js" type="text/javascript"></script>


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


      div.sidebar
        {
            background:blue;
            width: 20%;
            /*padding: 0 0 0 5%;*/
            float: left;
        }

    #btn-votes
    {
        color:blue;

        }
        #btn-like
        {
        color:blue;

        }
        #btn-cr
        {
        color:blue;

        }

        #content
        {
            text-align: left;
        }


        body {
		background: #AED6F1  ;
         
            
	}

    .container1 {
		background:white;
		width:600px;
	}

	.container {
		margin: 40px auto;

	}

    .jumbotron
    {
        width: 600px;
        height: 300px;
        align-content: center;
    }
.navbar
        {
            color:white  ;
            background: #1F618D  ;
        }
    </style>

</head>

<body>

  <nav class="navbar navbar-inverse navbar-fixed-top">

    
       <div class="col-md-5">
          <form class="navbar-form" role="search" >
            <div class="input-group add-on" style="width:600px;">
              <input class="form-control" placeholder="Search" name="srch-term" id="srch-term" type="text">
              <div class="input-group-btn">
                <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
              </div>
            </div>
          </form>
        
  
         
    </div>
    
       

    <div class="col-md-2 col-sm-6"  >
        <h2 style="font-color:green; text-align:center;">
           <b>AMABOOK</b>  
        </h2>
      </div>
  		<div class="container-fluid">
  			<button type="button" class="navbar-toggle"
  				data-toggle="collapse"
  				data-target=".navbar-collapse">
				<span class="sr-only">Toggle variation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
  			</button>

  			<div class="navbar-collapse collapse">
  				<ul class="nav navbar-nav navbar-right">
                    <li class="active" ><a href="home_final.php"><i class="fa fa-home" aria-hidden="true"></i> Home </a></li>
  					<li class="" ><a href="timeline_final.php"><i class="fa fa-user" aria-hidden="true"></i> Timeline </a></li>




  					<li class="" ><a href="logout.php"><i class="fa fa-users" aria-hidden="true"></i> Logout</a></li>
  				</ul>
  			</div>

  		 </div>

	</nav>
    <div class="container">
         &nbsp;
		&nbsp;
		&nbsp;
		&nbsp;
		      <div class="row">
			         <div class="col-md-3 col-sm-3" >

              				<?php echo '<img src="'.$src.'" class="img-thumbnail" alt="Social commerce" width="200" height="200" align="centre"> ';
                               //echo '<img src="'.$result.'" height="300" width="400" />';?>
              				<p><h2><?php echo $login_session;?></h2></p>

          			</div>


                <div class="col-md-6 col-sm-6">


                          <div class="jumbotron" >
                                  <form action="upload.php" method="post" enctype="multipart/form-data"  >



   <!-- <input type="hidden" name="size" value="1000000">-->
                                                <div style="width:600px; ">

                                                      <span style="width:300px;">
                                                          <label>Website name </label>
                                                               <select name="website_name">
                                                                <option value="Flipkart ">Flipkart</option>
                                                                <option value="Amazon ">Amazon</option>
                                                                <option value="Myntra ">Myntra</option>
                                                                <option value="Jabong ">Jabong</option>
                                                                <option value="Snapdeal ">Snapdeal</option>
                                                                <option value="HomeShop18 ">HomeShop18</option>
                                                                <option value="ebay ">ebay</option>
                                                                </select>
                                                       </span>

                                                <span style="width:300px;">
                                                  <label>Category  </label>
                                                   <select name="category">
                                                    <option value="electronics">Electronics</option>
                                                    <option value="mobiles and accessories ">Mobiles and Accessories </option>
                                                    <option value="Clothing">Clothing</option>
                                                    <option value="Books">Books</option>
                                                    <option value="Gifts">Gifts</option>
                                                    <option value="Footwear">Foot wear</option>
                                                    <option value="Accessories">Accessories</option>
                                                   </select>
                                                </span>

                                                </div>

                                                <div style="width:600px;">
                                                    <span style="width:300px;">
                                                    <label>Context</label>
                                                    <select name="context"><option value="owns">Owns</option>
                                                        <option value="ptb">Planning to buy</option>
                                                        <option value="ptg">Planning to gift some user </option>
                                                    </select>
                                                    </span>

                                                    <span style="width:300px;">
                                                    <label> Post Type</label>
                                                    <select name="post_type">
                                                    <option value="Poll">Poll</option>
                                                    <option value="Rating">Rating ***</option>
                                                    <option value="CR">Contribution request</option>
                                                    <option value="Like">Like only </option>

                                                    </select>
                                                    </span>

                                                </div>

                                            <div style="width:600px;">

                                            <label>Price of the product</label>
                                            <input class="input" name="price" type="text" value="" placeholder="Price..">

                                            </div>



                                            <div style="width:600px;">

                                               <label>Upload An Image</label>

                                               <div>
                                                <input type="file" name="file_upload" />
                                               </div>

                                            </div>

                                              <div>

                                                <textarea name="content" cols="40" rows="4" placeholder="say something about the image"></textarea></div>

                                                <div>
                                                <input type="submit" name="upload"  value="Upload Image" />
                                                </div>


                                        </form>
                                     </div>





			                     </div>


            <div class="col-md-3 col-sm-3">
                    <div class="dropdown">
                          <i class="fa fa-globe" aria-hidden="true"></i>
                                <button onclick="myFunction()" class="dropbtn">Notifications</button>
                                <div id="myDropdown" class="dropdown-content">
                                <div id="div_srishti"> &nbsp;
                                &nbsp;
                                &nbsp;
                                &nbsp;
                                </div>


                                 <script>
                                                   /*
                                                    */

                                 </script>


        <form action="sr_large.php" method ="post">
          <input type="submit" class='block' style="width:500px;" value="             See   all   Notifications                            " />
        </form>

      </div>
    </div>
    <script>
    /* When the user clicks on the button,
    toggle between hiding and showing the dropdown content */
    //srishti part
    function myFunction()

    {
      $.ajax({
                url: "sr_small.php",
               async: true,
                 success: function(result)
                  { //alert(result);

                  $("#div_srishti").html(result);
                  document.getElementById('div_srishti').innerHTML=result;
                  }

              });


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


            </div>

		</div>

		&nbsp;
		&nbsp;
		&nbsp;
		&nbsp;
		<div class="row">
             <div class="col-md-3 col-sm-3" style="text-align:left;  height:100px;" >
                 <p><img src="plug.png"/>Electronics</p>
                  <p><img src="books.png"/>Books</p>

                  <p><img src="smartphone.png"/>Mobile and accesories</p>
                  <p><img src="dress.png"/>Clothing</p>
                  <p><img src="gift.png"/>Gifts</p>
                 <p><img src="high-heel.png"/>Footwear</p>
                 <p><img src="bag.png"/>Accesories</p>
            </div>

             <div class="col-md-6 col-sm-6" style="text-align:center;">
                <div class="container1">
                        <div class="jumbotron">
                            <h1>Welcome </br> <?php echo $login_session;?> </h1>

                            <p>&nbsp;</p>



                        </div>

                        <?php  if($result['Item'])
                             {

                                 $lim=count($result['Item']["mutual_friends"]["NS"]);

                             //for($i=0;$i<$lim;$i++)
                              // { //echo $result['Item']["mutual_friends"]["NS"][$i]."\n";
                                 $i=0;
                                //$j=$result['Item']["mutual_friends"]["NS"][$i];
                                $arr=json_encode($result['Item']["mutual_friends"]["NS"]);
                               // echo gettype($arr);
                               // echo $arr;
                                //echo $j;

                                ?>
                                <script> //alert(<?php //echo $j;?>);
                                    load(<?php echo $arr?>,<?php echo $lim?>,<?php echo $i?>);
                                </script>

                               <!-- echo '<button onclick="load('.$j.')">click</button>';-->


                             <?php  //}

                                 //echo $data;


                             }
                               ?>

            <!--<button onclick="load()">click </button>-->

                          <div id="content">   inside content of container1
                           </div>
	              </div>

              </div>




               <!-- <button onclick="load()">click </button>-->



            <div class="col-md-3 col-sm-3" style="text-align:center;">
                   
            </div>

    </div>

</div>


    </body>
</html>
