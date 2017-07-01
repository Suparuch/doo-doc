<?php
/* /app/View/Helper/DateFormatHelper.php */
App::uses('AppHelper', 'View/Helper');

class DateFormatComponent extends Component {

	public $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
     
    public function convertDate($date){
        
		$str_date = $date['year'].'-'.$date['month'].'-'.$date['day'];
		$str_date = $str_date == '--'? null : $str_date;

        return $str_date;

    }

    public function getDay($date){
        
		$str_day = date('d', strtotime($date));
        return $str_day;

    }

    public function getMonth($date){
        
		$str_month = date('m', strtotime($date));
        return $str_month;

    }

    public function getYear($date){
        
		$str_year = date('Y', strtotime($date));
        return $str_year;

    }

	public function formatDateThai($dateTime = null,$option=null) {
		
		if(empty($dateTime)) return '';

		$strYear = date("Y",strtotime($dateTime))+543;
		$strMonth= date("n",strtotime($dateTime));
		$strDay= date("j",strtotime($dateTime));
		$strHour= date("H",strtotime($dateTime));
		$strMinute= date("i",strtotime($dateTime));
		$strSeconds= date("s",strtotime($dateTime));
		//$strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
		$strMonthCut = $this->strMonthCut;
		//$thai_day_arr=array("อาทิตย์","จันทร์","อังคาร","พุธ","พฤหัสบดี","ศุกร์","เสาร์");  
		/*
		$thai_month_arr=array(  
			"0"=>"",  
			"1"=>"มกราคม",  
			"2"=>"กุมภาพันธ์",  
			"3"=>"มีนาคม",  
			"4"=>"เมษายน",  
			"5"=>"พฤษภาคม",  
			"6"=>"มิถุนายน",   
			"7"=>"กรกฎาคม",  
			"8"=>"สิงหาคม",  
			"9"=>"กันยายน",  
			"10"=>"ตุลาคม",  
			"11"=>"พฤศจิกายน",  
			"12"=>"ธันวาคม"                    
		);
		*/
		$strMonthThai=$strMonthCut[$strMonth];
		if(!empty($option)){
			if (array_key_exists('Y', $option)) $strYear = substr($strYear, -2);			
		}

		//return "$strDay $strMonthThai $strYear, $strHour:$strMinute";
		//return $strDay .' '. $strMonthThai .' '. $yearThai($strYear);
		//pr($strDay .' '. $strMonthThai .' '. $strYear);
		return $strDay .' '. $strMonthThai .' '. $strYear;
	
	} // END function formatDate

	public function formatDateShortThai($dateTime = null,$option=null) {
		
		if(empty($dateTime)) return '';

		$strYear = date("Y",strtotime($dateTime))+543;
		$strMonth= date("n",strtotime($dateTime));
		$strDay= date("j",strtotime($dateTime));
		$strHour= date("H",strtotime($dateTime));
		$strMinute= date("i",strtotime($dateTime));
		$strSeconds= date("s",strtotime($dateTime));
		//$strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
		$strMonthCut = $this->strMonthCut;
		//$thai_day_arr=array("อาทิตย์","จันทร์","อังคาร","พุธ","พฤหัสบดี","ศุกร์","เสาร์");  
		/*
		$thai_month_arr=array(  
			"0"=>"",  
			"1"=>"มกราคม",  
			"2"=>"กุมภาพันธ์",  
			"3"=>"มีนาคม",  
			"4"=>"เมษายน",  
			"5"=>"พฤษภาคม",  
			"6"=>"มิถุนายน",   
			"7"=>"กรกฎาคม",  
			"8"=>"สิงหาคม",  
			"9"=>"กันยายน",  
			"10"=>"ตุลาคม",  
			"11"=>"พฤศจิกายน",  
			"12"=>"ธันวาคม"                    
		);
		*/
		$strMonthThai=$strMonthCut[$strMonth];
		if(!empty($option)){
			if (array_key_exists('Y', $option)) $strYear = substr($strYear, -2);			
		}

		//return "$strDay $strMonthThai $strYear, $strHour:$strMinute";
		//return $strDay .' '. $strMonthThai .' '. $yearThai($strYear);
		//pr($strDay .' '. $strMonthThai .' '. $strYear);
		return $strDay .' '. $strMonthThai .' '. substr($strYear,2,2);
	
	} // END function formatDate

    public function reConvertDateThai($date=null){
        
		$strMonthCut = $this->strMonthCut;
		$arr_date = explode(" ",$date);

		$strDay = $arr_date[0];
		$strMonth = $arr_date[1];
		$strYear = $arr_date[2];

		$strYear = $this->reConvertYearThai($strYear);
		$strMonth = $this->getIndexMonthThai($strMonth);

        return $strYear .'-'. $strMonth .'-'. $strDay .'00:00:00';

    }

    public function reConvertYearThai($year=null){
		return $year - 543;
	}

    public function getIndexMonthThai($month=null){
		
		//$strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
		$strMonthCut = $this->strMonthCut;
		return array_search($month,$strMonthCut);

	}


}