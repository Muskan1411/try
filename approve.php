<?php
	include "connect.php";

	if(isset($_POST['reg_id'])) {
		$sql = "Select * from coadmin_reg where reg_id='".$_POST['reg_id']."' LIMIT 1";
		$result = mysqli_query($conn, $sql);
		while($row = mysqli_fetch_array($result)) {
			$mob = substr($row['contact'], 0,4);
			$username = $row['reg_id'].$row['firstname'].$mob;

			$length = 10;
			$keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			 $pieces = [];
		    $max = mb_strlen($keyspace, '8bit') - 1;
		    for ($i = 0; $i < $length; ++$i) {
		        $pieces []= $keyspace[random_int(0, $max)];
		    }
		    $password = implode('', $pieces);

		    $sql2 = "Update coadmin_reg set username='".$username."' , password='".$password."', status='yes' where reg_id=".$_POST['reg_id']."";
		    $result1 = mysqli_query($conn, $sql2);

		    $sql3 = "Select CAID from approved_admins order by CAID desc LIMIT 1";
		    $result2 = mysqli_query($conn, $sql3);
		    while($row=mysqli_fetch_array($result2)) {
		    	$id = $row['CAID'];
		    	$id_arr = explode('-', $id);
		    	$num = (int)$id_arr[1];
		    	$num = $num+1;
		    	if($num<11) {
		    		$caid = $id_arr[0].'-00'.$num;
		    	} else if($num<101) {
		    		$caid = $id_arr[0].'-0'.$num;
		    	} else {
		    		$caid = $id_arr[0].'-'.$num;
		    	}
		    	
		    	
		    }
		    
		    $result4 = mysqli_query($conn, "Select CAID from approved_admins where CAID IS NOT NULL");
		    if($row=mysqli_fetch_array($result4)) {
		    	$sql4 = "Insert into approved_admins (CAID,username,password,reg_id) values ('$caid','$username','$password','".$_POST['reg_id']."')";
		    } else {
		    	$sql4 = "Insert into approved_admins (CAID,username,password,reg_id) values ('CA-001','$username','$password','".$_POST['reg_id']."')";
		    }
		    $result3 = mysqli_query($conn, $sql4);

		    if($result3==1) {
		    	echo "e";
		    }
		     if(!empty($result1)) {
		    	echo "Approved!";
		    }

		    $to = 'musku99ag@gmail.com';
		    $subject = 'username & password';
		    $message = 'Username : '.$username.' \n Password : '.$password;
		    $headers = 'From: muskan99ag@gmail.com'.'\r\n'.
		    			'Reply-To: '.'\r\n'.
		    			'X-Mailer: PHP/'.phpversion();
		    $status = mail($to, $subject, $message, $headers); 
		    if($status == true) {
		    	echo "Mail Send";
		    } else {
		    	echo "Not send";
		    }
		   

		}
	}
?>