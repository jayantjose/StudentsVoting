<?php
include_once("view/header.tpl.php");
?>
<style>
	h3 {
		color:#FFF;
	}
</style>
<p>&nbsp;</p>
<p>&nbsp;</p>

<div class="container h-100 d-flex justify-content-center" style="width:300px">
    <div class="jumbotron my-auto text-center" style=" background-color: #99F; padding:10px">
    <form action="dovote" target="_new" enctype="multipart/form-data" method="post">
        <div class="form-group">
        	<h3>Select a  Class</h3>
        </div>
        <div class="form-group">
                <select name="classname" style="width:100%; text-align:center; height: 40px">
                    <option value=""></option>    
                    <?php
                        foreach($classary as $clist) {
                            echo '<option value="'. $clist .'">'. $clist .'</option>';
                        }
                    ?>
                </select>
        </div>
        <button type="submit" class="btn btn-success" style="width:100%; ">Start Voting</button>
    </form>
            
    </div>
</div>



<?php
include_once("view/footer.tpl.php");
?>