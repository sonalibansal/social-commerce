 var start_key1=0;
 var start_key2=0;
 var start_key3=0;
   // var uf_id=" ";
 var g_arr1=" ";
 var g_lim=-1;
 var g_index=-1;
 //var index=2;
 //var lim;
var u_id;
   ///alert("inside home.js");
         //var u_id=" ";
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
              success: function(data)
              {
                   // alert("hi");
                alert(data);
                     $('#btn-votes-'+id).css('color', 'blue');

                   // document.getElementById("btn-votes-"+id).style.color="blue";
                //votes = votes+1;
                //alert(votes);
              }
         });


  }
function set1(lim)
{
  g_lim=lim;
  }
function set2(index)
{
  g_index=index;
  //alert("inside set2");
  //alert(g_index);
}
function set3(arr1)
{
  g_arr1=arr1;
  //alert("inside set3");
  //alert(g_arr1);
}


  function load(arr1,lim,index)
   {
            //alert("ji");
            //var u=JSON.parse(arr1);
            //alert(typeof (u));
            u_id=arr1[index];
            //alert(u_id);
            //alert("hi");
           /* alert(u_id);
            alert(lim);

            alert(index);*/
            index=index+1;
            set1(lim);
            set2(index);
            set3(arr1);

            $.ajax
            ({
                url:"load_initial_homepage.php",
                data:"id="+u_id,
                type:"POST",
                success:function(data1)
                {
                    var myjson=data1;
                    var j=JSON.parse(myjson);
                    document.getElementById("content").innerHTML+=j.data;
                    start_key1=j.key_value1;
                    start_key2=j.key_value2;
                    start_key3=j.key_value3;
                   }
            });
    }

 $(window).scroll(function() {
    //uf_id=u_id;
    if($(window).scrollTop() + $(window).height() >= $(document).height()) {
       if(loadFlag==false) {
               //uf_id=u_id;
        exclusivestart_key1=parseInt(start_key1);
                exclusivestart_key2=parseInt(start_key2);
                exclusivestart_key3=start_key3;

        loadFlag = true;
               // if(exclusivestart_key!=null)

                console.log('final_homepage.php',"exclusivestartkey1="+exclusivestart_key1+"&exclusivestartkey2="+exclusivestart_key2+"&exclusivestartkey3="+exclusivestart_key3);
                 $.ajax({
                    url:"final_homepage.php",
                   data:"exclusivestartkey1="+exclusivestart_key1+"&exclusivestartkey2="+exclusivestart_key2+"&exclusivestartkey3="+exclusivestart_key3,
                    type:"POST",
                success:function(data)
                    {
                        loadFlag=false;
                      //alert(data);
                       // alert("hi");
                        var myjson=data;
                        try{
                      var j=JSON.parse(myjson);
                       // var j=jQuery.parseJSON(myjson);
                        document.getElementById("content").innerHTML+=j.data;
                       // alert(j.key_value);
                        //start_key=j.key_value;
                       // alert(start_key);
                         start_key1=j.key_value1;
                        start_key2=j.key_value2;
                        start_key3=j.key_value3;
                        //alert(typeof j.key_value1);
                        //  alert(typeof start_key1);
                         // alert(start_key2);
                         // alert(start_key3);

                        //alert(data1);
                        var t=JSON.stringify(start_key3);
                  //alert(typeof t);


                      }
                        catch(e){
                           //alert("inside catch");


                            }
                            if(t==null)
                        {
                          //alert("t");
                          //alert(index);
                          //alert(lim);
                          if(g_index<g_lim)
                          {
                            //alert("lim");
                            //alert(typeof arr1[index]);
                            //u_id=(string)(arr1[index]);
                            load(g_arr1,g_lim,g_index);
                          }
                        }
                    }

                 });

      }
    }
  });
