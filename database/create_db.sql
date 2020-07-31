DROP DATABASE IF EXISTS CareerPortal;
CREATE DATABASE CareerPortal;
USE CareerPortal;

CREATE TABLE EmployeeCategory
(
    EmployeeCategoryId INT NOT NULL AUTO_INCREMENT,
    Status VARCHAR(100),
    MonthlyCharge VARCHAR(100),
    MaxJobs VARCHAR(100),
    PRIMARY KEY (EmployeeCategoryId)
);

CREATE TABLE EmployerCategory
(
    EmployerCategoryId INT NOT NULL AUTO_INCREMENT,
    Status VARCHAR(100),
    MonthlyCharge VARCHAR(100),
    MaxJobs VARCHAR(100),
    PRIMARY KEY (EmployerCategoryId)
);

CREATE TABLE Employer
(
	EmployerId INT NOT NULL AUTO_INCREMENT,
    UserName VARCHAR(100),
    UserPassword VARCHAR(100),
    Email VARCHAR(100),
    Company VARCHAR(100),
    Telephone VARCHAR(12),
    PostalCode VARCHAR(6),
    City VARCHAR(100),
    Address VARCHAR(100),
    EmployerCategoryId INT NOT NULL,
    PRIMARY KEY (EmployerId),
    FOREIGN KEY (EmployerCategoryId) REFERENCES EmployerCategory (EmployerCategoryId)
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

CREATE TABLE Employee
(
	EmployeeId INT NOT NULL AUTO_INCREMENT,
    UserName VARCHAR(100),
    UserPassword VARCHAR(100),
    Email VARCHAR(100),
    Company VARCHAR(100),
    Telephone VARCHAR(12),
    PostalCode VARCHAR(6),
    City VARCHAR(100),
    Address VARCHAR(100),
    EmployeeCategoryId INT NOT NULL,
    PRIMARY KEY (EmployeeId),
    FOREIGN KEY (EmployeeCategoryId) REFERENCES EmployeeCategory (EmployeeCategoryId)
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

CREATE TABLE JobOffer
(
    EmployeeId INT NOT NULL,
    JobId INT NOT NULL,
    Status VARCHAR(100),
    CreationDate date NOT NULL,
    PRIMARY KEY (EmployeeId, JobId),
    FOREIGN KEY (EmployeeId) REFERENCES Employee (EmployeeId),
    FOREIGN KEY (JobId) REFERENCES Job (JobId)
);

