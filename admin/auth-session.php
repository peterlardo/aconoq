<?php
session_start(); require_once '../config.php';
$payload=json_decode(file_get_contents('php://input'),true); $token=$payload['access_token']??'';
if(!$token){http_response_code(401);exit('Token manquant');}
$context=stream_context_create(['http'=>['method'=>'GET','header'=>'apikey: '.SUPABASE_ANON_KEY."\r\nAuthorization: Bearer ".$token."\r\n"]]);
$raw=@file_get_contents(SUPABASE_URL.'/auth/v1/user',false,$context); $user=json_decode($raw,true);
$isAdmin=isset($user['email']) && ($user['email']==='admin@aconoq.cg' || (($user['user_metadata']['role']??'')==='admin'));
if(!$isAdmin){http_response_code(403);exit('Accès refusé');}
$_SESSION['admin']=true; $_SESSION['admin_user']=$user['email']; $_SESSION['supabase_access_token']=$token; http_response_code(204);
?>
