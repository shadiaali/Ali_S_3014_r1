<?php

function login($username, $password, $ip){
	require_once('connect.php');
	//Check if username exists

	$check_exist_query = 'SELECT COUNT(*) FROM tbl_users';
	$check_exist_query .= ' WHERE username = :username';

	$user_set = $pdo->prepare($check_exist_query);
	$user_set->execute(
		array(
			':username'=>$username
		)
	);


	if($user_set->fetchColumn()>0){
		$get_user_query = 'SELECT * FROM tbl_users WHERE username = :username';
		$get_user_query .= ' AND password = :password';


		$get_user_set = $pdo->prepare($get_user_query);

		//bind in placeholders
		$get_user_set->execute(
			array(
				':username'=>$username,
				':password'=>$password
			)
		);

		while($found_user = $get_user_set->fetch(PDO::FETCH_ASSOC)){
			$id = $found_user['id'];
			$_SESSION['id'] = $id;
			$_SESSION['username'] = $found_user['username'];

			//Updates user ip when logged in
			$update_ip_query = 'UPDATE tbl_users SET user_ip=:ip WHERE id=:id';
			$update_ip_set = $pdo->prepare($update_ip_query);
			$update_ip_set->execute(
				array(
					':ip'=>$ip,
					':id'=>$id
				)
			);
		}

		if(empty($id)){
			$message = 'Login has failed';
			return $message;
		}

		redirect_to('index.php');
	}else{
		$message = 'Login has failed';
		return $message;
	}
}
