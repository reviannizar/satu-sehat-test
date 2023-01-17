<?php
/**
/*!
 *  Class fhir
 *  Copy Right (c)2022 
 *  author	: Abu Dzunnuraini
 *  email	: almprokdr@gmail.com
 *  ------------------------------
*/

require_once 'vendor/autoload.php';

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

defined('_FHIR_BASE_URL_') or define('_FHIR_BASE_URL_','https://api-satusehat-dev.dto.kemkes.go.id/fhir-r4/v1');
defined('_FHIR_AUTH_URL_') or define('_FHIR_AUTH_URL_','https://api-satusehat-dev.dto.kemkes.go.id/oauth2/v1');

// client id
defined('_FHIR_CLIENT_ID_') or define('_FHIR_CLIENT_ID_','client');
// clent scret
defined('_FHIR_CLIENT_SECRET_') or define('_FHIR_CLIENT_SECRET_','123456');
// session name
defined('_FHIR_TOKEN_SESSION_') or define('_FHIR_TOKEN_SESSION_','accesstoken');
// expired session 3480 detik
defined('_FHIR_TOKEN_EXPIRED_') or define('_FHIR_TOKEN_EXPIRED_',3480);

class fhir {
		
	private static function send($url,$method,$body='',$headers=[],$options=[]){
		$client = new Client();
		$request = new Request($method, $url, $headers, $body);
		try { 
			$res = $client->send($request, $options); 
		}catch (ClientException $e) { 
			$res = $e->getResponse();	
		}
		return json_decode($res->getBody()->getContents(),true);
	}
	
	private static function refreshToken(){
		$headers = [
			'Content-Type'=>'application/x-www-form-urlencoded',
		];
		$options = ['form_params'=>[
				'client_id' => _FHIR_CLIENT_ID_,
				'client_secret' => _FHIR_CLIENT_SECRET_,
			],
		];
		$url=_FHIR_AUTH_URL_ . "/accesstoken?grant_type=client_credentials";
		$t=self::send($url,'POST','',$headers,$options);
		return json_encode(array_merge($t,['time'=>time()]));
	}
	
	public static function getToken(){
		session_start();
		$t=isset($_SESSION[_FHIR_TOKEN_SESSION_])?$_SESSION[_FHIR_TOKEN_SESSION_]:false;
		if($t){
			$t=json_decode($t);
			$e=time()-$t->time;
			if($e>_FHIR_TOKEN_EXPIRED_) $_SESSION[_FHIR_TOKEN_SESSION_]=self::refreshToken();
		}else{
			$_SESSION[_FHIR_TOKEN_SESSION_]=self::refreshToken();
		}
		$t=json_decode($_SESSION[_FHIR_TOKEN_SESSION_]);
		return $t->access_token;
	}
	
	public static function request($url,$method,$body=''){
		$token=self::getToken();
		$headers = ['Content-Type'=>'application/json','Authorization'=>'Bearer '.$token,];	
		return self::send($url,$method,$body,$headers);
	}
	
}
