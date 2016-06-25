<?php

  /***************************************
  * http://www.program-o.com
  * PROGRAM O
  * Version: 2.5.4
  * FILE: gui/plain/index.php
  * AUTHOR: Elizabeth Perreau and Dave Morton
  * DATE: MAY 17TH 2014
  * DETAILS: simple example gui
  ***************************************/
  $display = "";
  $thisFile = __FILE__;
  if (!file_exists('../../config/global_config.php')) header('Location: ../../install/install_programo.php');
  require_once('../../config/global_config.php');
  require_once ('../chatbot/conversation_start.php');
  $get_vars = (!empty($_GET)) ? filter_input_array(INPUT_GET) : array();
  $post_vars = (!empty($_POST)) ? filter_input_array(INPUT_POST) : array();
  $form_vars = array_merge($post_vars, $get_vars); // POST overrides and overwrites GET
  $bot_id = (!empty($form_vars['bot_id'])) ? $form_vars['bot_id'] : 1;
  $say = (!empty($form_vars['say'])) ? $form_vars['say'] : '';
  $convo_id = session_id();
  $format = (!empty($form_vars['format'])) ? $form_vars['format'] : 'html';
?>
<!DOCTYPE html>
<html>
  <head>
    <link rel="icon" href="./favicon.ico" type="image/x-icon" />
    <link rel="shortcut icon" href="./favicon.ico" type="image/x-icon" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Param</title>
    <meta name="Description" content="copy rights enabled" />
    <meta name="keywords" content="param v-1.0" />
    <style type="text/css">
      /*body{
        height:100%;
        margin: 0;
        padding: 0;
      }*/
      #responses {
        
        right:200px;
        bottom:50px;
        height: 280px;
        width:98%;
        min-height: 150px;
        max-height: 500px;
        overflow: hidden;
        border: 1px inset #666;
        margin-left: auto;
        margin-right: auto;
        padding: 2px;
        background-color: #ffffff;
        
      }
      #frame1{
        position:fixed;
        right:170px;
        bottom:-1px;      
        width: 300px;
        min-height: 350px
        max-height: 400px;
        overflow: hidden;
      }
      #wrapper{
      position:fixed;
        right:170px;
        bottom:-1px;      
        width: 300px;
        min-height: 350px
        max-height: 400px;
        overflow: hidden;
        border: 1px inset #666;
        margin-left: auto;
        margin-right: auto;
        padding: 5px;
        background-color: #2c3e51;
        border-top-right-radius: 3%;
        border-top-left-radius: 3%;
      }
      #input {
        
        right:80px;
        bottom:10px;

        min-width: 75%;
        
        
      }
      .botsay{
        color: white;
      }
      .usersay{
          color:white;
      }
      #top1{
        position:fixed;
        right:90px;
        bottom:0px;
        width: 300px;
        min-width: 300px;
        
        min-height: 50px;
        max-height: 500px;
        overflow: auto;
        border: 3px inset #666;
        margin-left: auto;
        margin-right: auto;
        padding: 5px;
        background-color: #2c3e51;
        
      }
      .human, .bot_res{
          display: inline-block;
    padding-top: 5px;
    padding-right: 10px;
    padding-bottom: 5px;
    padding-left: 10px;
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
    border-bottom-right-radius: 10px;
    border-bottom-left-radius: 10px;
    color: #f5f5f5;
    background-color: #8db654;
    white-space: pre-wrap;
      }
      #say{
         border-top-left-radius: 10px;
    border-top-right-radius: 10px;
    border-bottom-right-radius: 10px;
    border-bottom-left-radius: 10px;
    outline: none;
    box-shadow:2px solid #4ddbff opacity:40%;
    padding-left: 10px;

      }
      .shut{
        float: center;
      }
      a{text-decoration:none;font-size: 100%;color: #2c3e51; }
      a:hover{
        color:#2c3e51;
      }
      .user_input> input
      {width: 95%;height: 29px;
      border-top-left-radius: 10px;
    border-top-right-radius: 10px;
    border-bottom-right-radius: 10px;
    border-bottom-left-radius: 10px;
   }
      .user_input> input:active
      {
        box-shadow:2px solid #4ddbff;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
         border-bottom-right-radius: 10px;
         border-bottom-left-radius: 10px;
        height: 29px;
      }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  </head>
  
    <body>
    
    <iframe id  = "frame1"src="http://www.grabon.in/" style="position:fixed; top:0px; left:0px; bottom:0px; right:0px; width:100%; height:100%; border:none; margin:0; padding:0; overflow:hidden; z-index:0;"></iframe>
    <!--Add style visiblity hidden for wrapper class-->
    <div id = "wrapper" style="visibility:hidden;">
      <a style="cursor:pointer" id = "enter"> 
      <div>
        <p style="text-align:center;color:white;height:10px;margin-top:2px;">
          <b style="font-family:serif;font-size:18px;color:#8db654">Chat with Param!</b><img src="download.png" width="20px" height="20px" style="float:left;">

        </p>
       </div></a>
    
    <div id = "frame2" style = "">
    <div id="responses" style="color:black;">
      <?php echo $display; ?>

      </div>
      <form id="chatform" method="post" action="index.php" onsubmit="if(document.getElementById('say').value == '') return false;">
          <div id="input" style="">
          <label for="say"></label>
         <hr style="color:#8bd651;opacity:0%;">
         <div class="user_input">
          <input type="text" name="say" id="say"  size = "99%" placeholder="Hi, I am Param..." style = "font-size:90%;font-family:;"required />
        </div>
         
         <input type="hidden" name="convo_id" id="convo_id" value="<?php echo $convo_id;?>" />
          <input type="hidden" name="bot_id" id="bot_id" value="<?php echo $bot_id;?>" />
          <input type="hidden" name="format" id="format" value="<?php echo $format;?>" />
        </div>
      </form>
      
    </div>
    </div>
  </body>
  <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
  <script type="text/javascript">

$(document).ready(function(){
    $('#responses').html('<br>');
    $("#wrapper").css("visibility","visible");
    $("div#frame2").hide();
        $("a#exit").hide();
    //If user wants to end session
    $("#enter").click(function(){
        if(($('#frame2').is(':hidden'))){
        $("div#frame2").show(300);
        $("a#exit").show(300);
      }
      else{
        $("div#frame2").hide(300);
        $("a#exit").hide();
      }
    });
    
});
</script> 

<script type='text/javascript'>
    
    $("#chatform").submit(function(event) {
      event.preventDefault();
        var sa = $('#say').val();
        $('#responses').append('<div style="text-align:right;" ><span class = "human">'+sa+"</span>&nbsp;&nbsp;"+"<img src ='user2.jpg' width = '20px' height = '20px'></div><br>");

       var posting = $.post("index.php",{say : sa, convo_id: $('#convo_id').val(), format: $('#format').val(), bot_id: $('#bot_id').val()});
      
      posting.done(function(data){
          
          var content = $(data).find(".botsay").html();
          content = content.substring(6);
          $("#responses").append('<div class="bot_response" >'+"<img src='icon.png' width='20px' height='20px'>&nbsp;&nbsp;<span class='bot_res'>"+content+"</span></div><br>");
         $("#responses").animate({ "scrollTop": $('#responses')[0].scrollHeight }, "fast")
      });
            $("#responses").animate({ "scrollTop": $('#responses')[0].scrollHeight }, "fast");
     $("#say").val("");
  });   
 
</script>

</html>
