<?php

if (isset($_POST["showJobs"])) {
    $_SESSION["allJobs"] = findAll("Job");
}