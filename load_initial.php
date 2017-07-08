<?php
//function load(){
// include 'database_connect.php';
include 'session.php';

 $data ="";
$request = [
        'TableName' => "post",
        'IndexName'=>'created_time-index',
      'KeyConditionExpression' => 'User_id = :v_id',
        'ExpressionAttributeValues' =>  [
            ':v_id' => ['N' => $login_id],
            //':v_reply_dt' => ['S' => $fourteenDaysAgo]
			//':val'=>['S'=>'electronics']
        ],

		//'FilterExpression'=>"category=:val",
    'Select'=>'ALL_ATTRIBUTES',
        //'ProjectionExpression' => 'post_id,category,content,Website_name,post_type,photo,created_time,context',
        'ScanIndexForward' => false,
        //'ConsistentRead' => true,
        'Limit' => 1
    ];


	$response = $dynamodb->query($request);

    foreach ($response['Items'] as $key => $value) {
        $data=$data.' <div id="votes-'.$value['post_id']['N'].'">';
				$data = $data . '<blockquote><p>' . $value['post_id']['N'] . '</p></blockquote>';
                $data = $data . '<blockquote><p>' . $value['created_time']['S'] . '</p></blockquote>';
			   $data = $data . '<blockquote><p>' . $value['category']['S'] . '</p></blockquote>';
			   $data = $data . '<blockquote><p>' .  $value['content']['S']. '</p></blockquote>';
			   $data = $data . '<blockquote><p>' . $value['Website_name']['S'] . '</p></blockquote>';

               $data = $data . '<blockquote> <img src="'.$value['photo']['S'].'" height="300" width="200" /></blockquote>';
			   $data = $data . '<blockquote><p>' . $value['context']['S'] . '</p></blockquote>';
         $data = $data . '<blockquote><p>' . $value['post_type']['S'] . '</p></blockquote>';
         $post_id=$value['post_id']['N'];
            switch($value['post_type']['S'])
            {

                case 'Poll':
                            $reaction="Polled";
                            $data=$data.'<button onclick="insert_votes('.$post_id.',\'Polled\')">
                                        <i class="fa fa-hand-pointer-o" aria-hidden="true" id="btn-votes"></i>
                                        </button> ';


                            break;
                  case 'Like':$reaction="Liked";
                                $data=$data.'<button onclick="insert_votes('.$value['post_id']['N'].',\'Liked\')">
                                <i class="fa fa-thumbs-o-up" aria-hidden="true" id="btn-like"></i>
                             </button> ';

                                break;
             case 'CR':$reaction="Contributed";
                   $data=$data.'<button onclick="insert_votes('.$post_id.',\'Contributed\')">
                     <i class="fa fa-gift" aria-hidden="true"  id="btn-cr"></i>
                          </button> ';
                   // $data=$data.'<button onclick="<script>alert(\'hi\');</script>">



                                break;

             default :$data=$data.'<div class="rating ">
                        <input class="star star-5" id="star-5" type="radio" name="star" value="5" OnClick="insert_votes('.$post_id.',this.value);"/>

                        <label class="star star-5" for="star-5" title="5"> </label>

                        <input class="star star-4" id="star-4" type="radio" name="star" value="4" OnClick="insert_votes('.$post_id.',this.value);" />

                        <label class="star star-4" for="star-4" title="4"></label>

                        <input class="star star-3" id="star-3" type="radio" name="star" value="3" OnClick="insert_votes('.$post_id.',this.value);"/>

                        <label class="star star-3" for="star-3" title="3"></label>

                        <input class="star star-2" id="star-2" type="radio" name="star" value="2" OnClick="insert_votes('.$post_id.',this.value);"/>
                        <label class="star star-2" for="star-2" title="2"></label>

                        <input class="star star-1" id="star-1" type="radio" name="star" value="1" OnClick="insert_votes('.$post_id.',this.value);"/>

                        <label class="star star-1" for="star-1" title="1"></label>
                    </div>';

                    break;

            }
    $data=$data.' <div class="label-votes">';
        $get_votes=[
                'TableName'=>'count',
                'Key'=>['post_id'=>['N'=>$value['post_id']['N']]
                       ]
            ];
            $result1=$dynamodb->getItem($get_votes);



            if($result1['Item'])
            {
                $total=$result1['Item']['reaction_count']['N'] ;
                $p_type=$value['post_type']['S'];
                switch($p_type)
                {
                        case 'Poll':$data=$data.$total." people Voted this";
                                    break;
                         case 'Like':$data= $data.$total." people liked this";
                                    break;

                         case 'Rating':$data=$data.$total." people rated this";
                                    break;

                         case 'CR': $data=$data.$total." people contributed for this gift ";
                                    break;


                }
                //echo $total."Vote(s)";
            }
            else
            {

                $p_type=$value['post_type']['S'];
                switch($p_type)
                {
                        case 'Poll': $data=$data." 0 people Voted this";
                                    break;
                         case 'Like':$data= $data."0 people liked this";
                                    break;

                         case 'Rating': $data= $data."0 people rated this";
                                    break;

                         case 'CR': $data= $data."0 people contributed for this gift ";
                                    break;


                }
            }
        $data=$data.'</div>';
        $data=$data.'</div>';

    }





     $value1=$response['LastEvaluatedKey']['User_id']['N'];
 $value2=$response['LastEvaluatedKey']['post_id']['N'];
 $value3=$response['LastEvaluatedKey']['created_time']['S'];

   // $array=array($data,$value);
//$value=$response['LastEvaluatedKey']['U';
    $num=4;
    //
   $array=array("data"=>$data,"key_value1"=>$value1,"key_value2"=>$value2,"key_value3"=>$value3);
   $json=json_encode($array);
    echo $json;
    //$value=(int)$response['LastEvaluatedKey']['post_id']['N'];
  /// echo $value;
  // echo gettype($value);
    //echo gettype($response['LastEvaluatedKey']['post_id']['N']);

 //$value=json_encode($response['LastEvaluatedKey']['post_id']['N']);


//$data=$data . '<div class="final" val=$value ></div>';
    //$data = $data . '<div class="final" val=' . $response['LastEvaluatedKey']['post_id']['N'] . '></div>';
	//$data=$data . '<div class="final" val=' .$response['LastEvaluatedKey']['post_id']['N']. '></div>';
	//return  $data;

//	}

 ?>
