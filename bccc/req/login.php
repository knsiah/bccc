<?php
session_start(); // Start session if not already started

if (
    isset($_POST['uname']) &&
    isset($_POST['pass']) &&
    isset($_POST['role'])
) {
    include('/DB_connection.php');

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
            $sql = "SELECT * FROM 'admin' WHERE username = ?";
            $role = "admin";
        } else if ($role == '2') {
            $sql = "SELECT * FROM 'teachers' WHERE username = ?";
            $role = "Teacher";
        } else {
            $sql = "SELECT * FROM 'students' WHERE username = ?";
            $role = "Student";
        }

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $uname); // Bind parameter to the query
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();
            $username = $user['username'];
            $password = $user['password'];
            $fname = $user['fname']; // Assuming you fetch 'fname' from the database
            $id = $user['id'];

            if (password_verify($pass, $password)) {
                $_SESSION['id'] = $id;
                $_SESSION['fname'] = $fname;
                $_SESSION['role'] = $role;

                header("Location: ../home.php");
                exit;
            } else {
                $em = "Incorrect Password";
                header("Location: ../login.php?error=$em");
                exit;
            }
        } else {
            $em = "User not found";
            header("Location: ../login.php?error=$em");
            exit;
        }
    }
} else {
    header("Location: ../login.php");
    exit;
}
