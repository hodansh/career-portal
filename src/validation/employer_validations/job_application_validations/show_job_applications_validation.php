<?php

if (isset($_POST["showJobApplications"])) {
    $_SESSION["allJobApplications"] = FindAllJobApplicationsForEmployer();
}