<?php
	class HookLoader
	{
	    function LanguageInit() {
	        $ci =& get_instance();
	        $ci->load->helper('language');
	        $ci->load->config('config');

	        $lang = (isset($_COOKIE[$ci->config->config['keyword'].'lang']))? $_COOKIE[$ci->config->config['keyword'].'lang'] : '';
	        if ($lang) {
	            $ci->lang->load('agent', $lang);
	        } else {
	            $ci->lang->load('agent','en');
	        }
	    }

	    function CookieInit() {
	        $ci =& get_instance();
	        $ci->load->config('config');
	        $ci->load->library('user_agent');

	        if(isset($_COOKIE[$ci->config->config['keyword'].'token_'])){
	      	
		        if($_COOKIE[$ci->config->config['keyword'].'token_'] == ''){
		        	redirect('logout');
		        }else{
		        	$decode = decode($_COOKIE[$ci->config->config['keyword'].'token_']);
			      	$token  = explode('|',$decode);

			      	if ($ci->agent->is_browser() && $ci->agent->is_mobile() == '') {
						$ttime  =  date('YmdHis', strtotime($token[7]. ' +5 minute'));
					} elseif ($ci->agent->is_mobile()) {
						$ttime  =  date('YmdHis', strtotime($token[7]. ' +30 minute'));
					}

			      	if(date('YmdHis') > $ttime){
			        	redirect('logout');
			      	}
		        }
		    }

		    if(isset($_COOKIE[$ci->config->config['keyword'].'chkuser'])){
	      	
		        if($_COOKIE[$ci->config->config['keyword'].'chkuser'] == 'logout'){
		        	redirect('logout');
		        }
		    }

		    return;
	    }
	}
?>