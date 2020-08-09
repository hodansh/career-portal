<?php
include_once "../database_operations.php";

if (isset($_POST["showJobs"])) {
    $_SESSION["allJobs"] = findAll("Job");
}