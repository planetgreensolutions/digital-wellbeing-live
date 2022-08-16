<?php

namespace CustomCalendar;
/**
*@author  Xu Ding
*@email   thedilab@gmail.com
*@website http://www.StarTutorial.com
**/
class Calendar {  
     
    /**
     * Constructor
     */
    public function __construct(){     
        // $this->naviHref = htmlentities($_SERVER['PHP_SELF']);
    }
     
    /********************* PROPERTY ********************/  
    private $dayLabels = array("Mon","Tue","Wed","Thu","Fri","Sat","Sun");
	
	private $dayLabelsAr = array('الإثنين','الثلاثاء','الأربعاء','الخميس','الجمعة','السبت','الأحد');
	
	private $monthNamesAr = array('يناير','فبراير','مارس','إبريل','مايو','يونيو','يوليو','أغسطس','سبتمبر','أكتوبر','نوفمبر','ديسمبر');
	
    private $currentYear=0;
     
    private $currentMonth=0;
     
    private $currentDay=0;
     
    private $currentDate=null;
     
    private $daysInMonth=0;
     
    private $naviHref= null;
	
	private $lang = '';
     
    /********************* PUBLIC **********************/  
        
    /**
    * print out the calendar
    */
    public function show($option=null, $events=null, $nextPrevNav = '',$year=null,$month=null,$lang='en') {
        // print_r($events);
		// exit();
		$this->naviHref = $nextPrevNav;
		
		$this->lang = $lang;
         // pre(null==$year&&isset($_GET['year']) && $_GET['year'] > 0);
        if( ((null==$year&&isset($_GET['year'])) && $_GET['year'] > 0) ){
 
            $year = $_GET['year'];
         
        }elseif(!empty($year)){
			$year = $year;
		}else {
 
            $year = date("Y",time());  
         
        }          
         
        if( (null==$month&&isset($_GET['month']) ) && $_GET['month'] > 0 ){
 
            $month = $_GET['month'];
         
        }elseif(!empty($month)){
			$month = $month;
		}else{
 
            $month = date("m",time());
         
        }               

		// pre($year.'==='.$month);
         
        $this->currentYear=$year;
         
        $this->currentMonth=$month;
         
        $this->daysInMonth=$this->_daysInMonth($month,$year);  
         
        $content='<div id="calendar">'.
                        '<div class="box">'.
                        $this->_createNavi().
                        '</div>'.
                        '<div class="box-content">'.
                                '<ul class="label">'.$this->_createLabels().'</ul>';   
                                $content.='<div class="clear"></div>';     
                                $content.='<ul class="dates">';    
                                 
                                $weeksInMonth = $this->_weeksInMonth($month,$year);
                                // Create weeks in a month
                                for( $i=0; $i<$weeksInMonth; $i++ ){
                                     
                                    //Create days in a week
                                    for($j=1;$j<=7;$j++){
                                        $content.=$this->_showDay( ($i*7+$j), $option, $events);
                                    }
                                }
                                 
                                $content.='</ul>';
                                 
                                $content.='<div class="clear"></div>';     
             
                        $content.='</div>';
                 
        $content.='</div>';
        return $content;   
    }
    
