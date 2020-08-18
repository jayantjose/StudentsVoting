<?php
// Modal for Table - vt_candidate

class vt_candidate_mdl{
    public function insert_data($tbl_obj){
        $ins_sql='insert into vt_candidate
 	 	(

 	 	 	 cname,
			 classname
 	 	 ) 
values	( 

			 "' . $tbl_obj->get_cname().'"
			,"' . $tbl_obj->get_classname().'"
 	 	 )';

        $GLOBALS['conn']->query($ins_sql);

        $new_udid = mysqli_insert_id($GLOBALS['conn']);
        if($new_udid>0){
            return $new_udid;
        }
        else{
            return false;
        }
    }
    //  end method for inserting data 
    // method for update data
    public function update_data($tbl_obj){
        $up_sql='update vt_candidate  set 
 		cname = "' . $tbl_obj->get_cname().'",
		classname = "' . $tbl_obj->get_classname().'"';
        $up_sql .=  ' where id='.$tbl_obj->get_id();
        $GLOBALS['conn']->query($up_sql);


        if(strlen(mysqli_error($GLOBALS['conn'])) >0) {
            return false;
        }
        else {
            return true;
        }
    }//  end method for update data


    // method for select data 

    public function list_data($filter="1=1"){
        $dataset=array();
        $sql_sel='select vt_candidate.* from vt_candidate where  '.$filter;

        $rslt=$GLOBALS['conn']->query($sql_sel);
        while($rw=$rslt->fetch_assoc()){
            $dataset[]=$rw;
        }
        mysqli_free_result($rslt);
        return $dataset;
    }//  end method for select data 

	public function status_update($trans_id,$status){
		$up_sql='update vt_candidate  set 
				status="'. $status.'" 
				where id= '. $trans_id;
		$GLOBALS['conn']->query($up_sql); 
	}//  end method for status update data 


    public function fetch_by_id($trans_id,$data_obj) {
        $sql_sel='select vt_candidate.* from vt_candidate where status=1 and id = '.$trans_id;
        $rslt=$GLOBALS['conn']->query($sql_sel);
        $rw=$rslt->fetch_assoc();
        $data_obj->set_id($rw['id']);
        $data_obj->set_cname($rw['cname']);
		$data_obj->set_classname($rw['classname']);
    }


    public function delete_by_id($trans_id) {
        $sql_sel='update vt_candidate set status=-1 where id = '.$trans_id;
        $rslt=$GLOBALS['conn']->query($sql_sel);


    }

}

?>