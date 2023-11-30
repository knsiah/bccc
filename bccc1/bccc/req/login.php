<?php
session_start(); // Start session if not already started

$result = "";

if (
    isset($_POST['uname']) &&
    isset($_POST['pass']) &&
    isset($_POST['role'])
) {
    include('DB_connection.php');

    $uname = $_POST['uname'];
    $pass = $_POST['pass'];
    $role = $_POST['role'];

    if (empty($uname)) {
        $em = "Username is required";
        header("Location: ../login.php?error=$em");
        exit;
    } else if (empty($pass)) {
        $em = "Password is required";
        header("Location: ../login.php?error=$em");
        exit;
    } else if (empty($role)) {
        $em = "An error occurred";
        header("Location: ../login.php?error=$em");
        exit;
    } else {

        if ($role == '1') {
            $result = mysqli_query($db, "SELECT * FROM admin WHERE username = '$uname'");
            $role = "admin";
        } else if ($role == '2') {
            $result = mysqli_query($db, "SELECT * FROM teachers WHERE username = '$uname'");
            $role = "Teacher";
        } else {
            $result = mysqli_query($db, "SELECT * FROM students WHERE username = '$uname'");
            $role = "Student";
        }



        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            if ($row = mysqli_fetch_assoc($result)) {

                
                $username = $row['username'];
                $password = $row['password'];

                 // Assuming you fetch 'fname' from the database
                
                if ($username === $uname) {
                 if (password_verify($pass, $password)) {
                   
                    $_SESSION['role'] = $role;
                    if ($role == 'Admin') {
                        $id = $user['admin_id'];
                        $_SESSION['admin_id'] = $id;
                        header("Location: ../admin/index.php");
                        exit;
                    }}else if ($role == 'Student') {
                        $id = $user['student_id'];
                        $_SESSION['student_id'] = $id;
                        header("Location: ../Student/index.php");
                        exit;
                    }else if ($role == 'Registrar Office') {
                        $id = $user['r_user_id'];
                        $_SESSION['r_user_id'] = $id;
                        header("Location: ../RegistrarOffice/index.php");
                        exit;
                    }else if($role == 'Teacher'){
                    	$id = $user['teacher_id'];
                        $_SESSION['teacher_id'] = $id;
                        header("Location: ../Teacher/index.php");
                        exit;
                    }else {
                    	$em  = "Incorrect Username or Password";
				        header("Location: ../login.php?error=$em");
				        exit;
                    }
				    
            	}else {
		        	$em  = "Incorrect Username or Password";
				    header("Location: ../login.php?error=$em");
				    exit;
		        }
            }else {
	        	$em  = "Incorrect Username or Password";
			    header("Location: ../login.php?error=$em");
			    exit;
	        }
        }else {
        	$em  = "Incorrect Username or Password";
		    header("Location: ../login.php?error=$em");
		    exit;
        }
	}


}else{
	header("Location: ../login.php");
	exit;
}