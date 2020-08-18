<?php
$pageTitle= "Candidate";
include_once("view/header.tpl.php");
?>
<!-- page content -->
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Candidate</h3>
            </div>

            <div class="title_right">
                <div class="col-md-2 col-sm-2 col-xs-12 form-group pull-right top_search">
                    <a href="candidate_detail">
                        <button class="btn btn-primary" type="button"><i class="fa fa-plus-circle "></i>
                            Add New
                        </button>
                    </a>
                </div>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12">
                <div class="x_panel">
                    <div class="x_content">
                        <table id="datatable" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th style="width: 5%"></th>
                                <th style="width: 5%"></th>
<!--                                <th style="width: 5%"></th>-->
                                <th class="text-center" style="width:10px"></th>
                                <th class="text-center" style="width:">Class</th>
                                <th class="text-center" style="width:">Candidate</th>
                                
                            </tr>
                            </thead>


                            <tbody>
                            <?php
                            $i=1;
                            foreach ($candidate_list as $candidate) {
								if ($candidate['status'] == 1) {
									$img = "view/imgs/act.jpg";
									$cls = "deactivate";
								} else {
									$img = "view/imgs/deact.jpg";
									$cls = "activate";
								}
                                ?>
                            <tr>
                              <td class="text-center <?php echo $cls; ?>">
                                    <a href="candidate_detail?id=<?php echo $candidate['id'];  ?>"><img src="view/imgs/edit.png" alt="Edit" title="Edit"/></a></td>
                                <td class="text-center <?php echo $cls; ?>">
                                    <a href="#" onclick="<?php if($cls=="deactivate") echo "del_data"; else echo "restore_data" ?>('candidate_detail','<?php echo $candidate['id']; ?>'); return false"><img
                                    src="<?php echo $img; ?>" alt="<?php echo ucfirst($cls); ?>"
                                    title="<?php echo ucfirst($cls); ?>"/>
                                    </a>                                    
                              <td class="text-center <?php echo $cls; ?>"><?php echo $i;?></td>
                              <td class="text-left <?php echo $cls; ?>"><?php echo $candidate['classname']?></td>
                              <td class="text-left <?php echo $cls; ?>"><?php echo $candidate['cname']?></td>
                           </tr>
                            <?php $i++; } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- /page content -->
<script>

function del_data(page,id) {
	if(confirm("Do you wish to delete this record?")) {
		window.location = page+ "?deactivate="+id;
	}
}

function restore_data(page,id) {
	if(confirm("Do you wish to restore this record?")) {
		window.location = page+ "?activate="+id;
	}
}	

</script>
<?php
include_once("view/footer.tpl.php");
?>