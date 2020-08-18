<?php
include_once("view/header.tpl.php");
?>
<style>
.blinking{
    animation:blinkingText 0.8s infinite;
}
@keyframes blinkingText{
    0%{     color: #000;    }
    50%{    color: transparent; }
    100%{   color: #000;    }
}
.tot {
	background-color: #ccc;
	color: #000;
	font-weight: bold;
	text-transform:uppercase;
}
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.js"></script>
<p>&nbsp;</p>
<div>
	<div class="col-md-12">
    <form action=""  enctype="multipart/form-data" method="post">
       <b>SELECT A CLASS:</b>
        <select name="class_name"  id="class_name" style="height:33px;width:200px;">
            <option value=""></option>    
            <?php
                foreach($classary as $clist) {
                    echo '<option value="'. $clist .'"';
                    if($class_name == $clist) {
                        echo " selected ";	
                    }
                    echo '>'. $clist .'</option>';
                }
            ?>
        </select>
        <button id="btn_refresh" name="btn_refresh" type="submit" class="btn btn-success" >SUBMIT</button>
        <button id="btn_print" name="btn_print" type="button" class="btn btn-warning"  >PRINT</button>
    </form>
    </div>
    <div class="col-md-6">
    	<div style="border:1px solid #CCC; width:100%; margin-top:15px; background-color:#FFF; padding:10px">
       		<table id="tbl_result" class="table table-bordered table-striped table-hover">
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
            <div style="text-decoration:blink; background-color:#FF0; padding:10px; text-align:center;">
            <?php
			if($leadvote >0) {
				echo "<h2 class='blinking'>CANDIDATE <b>" . strtoupper(implode(", ",$leader))."</b> IS LEADING</h2>";
			}
			?>
			</div>
        </div>
    </div>
    <div class="col-md-6" style="text-align:center; padding:15px;">
        <canvas id="myChart"  style="padding:10px; height:400px; border:1px #ccc solid; width:100%"></canvas>
        <script>
        var ctx = document.getElementById("myChart").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [<?php
                    $cand = array();
                    foreach($vt_vote_list as $votes) {
                        $cand[] = "['" . $votes["cname"] . "','Votes:" . $votes["vote"] ."']";
                    }
                    echo implode(",",$cand);
                    ?>],
                datasets: [{
                    label: 'Vote',
                    data: [<?php
                    $vot = array();
                    foreach($vt_vote_list as $votes) {
                        $vot[] = $votes["vote"];
                    }
                    echo implode(",",$vot);
                    ?>],
                    backgroundColor: 'rgb(255, 99, 132)',
                    borderColor: 'rgb(255, 99, 132)',
                    borderWidth: 1
                    
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        },
                        stacked: true,
                        gridLines: {display: true}
                    }],
                    xAxes: [{
                        stacked: true,
                        gridLines: {display: false},
                        ticks: {
                            maxRotation:90,
                            padding:20
                        }
                    }]
                },
                legend: {
                    display: false,
                },
                responsive: true,
                
            }
        });
        </script>
    </div>
</div>
<script>
	setInterval(function() {
		window.location.reload(1);
	},6000);
</script>    
    
    

<?php
include_once("view/footer.tpl.php");
?>

<script type="text/javascript">
   $(document).ready(function(){
		$('#tbl_result').DataTable( {
			order: [],
			pageLength: 50,
			"paging":   false,
			"ordering": false,
			"info":     false,
			"bFilter": false		
			
		} );		   
    });
	
	$("#btn_print").click( function() {
        var clsname = $( "#class_name option:selected" ).text();
		window.open("print_vote?classname="+clsname, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=0,left=0,width="+screen.width+",height="+ screen.height+"");
    });
</script>
