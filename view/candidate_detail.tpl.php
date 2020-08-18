<?php
$pageTitle= "Candidate";
include_once("view/header.tpl.php");
?>
<!-- page content -->
    <div class="card">
        <div class="title_left">
            <h3>Candidate Details</h3>
        </div>

        <div class="card-header card_hd_bg" style="background-color: #f6f8f8">
        <div class="filter-menu" align="right">
                    <a href="candidate">
                    <button class="btn btn-primary" type="button"><i class="fa fa-backward "></i> Back</button>
                </a>
        </div>
    </div>
    <div class="card-body card_bg">
            <div class="form-border">
                <!-- Form -->
                <form action="" method="post" enctype="multipart/form-data">
                    <?php
                       $form_controls->txt_box("id", "Candidate ID", "text", "", "", 1, 1, "", 12, 200);
                       $form_controls->txt_box("classname", "Class", "text", "", "", 1, 0, "", 256, 500);
					   $form_controls->txt_box("cname", "Name", "text", "", "", 1, 0, "", 256, 500);
					   
                   ?>
                     <div class="form-group row">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-success btn-lg btn-block" name="submit"
                                    style="width: 400px"> Save
                            </button>
                        </div>
                    </div>

                </form>
                <div class="error-msg">
                    <?php echo $error_msg; ?>
                </div>
                <!-- End Form -->
            </div>
        </div>
    </div>


<?php
include_once("view/footer.tpl.php");
?>
<script type="text/javascript">
   $(document).ready(function(){
    });
</script>