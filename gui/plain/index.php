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
      body{
        height:100%;
        margin: 0;
        padding: 0;
      }
      #responses {
        
        right:200px;
        bottom:50px;
        width: 300px;
        min-width: 400px;
        height: auto;
        min-height: 150px;
        max-height: 500px;
        overflow: auto;
        border: 3px inset #666;
        margin-left: auto;
        margin-right: auto;
        padding: 1px;
        background-color: #2c3e51;
      }
      #wrapper{
      position:fixed;
        right:170px;
        bottom:0px;
        
        
        
        min-width: 150px;
        max-height: 500px;
        overflow: auto;
        border: 3px inset #666;
        margin-left: auto;
        margin-right: auto;
        padding: 5px;
        background-color: #8db654;
        z-index: 100;
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
        width: 20%;
        min-width: 40px;
        
        min-height: 50px;
        max-height: 500px;
        overflow: auto;
        border: 3px inset #666;
        margin-left: auto;
        margin-right: auto;
        padding: 5px;
        background-color: #8db654;
        z-index: 100;
      }
      .shut{
        float: center;
      }
      a{text-decoration:none;font-size: 100%;color:#8db654 }
      a:hover{
        color:#2c3e51;
      }
    </style>
  </head>
  
  <?php 
    if(isset($_GET['login'])&&$_GET['login']==true){
?>
    <body onload = "">
    <iframe src="http://www.grabon.in/" height="775" width="99%"></iframe>
    <div id = "wrapper" style="">
      <div id = "top">
        <p class = "shut" style="text-align:center;color:white">
          Talk to <a id = "exit" href = "index.php"onclick ="myfunction({window.location = 'index.php';}) " style="color: #2c3e51">Param</a>!
        </p>
        <hr>
       </div>
    
    <div id = "frame2" style = "">
    <div id="responses" style="">
        
       <?php echo $display ?>
      </div>
      <form name="chatform" method="post" action="index.php?login=true#end" onsubmit="if(document.getElementById('say').value == '') return false;">
          <div id="input" style="">
          <label for="say"></label>
         <hr>
         <input type="text" name="say" id="say" size = "50%"/>
         <input type="submit" name="submit" id="btn_say" value="send" />
         <input type="hidden" name="convo_id" id="convo_id" value="<?php echo $convo_id;?>" />
          <input type="hidden" name="bot_id" id="bot_id" value="<?php echo $bot_id;?>" />
          <input type="hidden" name="format" id="format" value="<?php echo $format;?>" />
        </div>
      </form>
      
    </div>
    </div>
  </body>
 <?php
}
else{
?>
  <script type="text/javascript"
        src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js">
          
  </script>
  <script type="text/javascript">
$(document).ready(function(){
    //If user wants to end session
    $("#exit").click(function(){
        {window.location = 'index.php';}      
    });
});
$(document).ready(function(){
    //If user wants to end session
    $("#enter").click(function(){
        var count
        {window.location = 'index.php?login=true';}      
    });
});
</script> 
<iframe src="http://www.grabon.in/" height="765px" width="99%"></iframe>
<body style="height:100%;">

    
    <div id = "top1">
      <p style="text-align:center;">
         <a id="enter" href="#">Param</a>
      </p>      
    </div>

    
  </body>
<?php
    
  }
?>
</html>
