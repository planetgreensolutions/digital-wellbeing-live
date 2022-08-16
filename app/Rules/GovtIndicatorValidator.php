<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class GovtIndicatorValidator implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $valid = true;
		foreach($value['title'] as $key=>$val){
			// pre($value['title'][$key]);
			if( 
				!( 
					(
						empty($value['title'][$key])  
						&& empty($value['2016_target'][$key]) 
						&&  empty($value['2016_achieved'][$key]) 
						&& empty($value['2017_target'][$key]) 
						&&  empty($value['2017_achieved'][$key]) 
						&& empty($value['2018_target'][$key]) 
						&&  empty($value['2018_achieved'][$key]) 
					)

					|| 

					(
						!empty($value['title'][$key])  
						&& !empty($value['2016_target'][$key]) 
						&& !empty($value['2016_achieved'][$key]) 
						&& !empty($value['2017_target'][$key]) 
						&& !empty($value['2017_achieved'][$key]) 
						&& !empty($value['2018_target'][$key]) 
						&& !empty($value['2018_achieved'][$key])
					) 
				
				)
			){ 
				
				$valid = false;
			}
			
			
		}
		
		return $valid;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
	
        return lang("indicator_validation_message"); 
    }
}
