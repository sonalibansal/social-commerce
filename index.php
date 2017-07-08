<?php

include 'core_users.php';

session_start();
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>AmaBook</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link href="style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script type="text/javascript" src="js/script.js"></script>
<script type="text/javascript" src="js/cufon-yui.js"></script>
<script type="text/javascript" src="js/arial.js"></script>
<script type="text/javascript" src="js/cuf_run.js"></script>
<link href="noti.css" rel="stylesheet" type="text/css" />

<script type="text/javascript">

          function get_window_width()
           {
              return  window.innerWidth;
           }


          function get_window_height()
           {
              return  window.innerHeight;
           }


</script>


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



</head>
<body>
<div class="main">
  <div class="main_resize">
    <div class="header">
      <div class="logo">
        <h1><a href="#"><span>AmaBook</span></a></h1>
      </div>
      <div align="center" class="search">
        <form method="post" id="search" action="welcome.php" enctype="multipart/form-data">
          <span>
          <input type="text" placeholder="search..."  name="search" id="s" />
          <input  name="searchsubmit" type="submit" src="" value="GO" id="searchsubmit" class="btn"  />
          </span>
        </form>
        <!--/searchform -->
        <div class="clr"></div>
      </div>
      <div class="clr"></div>
      <div class="menu_nav">
        <ul>
          <li class="active"><a href="index.html">Timeline</a></li>
          <div class="dropdown">
      <button onclick="myFunction()" class="dropbtn">Notifications</button>
      <div id="myDropdown" class="dropdown-content">
       <div id="div1"></div>

        <script>
          $.ajax({
              url: "notifications/small.php",
              //dataType: "script",
              async: false,
              success: function(result)
              { $("#div1").html(result);}

               });




        </script>


        <br>
        <br>
        <form action="notifications/large.php" method ="post">
          <input type="hidden" id="W" name="ScreenWidth" />
          <input type="hidden" id= "H" name="ScreenHeight" />
          <input type="submit" width ="500px" value="See all Notifications" />
        </form>


        <script>
        document.getElementById("W").value=get_window_width();
        document.getElementById("H").value=get_window_height();
        </script>




      </div>
    </div>

          <!--/Add more menu bar items here -->
        </ul>
        <div class="clr"></div>
      </div>
    </div>
    <div class="content">
      <div class="content_bg">
        <div class="mainbar">
          <div class="article">
            <h2><span>Homepage</span></h2>
            <div class="clr"></div>

            <img src="images/images_1.jpg" width="613" height="193" alt="" />
            <div class="clr"></div>
          </div>
          <div class="article">
            <h2><span>Lorem Ipsum</span> Dolor Sit</h2>


            <img src="images/images_2.jpg" width="613" height="193" alt="" />
            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec libero. Suspendisse bibendum. Cras id urna. <a href="#">Morbi tincidunt, orci ac convallis aliquam, lectus turpis varius lorem, eu posuere nunc justo tempus leo.</a> Donec mattis, purus nec placerat bibendum, dui pede condimentum odio, ac blandit ante orci ut diam. Cras fringilla magna. Phasellus suscipit, leo a pharetra condimentum, lorem tellus eleifend magna, eget fringilla velit magna id neque. Curabitur vel urna. In tristique orci porttitor ipsum. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec libero. Suspendisse bibendum. Cras id urna. Morbi tincidunt, orci ac convallis aliquam.</p>
            <p>Aenean commodo elit ac ante dignissim iaculis sit amet non velit. Donec magna sapien, molestie sit amet faucibus sit amet, fringilla in urna. Aliquam erat volutpat. Fusce a dui est. Sed in volutpat elit. Nam odio tortor, pulvinar non scelerisque in, eleifend nec nunc. Sed pretium, massa sed dictum dapibus, nibh purus posuere magna, ac porta felis lectus ut neque. Nullam sagittis ante vitae velit facilisis lacinia. Cras vehicula lacinia ornare. Duis et cursus risus. Curabitur consectetur justo sit amet odio viverra vel iaculis odio gravida. Ut imperdiet metus nec erat.</p>


          </div>
          <div class="pagenavi"><span class="pages">Page 1 of 2</span><span class="current">1</span><a href="#">2</a><a href="#" >&raquo;</a></div>
        </div>
        <div class="sidebar">
          <div class="gadget">
            <h2 class="star"><span>Profile Information</span></h2>
            <div class="clr"></div>
            <ul class="sb_menu">
            <li>Name </a></li>
        <li>Age</a></li>
        <li>Location</a></li>

                       <!--/Add more chat list items here -->



            </ul>

        </div>
        <div class="clr"></div>
      </div>
    </div>
  </div>
  <div class="sidebar1">
        <h2 class="star"><span>Chat List</span></h2>

      <iframe src="login_users.php"></iframe>

  </div>
</div>
</body>
</html>
