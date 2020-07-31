DROP DATABASE IF EXISTS CareerPortal;
CREATE DATABASE CareerPortal;
USE CareerPortal;

CREATE TABLE Employer
(
	EmployerId INT NOT NULL AUTO_INCREMENT,
    UserName VARCHAR(100),
	FirstName VARCHAR(100),
    LastName VARCHAR(100),
    UserPassword VARCHAR(100),
    Email VARCHAR(100),
    Company VARCHAR(100),
    Telephone VARCHAR(12),
    PostalCode VARCHAR(6),
    Province VARCHAR(2),
    Address VARCHAR(100),
    PRIMARY KEY (EmployerId)
);

CREATE TABLE Job
(
    JobId INT NOT NULL AUTO_INCREMENT,
    Title VARCHAR(100),
    Category VARCHAR(100),
    JobDescription VARCHAR(100),
    DatePosted DATE,
    NeededEmployees INT NOT NULL,
    AppliedEmployees INT NOT NULL,
    AcceptedOffers INT NOT NULL,
    EmployerId INT NOT NULL, 
    PRIMARY KEY (JobId),
    FOREIGN KEY (EmployerId) REFERENCES Employer (EmployerId)
);

CREATE TABLE UserCategory
(
    UserCategoryId INT NOT NULL AUTO_INCREMENT,
    Status VARCHAR(100),
    MonthlyCharge VARCHAR(100),
    MaxJobs VARCHAR(100),
    IsForEmployer BOOL,
    EmployerId INT NOT NULL,
    EmployeeId INT NOT NULL,
    PRIMARY KEY (UserCategoryId),
    FOREIGN KEY (EmployerId) REFERENCES Employer (EmployerId),
    FOREIGN KEY (EmployeeId) REFERENCES Employer (EmployeeId)
);

CREATE TABLE Employee
(
	EmployeeId INT NOT NULL AUTO_INCREMENT,
    PRIMARY KEY (EmployeeId)
);

CREATE TABLE JobApplication
(
    EmployeeId INT NOT NULL,
    JobId INT NOT NULL,
    Status VARCHAR(100),
    PRIMARY KEY (EmployeeId, JobId),
    FOREIGN KEY (EmployeeId) REFERENCES Employee (EmployeeId),
    FOREIGN KEY (JobId) REFERENCES Job (JobId)
);