    private function _getPopOverTable($id,$content){
        // pre(implode('<br/>',$content));
        return '<div class="hidden dailyScheduleTab" id="'.$id.'">'.
                    '<div class="popOverTableWrapper">'.
                        '<div class="table-responsive-md">'.
                            ' <table class="table table-striped table-bordered">'.
                                '<thead>'.
                                    '<tr>'.
                                        '<th>Sl.</th>'.
                                        '<th>Booked By</th>'.
                                        '<th>Space/Room</th>'.
                                        '<th>Start Time</th>'.
                                        '<th>End Time</th>'.
                                    '</tr>'.
                                '</thead>'.
                                 '<tbody>'.
                                    implode(' ',$content).
                                '</tbody>'.
                          '</table>'. 
                       '</div>'.
                  '</div>'.
              '</div>';
              
             
    }
    
     
    /********************* PRIVATE **********************/ 
    /**
    * create the li element for ul
    */
    private function _showDay($cellNumber,$option , $events){
         
        if($this->currentDay==0){
             
            $firstDayOfTheWeek = date('N',strtotime($this->currentYear.'-'.$this->currentMonth.'-01'));
                     
            if(intval($cellNumber) == intval($firstDayOfTheWeek)){
                 
                $this->currentDay=1;
                 
            }
        }
         
        if( ($this->currentDay!=0)&&($this->currentDay<=$this->daysInMonth) ){
             
            $this->currentDate = date('Y-m-d',strtotime($this->currentYear.'-'.$this->currentMonth.'-'.($this->currentDay)));
             
            $cellContent = str_pad($this->currentDay,2,'0',STR_PAD_LEFT);
             
            $this->currentDay++;   
             
        }else{
             
            $this->currentDate =null;
 
            $cellContent=null;
        }
         $class = '';  
		/* The Current Day */
        if(!empty($option)){ 
			if($cellContent==$option){
				$class="selected";
			}
        }else{
			/* if($cellContent==date('d')){
				$class="selected";
			} */
		} 
		
		$eventPresent = false;
        
		$eventsType = 0;
        $dayMetaStr = '';
        $bookingsByType = [];
        $counter = [];
		if(!empty($events)){
			foreach($events as $key=>$eventList){ 
            // pre($eventList);
                $eventsType = $key;
                $eventsCount = 0;
                $counter[$key] = 1;
                foreach($eventList as $event){
    				 if($this->currentDate == date('Y-m-d',strtotime($event['date']))){
                        $eventsCount++;
                        if($eventPresent == false){
                            $class .= ' eventPresent';
                        }
    					$eventPresent = true;
                        $bookingsByType[$key][] = '<tr><td>'.$counter[$key]++.'.</td><td>'.$event['bookedBy'].'</td><td>'.$event['spaceNameEn'].((!empty($event['eventNameEn']))?'<span class="eventName">'.$event['eventNameEn'].'</span>':'').'</td><td>'.$event['startTime'].'</td><td>'.$event['endTime'].'</td></tr>';
                     }
			    }
                
                // pre($eventsType);
                if($eventsType == 'user' && $eventsCount > 0){
                    $divId = 'userdiv_'.strtotime($this->currentDate);
                    
                    $dayMetaStr .= '<div href="#" class="myPopover circleDiv userBookingCal" data-div="'.$divId.'" title="User Bookings('.$eventsCount.') - '.$event['hubName'].'" ><span ><i class="fas fa-user-clock"></i></span></div>';
                    $dayMetaStr .= $this->_getPopOverTable($divId,$bookingsByType[$eventsType]);
                }
                
                if($eventsType == 'event' && $eventsCount > 0){
                    $divId = 'eventdiv_'.strtotime($this->currentDate);
                    $dayMetaStr .= '<div href="#" class="myPopover  circleDiv eventBookingCal" data-div="'.$divId.'" title="Events ('.$eventsCount.') - '.$event['hubName'].'"><span data-content=""><i class="fas fa-candy-cane"></i></span></div>';
                    $dayMetaStr .= $this->_getPopOverTable($divId,$bookingsByType[$eventsType]);
                }
                
                if($eventsType == 'admin' && $eventsCount > 0){
                    $divId = 'admindiv_'.strtotime($this->currentDate);
                    $dayMetaStr .= '<div href="#" class="myPopover  circleDiv adminBlockCal" data-div="'.$divId.'" title="Admin Blocked Spaces('.$eventsCount.') - '.$event['hubName'].'"><span  data-content=""><i class="fas fa-lock"></i></span></div>';
                    $dayMetaStr .= $this->_getPopOverTable($divId,$bookingsByType[$eventsType]);
                }
			}
            
            
		}

		/*if(!empty($cellContent)){
			$cellContent .= '<a class="addNew modalTrigger" data-toggle="modal" data-target="#adminBooking" href="#" ><i class="fa fa-calendar-plus-o" aria-hidden="true"></i></a>';
		}*/	

        $dayStr = '<li data-day="'.(date('d',strtotime($this->currentDate))).'" data-month="'.(date('m',strtotime($this->currentDate))).'" data-year="'.(date('Y',strtotime($this->currentDate))).'" data-date="'.$this->currentDate.'" '. ((!empty($this->currentDate))?'id="li-'.$this->currentDate.'"':'') .' class="'.$class.' '.($cellNumber%7==1?' start ':($cellNumber%7==0?' end ':' ')).
                ($cellContent== null ? 'mask':'').'">';
        
        if(!empty($cellContent)){
            $dayStr .= '<a data-date="'.$this->currentDate.'"  data-toggle="modal" data-target="#dailyDetails" href="#" class="';
        }

        if($eventPresent){
            $dayStr .= ' eventPresent ';
        }        

        if(!empty($cellContent)){

            $dayStr .= ' dailyDetails">';
        }

        $dayStr .= $cellContent;



        if(!empty($cellContent)){
            $dayStr .= '</a>';
        }
        // pre($dayMetaStr);
        $dayStr .= '<div class="dayMetaWrapper">';
            if(!empty($eventPresent)){
                $dayStr .= $dayMetaStr;    
            }
        $dayStr .= '</div>';

        $dayStr .= '</li>';
       
        return $dayStr;
    }
     
