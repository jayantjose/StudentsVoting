<?php

class Form_Controls {
	public $data_obj;
	public function txt_box($fld_ID,$fld_Label,$type="text",$class="",$scripts="",$required=0,$readonly=0,$placeholder="",$maxlen=0,$width=0,$hidden=0) {
		
		$data_obj_fld = "get_" . $fld_ID;
		$data_obj_val = $this->data_obj->$data_obj_fld();

		$ctrl = '<div class="form-group row"';
		if($hidden >0){
			$ctrl .= ' style="display:none"';	
		}		
		$ctrl .='>' . PHP_EOL;
		$ctrl .='	<label class="col-sm-2  col-form-label" for="txt_'. $fld_ID .'">'. $fld_Label .'</label>' . PHP_EOL;
		$ctrl .='	<div class="col-sm-10">' . PHP_EOL;
		
		if($_SESSION["VOTING_islogin"] <=0) {
			$ctrl .='<div class="input-control">'. $data_obj_val .'</div>';
		}
		else {
			$ctrl .='		<input type="'. $type .'" class="form-control ' . $class .'" name="txt_'. $fld_ID .'"  id="txt_' . $fld_ID . '"  placeholder="'. $placeholder .'"';
			
			if($maxlen>0) { 
				$ctrl .= ' maxlength="' . $maxlen . '"'; 
			}
			if($width >0) {
				$ctrl .= ' style="width:'.$width .'px"';
			}
	
			if($required ==1) {
				$ctrl .= ' required ';
			}
			if($readonly ==1) {
				$ctrl .= ' readonly  ';
			}		    
			
			$ctrl .= ' ' . $scripts . ' ';
			$ctrl .= ' value="'. $data_obj_val .'">' . PHP_EOL;
		}
		
		$ctrl .= '	</div>' . PHP_EOL;
		$ctrl .= '</div>' . PHP_EOL;
		
		echo  $ctrl;
		
	}
	
	public function edit_box($fld_ID,$fld_Label,$class="",$scripts="",$required=0,$readonly=0,$placeholder="",$maxlen=0,$width=0,$height=100,$hidden=0) {
		
		$data_obj_fld = "get_" . $fld_ID;
		$data_obj_val = $this->data_obj->$data_obj_fld();

		$ctrl = '<div class="form-group row"';
		if($hidden >0){
			$ctrl .= ' style="display:none"';	
		}		
		$ctrl .='>' . PHP_EOL;
		$ctrl .='	<label class="col-sm-2  col-form-label" for="txt_'. $fld_ID .'">'. $fld_Label .'</label>' . PHP_EOL;
		$ctrl .='	<div class="col-sm-10">' . PHP_EOL;

		if($_SESSION["VOTING_islogin"] <=0) {
			$ctrl .='<div class="edit-control">'. $data_obj_val .'</div>';
		}
		else {		
			$ctrl .='	<textarea class="form-control ' . $class .'" name="txt_'. $fld_ID .'"  id="txt_' . $fld_ID . '"  placeholder="'. $placeholder .'"';
			if($maxlen>0) { 
				$ctrl .= ' maxlength="' . $maxlen . '"'; 
			}
			if($width >0) {
				$ctrl .= ' style="width:'.$width .'px"';
			}
			if($height >0) {
				$ctrl .= ' style="height:'.$height .'px"';
			}		
			if($required ==1) {
				$ctrl .= ' required ';
			}
			if($readonly ==1) {
				$ctrl .= ' readonly  ';
			}		    
			
			$ctrl .= ' ' . $scripts . '  />';
			$ctrl .= $data_obj_val;
			$ctrl .= '</textarea>  ' . PHP_EOL;
		}
		
		$ctrl .= '	</div>' . PHP_EOL;
		$ctrl .= '</div>' . PHP_EOL;
		
		echo  $ctrl;
		
	}	

