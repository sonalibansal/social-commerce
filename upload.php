
   <?php
   //ini_set('max_execution_time', 300);
   $html="";
   set_time_limit(150);
   $post_id=uniqid('F');
   include 'session.php';

$post_id = preg_replace("/\D/","1",$post_id);
   //include 'database_S3_connect.php';

   date_default_timezone_set('Asia/Kolkata');
$date = date('D-M/d/Y h:i:s A', time());

 if(isset($_POST['upload'])) {
    $maxsize    = 20971552;
    $acceptable = array(

        'image/jpeg',
        'image/jpg',
        'image/png'
    );

    if($_FILES['file_upload']['size'] >= $maxsize)
     {  $error_1="File too large. File must be less than 512 kilobytes.";
        echo $error_1;
     //echo '<script>alert("'.$error_1.'")</script>';
    }
    elseif($_FILES['file_upload']['size']==0){
        $error_2='Invalid File';
        echo '<script>alert("'.$error_2.'")</script>';
    }


    elseif((!in_array($_FILES['file_upload']['type'], $acceptable)) && (!empty($_FILES['file_upload']['type']))) {
    $error_3='Format Not Supported.Only .jpeg ,.jpg, and .pngfiles are accepted';
        echo '<script>alert("'.$error_3.'")</script>';
    }

    else{

                $keyname =$post_id.$_FILES['file_upload']['type'];


          $tmp=$_FILES["file_upload"]["tmp_name"];



                    try {
                // Upload data.
                $result = $client->putObject(array(
                    'Bucket' => $bucket,
                    'Key'    => $keyname,
                    'SourceFile' => $tmp,
                    'ACL'    => 'public-read'
                ));
              $image=$result['ObjectURL'];
             // $html=',div><img src="'.$image.'" height="300" width="400" />'</div>;
              //echo '<img src="'.$image.'" height="300" width="400" />';

                // Print the URL to the object.
               // echo $result['ObjectURL'] . "\n";
                //echo $result['LastModified']->format(\DateTime::ISO8601)."\n";
            } catch (S3Exception $e) {
                echo $e->getMessage() . "\n";
            }
            $website_name=$_POST['website_name'];
            $category=$_POST['category'];
            $context=$_POST['context'];
            $post_type=$_POST['post_type'];
            $price=$_POST['price'];
            $content=$_POST['content'];
           $url=$image;


           try {


            $response = $dynamodb->putItem(array(
             'TableName' => "post",
              'Item' => array(
                  'post_id' => array( 'N' =>$post_id), // Primary Key
                  'Website_name' => array('S' => $website_name ),
                  'category' => array('S' => $category),
                  'content' => array('S' => $content),
                  'context' =>array('S' =>$context),
                  'created_time'=>array('S' => $date ),
                  'photo' =>array('S'=>$url),
                  'post_type'=>array('S'=>$post_type),
                  'price'=>array('N'=>$price),
                  'User_id'=>array('N'=>$login_id)
              ),

            //'ReturnValues' => 'ALL_OLD'
           ));
           // $value=json_encode($response['ReturnValues']);
          //  echo $value;
            echo "Added item\n";

        } catch (DynamoDbException $e) {
            echo "Unable to add item:\n";
            echo $e->getMessage() . "\n";
        }
           $html='<div><p>kate winslet posted a "'.$post_type.'" post</p></div>
                    <p>"'.$content.'"</p>
                    <div><img src="'.$image.'" height="300" width="400" />';
                    //if($post_type=="poll")
                     // $html=$html.<button>
            echo $website_name;
            echo "<br>";

            echo $category;
              echo "<br>";
            echo $context;
              echo "<br>";
            echo $post_type;
              echo "<br>";
            echo $price;
              echo "<br>";
            echo $content;
              echo "<br>";


          }
/*$post_array=array("post_id"=>$post_id,"user_name"=>$login_session,"context"=>$context,"category"=>$category);
   $post_json=json_encode($post_array);
   */

//echo gettype($json);
//$string=list($login_session,$query);
     /*
$file = fopen("C:\Python27\post.txt", "w+") or die("Unable to open file!");
      fwrite($file,$post_json);
      fclose($file);
      $handle = popen('C:\Python27\post.py 2>&1', 'r');
      //$read = fread($handle, 2096);
      //pclose($handle);
      */
//echo $read;
     // echo "login=".$read;

}



 ?>
 <html>

 <head><title>post created</title></head>
 <body>
  <div><?php echo '<img src="'.$image.'" height="300" width="400" alt="amazon.jpeg" />';?>
  </div>
     <a href="home_final.php">Go back to the home page</a>
 </body>
 </html>
