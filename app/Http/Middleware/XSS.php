<?php

namespace App\Http\Middleware;

use Closure;

class XSS
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next){
        if(!empty($request->all())){
		
			$this->_get_post_data($request);
			$this->_get_post_meta_data($request);
		}
	    return $next($request);
    }
	
	
	 protected function _get_post_data($request){
       
        if(empty($request->post) || !isset($request->post)) return true;
	
        foreach($request->post as $key=>$postData){
			//$preg_post = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $postData);
			//$request->post->merge([ $key => $preg_post ]);
           //$request->post[$key] = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $postData);
		   $post_array['post'][$key] = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $postData);
		   
        }
		
		$request->merge($post_array);
		
        return true;
    }

    protected function _get_post_meta_data($request){
        if(empty($request->meta) || !isset($request->meta)) return true;
		
        foreach($request->meta as $key=>$postData){
     
           foreach($postData as $key2 => $data){
			 
				//$request->meta[$key][$key2] = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $data);
				$meta_array['meta'][$key][$key2] = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $data);
			}
        }
		$request->merge($meta_array);
	
        return true;
    }
    
}
