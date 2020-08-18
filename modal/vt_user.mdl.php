<?php
class  vt_user_mdl{
	// method for inserting data
	public function insert_data($tbl_obj){
		$ins_sql='insert into vt_user
						(user_fname,
						 user_lname,
						 user_email,
						 user_password,
						 user_active,
						 user_type,
						 user_image,
						 user_date) 
				values	(
						 "' . $tbl_obj->get_user_fname() . '",
						 "' . $tbl_obj->get_user_lname() . '",
						 "' . $tbl_obj->get_user_email() . '",
						 password( "' . $tbl_obj->get_user_password(). '"),
						 "' . $tbl_obj->get_user_active() . '",
						 "' . $tbl_obj->get_user_type() . '",						
						 "' . $tbl_obj->get_user_image(). '",
						 now()
						 )';

		$GLOBALS['conn']->query($ins_sql);
		
		$new_udid = mysqli_insert_id($GLOBALS['conn']);
		
		if($new_udid>0){
			return $new_udid;
		}
		else{
			return false;
		}
		
	}//  end method for inserting data
	// method for update data
	public function update_data($tbl_obj){
			$up_sql='update vt_user  set 
							user_fname="'. $tbl_obj->get_user_fname().'",
							user_lname="'. $tbl_obj->get_user_lname().'",
							user_email="'. $tbl_obj->get_user_email().'",
							user_active="'. $tbl_obj->get_user_active().'",
							user_type="'. $tbl_obj->get_user_type().'",
							user_image="'. $tbl_obj->get_user_image().'"';

							
							$up_sql .=  'where user_uid='.$tbl_obj->get_user_uid();

            $GLOBALS['conn']->query($up_sql);
			
            if(strlen(mysqli_error($GLOBALS['conn'])) >0) {
            	return false;
            }
            else {
                return true;	
			}
						
	}//  end method for update data
	
	//login method
	public function user_login($p_email="123",$p_pass="345"){
		$sql_log='select * from  vt_user where user_email="'.$p_email.'" and user_password=password("'.$p_pass.'")';
		$rslt=$GLOBALS['conn']->query($sql_log);
		if($rslt->num_rows>0){
			$rw=$rslt->fetch_assoc();
			$_SESSION["VOTING_islogin"]=1;
			$_SESSION["VOTING_utype"]=$rw['user_type'];
			$_SESSION["VOTING_uid"]=$rw['user_uid'];
			$_SESSION["VOTING_user_image"]=$rw['user_image'];
			$_SESSION["VOTING_userfullname"]=$rw['user_fname']. " " . $rw['user_lname'];
			$_SESSION["VOTING_useremail"]=$rw['user_email'];

                return true;
		}
		else{
			$_SESSION["VOTING_islogin"]=0;
			$_SESSION["VOTING_utype"]=0;
			$_SESSION["VOTING_uid"]=0;
			$_SESSION["VOTING_userfullname"]="";
			$_SESSION["VOTING_useremail"]="";
			return false;
		}
		
	}//end login method
	//method for recover password
	public function recover_pass($p_email,$temp_pass,$password){
		$sql_log='select user_uid,user_fname,user_lname from  vt_user where user_email="'.$p_email.'" AND user_password=password("'.$password.'")';
		$rslt=$GLOBALS['conn']->query($sql_log);
		if($rslt->num_rows>0){
			$rw=$rslt->fetch_assoc();
			$sql_upd='update vt_user  set  
						user_password=password("'.$temp_pass.'") 
						where user_email="'.$p_email.'"';
			$GLOBALS['conn']->query($sql_upd);

            return true;
		}
		else{
			
			return false;
		}
	
	}//end of recover password
	// method for update status
	public function status_update($cat_id,$status){
		$up_sql='update vt_user  set 
						 user_active="'. $status.'" 
						where user_uid='.$cat_id;
						
		$GLOBALS['conn']->query($up_sql);				 
						
	}//  end method for update data
	
	// method for select data
	public function list_data($filter="1=1"){
		$dataset=array();
		$sql_sel='select * from vt_user where '.$filter;
		$rslt=$GLOBALS['conn']->query($sql_sel);
		while($rw=$rslt->fetch_assoc()){
			$dataset[]=$rw;
		}
		mysqli_free_result($rslt);
		return $dataset;
	}//  end method for select data
    
	public function fetch_user($user_obj,$id) {
		$sql_sel='select * from vt_user where user_uid=' . $id;
		$rslt=$GLOBALS['conn']->query($sql_sel);
                $rw=$rslt->fetch_assoc();
                
                $user_obj->set_user_uid($rw['user_uid']);
                $user_obj->set_user_fname($rw['user_fname']);
                $user_obj->set_user_lname($rw['user_lname']);
                $user_obj->set_user_email($rw['user_email']);
                $user_obj->set_user_active($rw['user_active']);
                $user_obj->set_user_password($rw['user_password']);
                $user_obj->set_user_date($rw['user_date']);
                $user_obj->set_user_image($rw['user_image']);
                $user_obj->set_user_type($rw['user_type']);
     }
	 
	 public function fetch_userid_bymail($user_email) {
		$sql_sel= 'select user_uid from vt_user where user_email like "'. trim($user_email) .'"';
		$rslt	= $GLOBALS['conn']->query($sql_sel);
		$uid 	= 0;
		if(mysqli_num_rows($rslt) >0) {
			$rw	 = $rslt->fetch_assoc();
			$uid = $rw['user_uid'];
		}
		mysqli_free_result($rslt);
		return $uid;
	 }

    public function remove_image($user_id){
        $up_sql='update vt_user  set 
						 user_image="" 
						where user_uid='.$user_id;

        $GLOBALS['conn']->query($up_sql);
    }
}
?>