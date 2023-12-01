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

                if ($username === $uname && password_verify($pass, $password)) {
                    $_SESSION['role'] = $role;
                    if ($role == 'Admin') {
                        $id = $row['admin_id'];
                        $_SESSION['admin_id'] = $id;
                        header("Location: ../admin/index.php");
                        exit;
                    } else if ($role == 'Student') {
                        $id = $row['student_id'];
                        $_SESSION['student_id'] = $id;
                        header("Location: ../Student/index.php");
                        exit;
                    } else if ($role == 'Registrar Office') {
                        $id = $row['r_user_id'];
                        $_SESSION['r_user_id'] = $id;
                        header("Location: ../RegistrarOffice/index.php");
                        exit;
                    } else if ($role == 'Teacher') {
                        $id = $row['teacher_id'];
                        $_SESSION['teacher_id'] = $id;
                        header("Location: ../Teacher/index.php");
                        exit;
                    } else {
                        $em = "Incorrect Username or Password";
                    }
                } else {
                    // Incorrect password or username
                    $em = "Incorrect Username or Password";
                }
            } else {
                // User not found
                $em = "User not found";
            }
        } else {
            $em = "User not found";
        }
        header("Location: ../login.php?error=$em");
        exit;
    }
} else {
    header("Location: ../login.php");
    exit;
}
