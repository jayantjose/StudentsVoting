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
            background-color:#FFF;
            font-family:Arial, Helvetica, sans-serif;
			padding:2em;
        }
		.tot {
			background-color: #ccc;
			color: #000;
			font-weight: bold;
			text-transform:uppercase;
		}		
    </style>
    
  </head>

  <body id="kidsbg">
			<h2>Election Result for Class <?php echo $class_name; ?></h2>
            <p>Printed on: <?php echo date("d-m-Y H:i:s") ?></p>
			<table id="tbl_result" class="table table-bordered table-striped table-hover" style="width:500px">
            	<thead>
                	<th style="background-color:#FF9">Candidate</th>
                    <th style="background-color:#FF9">Votes</th>
                </thead>
                <tbody>
                	
                    <?php
					$leadvote = 0;
					$tot=0;
					foreach($vt_vote_list as $vlist) {
						if($vlist["vote"] > $leadvote) {
							$leadvote = $vlist["vote"];
						}
					?>
                        <tr>
                            <td><?php echo $vlist["cname"]; ?></td>
                            <td><?php echo $vlist["vote"]; ?></td>
                        </tr>
                   	<?php
						$tot = $tot + $vlist["vote"];
					}
					
					$leader=array();
					foreach($vt_vote_list as $vlist) {
						if($vlist["vote"] == $leadvote) {
							$leader[] = $vlist["cname"];
						}
					}
					?>
						<tr>
                            <td class="tot">Total Vote Polled</td>
                            <td class="tot"><?php echo $tot; ?></td>
                        </tr>                     
                </tbody>
			</table>
            <?php
			if($leadvote >0) {
				echo "<h2>CANDIDATE <b>" . strtoupper(implode(", ",$leader))."</b> IS ELECTED</h2>";
			}
			?>            
			<p>&nbsp;</p>
            <p>ELECTION SUPERVISOR</p>
            <p>Date: <?php echo date("d-m-Y"); ?></p>
            <p>&nbsp;</p>
            <p>SD</p>
            
            

    <!-- jQuery -->
    <script src="view/gene/vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="view/gene/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="view/gene/build/js/custom.min.js"></script>
    
    <script>
    	window.print();	
    </script>
	
  </body>
</html>



