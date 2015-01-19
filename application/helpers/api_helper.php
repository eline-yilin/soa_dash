<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('my_api_request'))
{
    function my_api_request($url , $method = 'get', $param = array())
    {
    	$CI =& get_instance();
    	$api_url  = config_item('api_url');
    	$final_url = $api_url . $url;
    	$username = config_item('api_username');
    	$password = config_item('api_password');
    	$current_user = $CI->session->userdata('user');
    	$user_id = 0;
    	if($current_user){
    		$user_id = $current_user['id'];
    	}
    	$ch = curl_init ();
		
		curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
		curl_setopt ( $ch, CURLOPT_HEADER, 0 );
		curl_setopt($ch, CURLOPT_USERPWD, $username . ':' . $password);
		 
		$method = strtolower($method);
		if(!isset($param['user_id'])){
			$param['user_id'] = $user_id;
		}
		switch ($method){
			case 'get':
				if(http_build_query($param))
				{
					$final_url .= '?' . http_build_query($param) ;
				}
				
				break;
    		case 'post':
    			if(!isset($param['user_id'])){
    				$param['user_id'] = $user_id;
    			}
    			
    			curl_setopt($ch, CURLOPT_POST, 1);
    			curl_setopt($ch, CURLOPT_POSTFIELDS,$param);
    			break;
    		case 'put':
    			$query = http_build_query($param);
    			
    			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
    			curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($param));
    			break;
    		case 'delete':
    			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
    			curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($param));
    			break;	
    			 
			default: break;
		}
		
		curl_setopt ( $ch, CURLOPT_URL,  $final_url );
		// 执行并获取HTML文档内容
		$output = curl_exec ( $ch );

		// 释放curl句柄
		curl_close ( $ch );
		return $output;
       
    }   
}