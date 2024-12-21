<?php
class Model
{
	public $link;
	public function __construct()
	{
		$this->link = mysqli_connect(DBHOST, DBLOGIN, DBPASSWORD, DBNAME) or die('error connection');
		
		//mysqli_select_db($this->link, DBNAME) or die('error db');
		mysqli_query($this->link,"SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
	}

	public function bodyEmail($top=null,$text=null,$logo='mlogo1.png'){
		//<a href="http://'.$_SERVER['HTTP_HOST'].'/crm/api/mailTohtml?top='.str_replace('#','',$top).'&text='.htmlentities($text).'" style="font-size:20px;color:#7F7E82;vertical-align: top;">אם אינך רואה הודעה זו בצורה תקינה – לחץ כאן </a>
			$body = '
					<html xmlns="http://www.w3.org/1999/xhtml">
					<head>
					<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
					<meta name="format-detection" content="telephone=no"> 
					<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=no;">
					<meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE" />
						<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
						<style type="text/css">
						.row{
							padding:0 0 10px;
						}
						.align-center{
							text-align:center;
						}
						.row th{
							border-radius:5px;
							color:#2F2F2F;
							font-size:14px;
							font-weight:bold;
							text-align:center;
							padding:5px;
							vertical-align:middle;
						}							
						.row td{
								background-color:#F5F6FA;
								border-radius:5px;
								color:#2F2F2F;
								font-size:14px;
								font-weight:bold;
								text-align:center;
								padding:15px 5px;
								vertical-align:middle;
						}
						.row td.total{
							background: #000;
							color: #fff;
						}
						.table-head{
							color:#7F7E82;
							font-size:12px;
						}
						.t1{
							font-size:16px;
							color:#262470;
							text-align:left;
						}
						.t2{
							background:#262470;color:#fff;font-size:16px;font-weight:bold;text-align:center;border-radius:5px;padding:5px 0;
						}
						.h2{
							color:#000;
							font-weight:bold;
						}
						.cell{								
							border-spacing: 0 5px;
						}
						@media (max-width: 640px)
						{
							.head-nad{font-size:18px!important;}
							.row td,.bottom_link{
								font-size:12px!important;
							}
							.header img{max-width:100%;}
							.t-body{
								padding:10px!important;
							}
							.t-cont{
								padding:15px!important;
							}
						}
						@media (max-width: 480px)
						{
					
					
							.email-text div{width:100%!important;}
							.email-text{padding: 0 5%!important;}
							td.product.col-xs-3{
								display:block;
								width:100%!important;
								max-width:280px;
								margin: 0 auto 20px;	
							}
							table{
								max-width:100%!important;
								width:100%!important;
							}
							td.image{
								max-width:280px;
							}
							td.product.col-xs-3 > table, td.product.col-xs-3 > table .image{
								height:150px!important;
								overflow:hidden;
							}
							img{
								display:block;
							}
							.logo img{
								margin:0 auto;
							}
						}	
						@media (max-width: 400px)
						{
							.header div{width:100%!important;float:none!important;margin: 0 0 20px !important;}
							.logo{text-align:center!important;}
							p{text-align:right!important;}
						}							
						</style>


					</head>

					<body style="padding:0; margin:0;direction: rtl;background-color: #f5f7f9;" dir="rtl">	
						<div class="container" style="direction: rtl; background-color: #f5f7f9;max-width: 670px;margin: 0 auto;font-family: Open Sans, sans-serif;">
						<table dir="rtl" width="100%" class="t-cont" style="background-color: #f5f7f9;padding: 40px;">
							<tr>
								<td>
									<table dir="rtl" class="header" width="100%" style="padding: 0 0 25px;background-color: #f5f7f9;">

										<tr>
											<td style="vertical-align: top;"><a href="http://'.$_SERVER['HTTP_HOST'].'/api/mailTohtml/?top='.str_replace('#','',$top).'&text='.htmlentities($text).'" style="font-size:12px;color:#7F7E82;vertical-align: top;">אם אינך רואה הודעה זו בצורה תקינה – לחץ כאן </a></td>
											
										</tr>
										
									</table>
									<table dir="rtl" class="email-text" width="100%" style="padding:30px;text-align:center;background-color:#fff;">
										<tr>									
											<td class="t-body" style="color:#58595b;font-size:16px;padding: 30px 55px;">
												<div class="logo" style="text-align: center;"><img src="http://'.$_SERVER['HTTP_HOST'].'/app/views/images/logo.png" /></div>											
												<h1 class="head-nad" style="text-align: center;color:#000;font-size:24px; font-weight:bold;">'.$top.'</h1>	
												<table dir="rtl" width="100%" style="background:#fff;" class="cell">
													<tr>
														'.$text.'
													</tr>
												</table>
											</td>
										</tr>
									</table>
									<table class="bottom_link" width="100%" style="padding:0;text-align: center; font-size:14px;color:#7F7E82;background-color: #f5f7f9;">
										<tr>
											<td style="padding:35px 0;direction: ltr;">
												Copyright © 2022 – <a href="myparking.co.il">myparking.co.il</a>
											</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</div>
					</body>
					</html>
					';	
		//die(var_dump($body));
		return $body;
	}		
	
	public function db_select_array($query)
	{ 
		$mysql_query = mysqli_query($this->link,$query);
		
		$arr = array();
		while ($row = mysqli_fetch_array($mysql_query, MYSQLI_ASSOC)) {
			$arr[] = $row;
		}

		return $arr;
	}
	
	public function db_select_row($query)
	{ 
		$mysql_query = mysqli_query($this->link,$query);
		
		$arr = array();
		while ($row = mysqli_fetch_array($mysql_query, MYSQLI_ASSOC)) {
			$arr = $row;
		}

		return $arr;
	}	
	
	public function db_query($query)
	{ 
		if(mysqli_query($this->link,$query) == true);
	}
	
	public function getRows($table){
		//$link = mysqli_connect(DBHOST, DBLOGIN, DBPASSWORD);
		$columns = $this->db_select_array("SHOW columns FROM $table");
		$return = array();
		if($columns){
			foreach($columns as $c){
				$return[$c['Field']] = $c;
			}
		}
		//die(var_dump($columns));
		//$columns = mysql_num_fields($fields);

		/*$return = array();
		foreach ($columns as $column) {
			if(mysql_field_name($fields, $i) != 'id'){
				$return[mysql_field_name($fields, $i)]['type'] = mysql_field_type($fields, $i);
			}
		}	
		die(var_dump($return));*/
		return $return;
	}

	public function insert_db_query($data, $table)
	{ 
		if(!empty($data)){
			
			$ar_is_row = $this->getRows($table);
			
			$ar_is_row2 = array();
			foreach($data as $n=>$a){
				if(isset($ar_is_row[$n])){
					if($ar_is_row[$n]['type']=='int'){
						$ar_is_row2[$n] = (int)$a;
					}else{
						$ar_is_row2[$n] = $a;
					}
				}
			}
			//die(var_dump($ar_is_row2));
			$str = 'INSERT INTO '.$table.' SET ';
			$i=0;
			$data = $ar_is_row2;
			foreach($data as $n=>$a){
					if($i==0){
						if(gettype($a)=='integer'){
							$str .= $n."=".$a;
						}
						
						if(gettype($a)=='string'){
							$str .= $n."='".$a."'";
						}
						if(gettype($a)=='array'){
							$str .= $n."='".serialize($a)."'";
						}				
					}else{
						if(gettype($a)=='integer'){
							$str .= ', '.$n."=".$a;
						}				
						if(gettype($a)=='string'){
							$str .= ', '.$n."='".$a."'";
						}
						if(gettype($a)=='array'){
							$str .= ', '.$n."='".serialize($a)."'";
						}					
					}
				
				$i++;
			}
			//die(var_dump($str));
			return $str;
		}
	}

	public function update_db_query($data, $table, $where)
	{ 
		if(!empty($data)){
			
			$ar_is_row = $this->getRows($table);
			
			$ar_is_row2 = array();
			foreach($data as $n=>$a){
				if(isset($ar_is_row[$n])){
					if($ar_is_row[$n]['type']=='int'){
						$ar_is_row2[$n] = (int)$a;
					}else{
						$ar_is_row2[$n] = $a;
					}
				}
			}
			//die(var_dump($ar_is_row2));
			$str = 'UPDATE '.$table.' SET ';
			$i=0;
			$data = $ar_is_row2;
			foreach($data as $n=>$a){
					if($i==0){
						if(gettype($a)=='integer'){
							$str .= $n."=".$a;
						}
						
						if(gettype($a)=='string'){
							$str .= $n."='".$a."'";
						}
						if(gettype($a)=='array'){
							$str .= $n."='".serialize($a)."'";
						}				
					}else{
						if(gettype($a)=='integer'){
							$str .= ', '.$n."=".$a;
						}				
						if(gettype($a)=='string'){
							$str .= ', '.$n."='".$a."'";
						}
						if(gettype($a)=='array'){
							$str .= ', '.$n."='".serialize($a)."'";
						}					
					}
				
				$i++;
			}
			if($where){
				$str .= ' WHERE '.$where;
			}
			//die(var_dump($str));
			return $str;
		}
	}

	public function kiloformat($data)
	{ 
		if($data>1000){
			$data = $data/1000;
			$data = $data.'K';
		}
		if(!$data){
			$data = 0;
		}
		return $data;
	}
	
	public function crypt($d){
		if($d){
			// Store the cipher method 
			$ciphering = "AES-128-CTR"; 
			  
			// Use OpenSSl Encryption method 
			$iv_length = openssl_cipher_iv_length($ciphering); 
			$options = 0; 
			  
			// Non-NULL Initialization Vector for encryption 
			$encryption_iv = '12434567891011121'; 
			  
			// Store the encryption key 
			$encryption_key = "Basok"; 
			  
			// Use openssl_encrypt() function to encrypt the data 
			$encryption = openssl_encrypt($d, $ciphering, 
						$encryption_key, $options, $encryption_iv); 

			return $encryption;
		}
	}
	
	public function decrypt($d){
		if($d){

			$ciphering = "AES-128-CTR"; 
			// Non-NULL Initialization Vector for decryption 
			$decryption_iv = '12434567891011121'; 
			  $options = 0;
			// Store the decryption key 
			$decryption_key = "Basok"; 
			  
			// Use openssl_decrypt() function to decrypt the data 
			$decryption=openssl_decrypt ($d, $ciphering,  
					$decryption_key, $options, $decryption_iv); 
			return $decryption;
			///$calcmac = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary=true);		
		}
	}	
}
?>