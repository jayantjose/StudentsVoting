<?php
// Modal for Table - vt_vote

class vt_vote_mdl{
    public function insert_data($tbl_obj){
        $ins_sql='insert into vt_vote
 	 	(

 	 	 	 candidate_id
 	 	 ) 
		values	( 
 			"' . $tbl_obj->get_candidate_id().'"
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
        $up_sql='update vt_vote  set 
 
		candidate_id = "' . $tbl_obj->get_candidate_id().'"';
        $up_sql .=  'where id='.$tbl_obj->get_id();
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
        $sql_sel='select vt_vote.* from vt_vote where '.$filter;
        $rslt=$GLOBALS['conn']->query($sql_sel);
        while($rw=$rslt->fetch_assoc()){
            $dataset[]=$rw;
        }
        mysqli_free_result($rslt);
        return $dataset;
    }//  end method for select data 


    public function list_vote($filter="1=1"){
        $dataset=array();
        $sql_sel='select vt_vote.candidate_id,vt_candidate.cname,count(vt_vote.candidate_id) as vote 
					from vt_candidate
					left join vt_vote  on  vt_candidate.id = vt_vote.candidate_id
					where '.$filter. ' group by 1,2 order by 1,2';
        $rslt=$GLOBALS['conn']->query($sql_sel);
        while($rw=$rslt->fetch_assoc()){
            $dataset[]=$rw;
        }
        mysqli_free_result($rslt);
        return $dataset;
    }//  end method for select data 



    public function fetch_by_id($trans_id,$data_obj) {
        $sql_sel='select vt_vote.* from vt_vote where id = '.$trans_id;
        $rslt=$GLOBALS['conn']->query($sql_sel);
        $rw=$rslt->fetch_assoc();
        $data_obj->set_id($rw['id']);
        $data_obj->set_candidate_id($rw['candidate_id']);
		$data_obj->set_vdate($rw['vdate']);

    }


    public function delete_by_id($trans_id) {
        $sql_sel='delete from vt_vote where id = '.$trans_id;
        $rslt=$GLOBALS['conn']->query($sql_sel);


    }

}

?>