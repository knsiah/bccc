<?php
session_start();
echo "SUCCESS";

echo $_SESSION['id'] . " :AS ID " . $_SESSION['fname'] . " :AS FNAME " . $_SESSION['role'] . "  : AS ROLE ";
