<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo $_SESSION["VOTING_proj"]; ?></title>
    <link href="view/imgs/favicon.ico" rel="shortcut icon" />
    <!-- Bootstrap -->
    <link href="view/gene/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="view/gene/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="view/gene/build/css/custom.min.css" rel="stylesheet">
    <link href="view/css/main.css" rel="stylesheet">
	<style>
        #kidsbg {
            background: #09F url("view/imgs/bg.jpg") repeat fixed;
            font-family:Arial, Helvetica, sans-serif;
			padding:2em;
        }
        h1 {
            color:#fff;
            font-size:4em;
            
        }
        .candlist {
            height: auto;
			width:100%;
            padding: 0.2em;
            background-color:#069;
            color: #FFF;
            font-size:2em;
            text-transform:uppercase;
            border:0.15em #fff solid;
            margin-top:0.2em;
            
        }
        
        .candlist:hover {
          background-color: #060;
        }
        
        a {
            text-decoration:none;
        }
        
        #status_msg{ 
        
            height: auto;
			width:100%;
            padding: 0.2em;
            background-color: #FF0;
            color: #00;
            font-size:2em;
            text-transform:uppercase;
            border:0.15em #fff solid;
            margin-top:0.2em;
            text-align:center;
        
        }
    </style>
    
  </head>

  <body id="kidsbg">
    <div class="container">
        <!-- page content -->
        <h1>Choose your candidate</h1>
        
        <div class="col-xl-5 col-md-5 col-sm-12 col-xm-12">
            
            <div id="vote_candlist" >
            <?php
                foreach($vt_candidate_list as $clist) {
                    ?>
                    <a href="#" onclick="markvote(<?php echo $clist["id"]  ?>)">
                        <div class="candlist">
                            <?php echo $clist["cname"]; ?>
                        </div>
                    </a>
                    <?php
                }
            ?>
            </div>
            <div class="clear"></div>
            <p>&nbsp;</p>
            <div id="status_msg" >
                Ready to Vote
            </div>
            <audio id="success_audio">
              <source src="beep.mp3" type="audio/mpeg">
            </audio>
        </div>
        <!-- /page content -->
    </div>

    <!-- jQuery -->
    <script src="view/gene/vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="view/gene/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="view/gene/build/js/custom.min.js"></script>
    
    <script>
    function markvote(candid) {
		document.getElementById('vote_candlist').style.pointerEvents = 'none';
        $.ajax({   
            type: 'POST',
            url: "controller/markvote.php",
            data: {
                candidate_id:candid
            },
            success: function(result){
                $("#status_msg").text("Thank You!  Your Vote is Recorded");
                playAudio();
            },
            error: function (ts) {
                alert("Failed to mark vote");
            }
        });
    }
    
    function playAudio() {
        
        var sucs_audio = document.getElementById("success_audio"); 
        sucs_audio.play(); 
        setTimeout(function(){
            $("#status_msg").text("Ready to Vote");
            document.getElementById('vote_candlist').style.pointerEvents = 'auto'; 
        }, 10000);
        
    }
    
    </script>
	
  </body>
</html>