    /**
    * create navigation
    */
    private function _createNavi(){
         
        $nextMonth = $this->currentMonth==12?1:intval($this->currentMonth)+1;
         
        $nextYear = $this->currentMonth==12?intval($this->currentYear)+1:$this->currentYear;
         
        $preMonth = $this->currentMonth==1?12:intval($this->currentMonth)-1;
         
        $preYear = $this->currentMonth==1?intval($this->currentYear)-1:$this->currentYear;

        

         $selectedYear = $this->currentYear;
         $selectedMonth = $this->currentMonth;
		  // pre($month);
		 
         $monthName = date('F', mktime(0, 0, 0, $selectedMonth, 10));
         if($this->lang=='ar'){
			$monthName = $this->monthNamesAr[$selectedMonth-1];
		 }
        return
            '<div class="header">'.
			'<input type="hidden" id="currentCalYear" name="currentCalYear" value="'.$selectedYear.'" /> <input type="hidden" id="currentCalMonth"  name="currentCalMonth" value="'.$selectedMonth.'" />'.
            '<div class="calendarMonth"><div class="monthItem">'.
            '<a data-month="'.$preMonth.'" data-year="'.$preYear.'" class="prev" href="'.$this->naviHref.'?month='.sprintf('%02d',$preMonth).'&year='.$preYear.'">Prev</a>'.
            $monthName.' '.$selectedYear.
            '<a data-month="'.$nextMonth.'" data-year="'.$nextYear.'" class="next" href="'.$this->naviHref.'?month='.sprintf("%02d", $nextMonth).'&year='.$nextYear.'">Next</a>'.
            '</div>'.
                // '<div class="yearItem">'.$selectedYear .'</div>'.
            '</div>'.
               
                    /*'<span class="title">'.date('Y M',strtotime($this->currentYear.'-'.$this->currentMonth.'-1')).'</span>'.*/
                
            '</div>';
    }
         
    /**
    * create calendar week labels
    */
    private function _createLabels(){  
                 
        $content='';
		
		if($this->lang=='en'){
			foreach($this->dayLabels as $index=>$label){
				 
				$content.='<li class="'.($label==6?'end title':'start title').' title">'.$label.'</li>';
	 
			}
		}else{
			foreach($this->dayLabelsAr as $index=>$label){
				 
				$content.='<li class="'.($label==6?'end title':'start title').' title">'.$label.'</li>';
	 
			}
		}
         
        return $content;
    }
     
     
     
    /**
    * calculate number of weeks in a particular month
    */
    private function _weeksInMonth($month=null,$year=null){
         
        if( null==($year) ) {
            $year =  date("Y",time()); 
        }
         
        if(null==($month)) {
            $month = date("m",time());
        }
         
        // find number of days in this month
        $daysInMonths = $this->_daysInMonth($month,$year);
         
        $numOfweeks = ($daysInMonths%7==0?0:1) + intval($daysInMonths/7);
         
        $monthEndingDay= date('N',strtotime($year.'-'.$month.'-'.$daysInMonths));
         
        $monthStartDay = date('N',strtotime($year.'-'.$month.'-01'));
         
        if($monthEndingDay<$monthStartDay){
             
            $numOfweeks++;
         
        }
         
        return $numOfweeks;
    }
 
    /**
    * calculate number of days in a particular month
    */
    private function _daysInMonth($month=null,$year=null){
         
        if(null==($year))
            $year =  date("Y",time()); 
 
        if(null==($month))
            $month = date("m",time());
             
        return date('t',strtotime($year.'-'.$month.'-01'));
    }
     
}