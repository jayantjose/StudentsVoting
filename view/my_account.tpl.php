<?php
$pageTitle= "Change Password";
include_once("view/header.tpl.php");
?>

<div class="row">
    <p>&nbsp;</p>
    

    <form action="" method="post" enctype="multipart/form-data" onSubmit="return validate()">
        <h1>My Account</h1>

        <?php
//      $form_controls->image_upload("prof_pict","User's Photo", "images/","user_detail",$application_path,$application_url);
        $form_controls->txt_box("user_uid","UID","hidden","","",1,1,"",12,200,1);
        $form_controls->txt_box("user_fname","First Name","text","","",1,0,"",50,200);
        $form_controls->txt_box("user_lname","Last Name","text","","",0,0,"",50,200);
        $form_controls->txt_box("user_email","Email","email","","",1,0,"",100,200);
        ?>

        <div class="form-group row">
                <label class="col-sm-2  col-form-label" for="txt_user_fname">Password</label>
                <div class="col-sm-10">
                        <input type="password" class="form-control " name="password" id="password" style="width:200px" >
                </div>
        </div>        
        
        <div class="form-group row">
                <label class="col-sm-2  col-form-label" for="txt_user_fname">New Password</label>
                <div class="col-sm-10">
                        <input type="password" class="form-control " name="new_password" id="new_password" style="width:200px" >
                </div>
        </div>        

        <div class="form-group row">
                <label class="col-sm-2  col-form-label" for="txt_user_fname">Confirm New Password</label>
                <div class="col-sm-10">
                        <input type="password" class="form-control " name="re_password" id="re_password" style="width:200px" >
                </div>
        </div>        
        
        <?php if (isset($message)) { ?>
            <div class="form-group row">
                <div class="col-sm-2 "></div>
                <div class="col-sm-10 ">
                    <?php echo $message; ?>
                </div>
            </div>
        <?php } ?>

        <div class="form-group row">
                <label class="col-sm-2  col-form-label" for="txt_user_fname"></label>
                <div class="col-sm-10">
                        <button type="submit" class="btn btn-success btn-lg btn-block" name="submit"
                        style="width: 200px"> Submit
                        </button>
                </div>
        </div>         


        <div class="clearfix"></div>
    </form>
    <div class="error-msg">
        <?php echo $error_msg; ?>
    </div>

</div>

<?php
include_once("view/footer.tpl.php");
?>

<script type="text/javascript">
    function validate() {
        if (document.getElementById('new_password').value !== document.getElementById('re_password').value) {
            alert("Passwords Do not Match");
            return false;
        }
    }
</script>
