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
            $role = "Admin";
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

                $fname = $row['fname']; // Assuming you fetch 'fname' from the database
                $id = $row['admin_id'];

                if ($pass == $password){
                    $_SESSION['id'] = $id;
                    $_SESSION['fname'] = $fname;
                    $_SESSION['role'] = $role;

                    header("Location: home.php");
                    exit;
                } else {
                    $em = "Incorrect Password";
                    header("Location: ../login.php?error=$em");
                    exit;
                }
            
            }
        } else {
            $em = "User not found";
            header("Location: ../login.php?error=$em");
            exit;        }


       // $stmt->execute();

        $result = $conn->query($sql);
        //$result = $stmt->fetch();



    }
} else {
    header("Location: ../login.php");
    exit;
}