	public function sel_box($fld_ID,$fld_Label,$data_array,$class="",$scripts="",$required=0,$readonly=0,$width=0,$hidden=0,$btn="") {
		
		$data_obj_fld = "get_" . $fld_ID;
		$data_obj_val = $this->data_obj->$data_obj_fld();

		$ctrl = '<div class="form-group row"';
		if($hidden >0){
			$ctrl .= ' style="display:none"';	
		}		
		$ctrl .='>' . PHP_EOL;
		$ctrl .='	<label class="col-sm-2  col-form-label" for="txt_'. $fld_ID .'">'. $fld_Label .'</label>' . PHP_EOL;
		$ctrl .='	<div class="col-sm-10 ">' . PHP_EOL;
		
		if($_SESSION["VOTING_islogin"] <=0) {
			$ctrl .='<div class="input-control">';
			if(isset($data_array[$data_obj_val])) {
				$ctrl .= $data_array[$data_obj_val];
			}
			$ctrl .= '</div>';
		}
		else {			
			$ctrl .='<select class="form-control selectmargin'.$class . '" name="txt_'. $fld_ID .'"  id="txt_'. $fld_ID .'" ';
			
				if($width >0) {
					$ctrl .= ' style="width:'.$width .'px"';
				}
				if($required ==1) {
					$ctrl .= ' required ';
				}
				if($readonly ==1) {
					$ctrl .= ' readonly  ';
				}		    
				$ctrl .= ' ' . $scripts . '>' . PHP_EOL;
				$ctrl .= '<option value=""></option>'. PHP_EOL;
				
				if(is_array($data_array)) {
						foreach($data_array as $da_ky=>$da_val) {
							if($da_ky>0 || strlen($da_ky) >0) {
								$ctrl .= '<option value="'. $da_ky .'" ';
								if($data_obj_val == $da_ky) {
									$ctrl .= " selected ";
								}
								$ctrl .=  '>'. $da_val .'</option>' . PHP_EOL;
							}
						}
				}
		
			$ctrl .='		</select>' . PHP_EOL;	
			
			if(isset($btn[1])) {
				$ctrl .='<button type="button" class="btn btn-sm btn-outline-secondary" id="' . $btn[0]. '"
             		       data-toggle="modal" data-target="#'. $btn[1] .'"><i class="fa fa-plus"></i></button>';
			}
		}
		$ctrl .= '	</div>' . PHP_EOL;
		$ctrl .= '</div>' . PHP_EOL;
		
		echo  $ctrl;
		
	}

	public function image_upload($fld_ID,$fld_Label,$fpath,$call_program,$application_path,$application_url,$hidden=0) {
        
        
        $data_obj_val = "";
        
        try {
		    $data_obj_fld = "get_" . $fld_ID;
		    $data_obj_val = $this->data_obj->$data_obj_fld();
        }
        catch(Exception $e) {
            
        }
        
		$ctrl = '<div class="form-group row"';
		if($hidden >0){
			$ctrl .= ' style="display:none"';	
		}		
		$ctrl .='>' . PHP_EOL;
		$ctrl .='	<label class="col-sm-2  col-form-label" for="'. $fld_ID .'">'. $fld_Label .'</label>' . PHP_EOL;
        $ctrl .='	<div class="col-sm-10">';

          if(strlen($data_obj_val) >0) {
		    $afile1 = $data_obj_val;
          }
          else {
            $afile1 = $this->data_obj->get_id() . ".jpg";
          }
		  $attach_file1 = $application_path . $fpath . $afile1;

		  if(file_exists($attach_file1)) {
			 $ctrl .= "<a href='".  $application_url . $fpath .$afile1 ."' target='_new'><img src='" . $application_url . $fpath .$afile1  . "' alt='Member Photo' style='border:3px solid #ccc; width:400px' /></a>" ;
			 if($_SESSION["VOTING_islogin"] >0) {
				 $ctrl .= "<br>";
				 $ctrl .= "<a href='".  $application_url . $fpath .$afile1 ."' target='_new'>View</a> &nbsp;" ;
				 $ctrl .= "<a href='". $call_program ."?id=".  $this->data_obj->get_id() ."&rm_attach=". $afile1 ."'>Remove</a>" ;
				 $ctrl .= "<br>";
			 }
		  }
        //$ctrl .='	  </div>';
        //$ctrl .='	<div class="col-sm-8">';
		if($_SESSION["VOTING_islogin"] >0) {
			$ctrl .='	          <input type="file" name="txt_'. $fld_ID .'" id="txt_'. $fld_ID .'" accept=".jpg">';
		}
        $ctrl .='	</div>'; 
		$ctrl .='</div>';
		
		echo  $ctrl; 
	}



	
}

?>