-- Create/Delete/Edit/Display an Employer
INSERT INTO Employer 
     (UserName, UserPassword, Email, Company, Telephone, PostalCode, City, Address, EmployerCategoryId,Status)
VALUES	 
     ("ORNndotA", "RAB52AZN6IP","est@amedwisdeonec.co.uk","Cat Nuc In.","(232) 402-0247","G3H9J3","Warisoulx","P.O. Box 529, 9904 Dolor, Ave" , 1, "active");
DELETE FROM Employer
WHERE UserName = "ORNndotA";

UPDATE Employer
SET Company = "Pres"
WHERE EmployerId = 2;

Select*
From Employer;

-- Create/Delete/Edit/Display a category by an Employer
INSERT INTO EmployerCategory 
     (Status, MonthlyCharge, MaxJobs)
VALUES ("Gold",100, null);
     
DELETE FROM EmployerCategory
WHERE EmployerCategory = 1;

UPDATE EmployerCategory
SET MaxJobs = null
WHERE Status = "Gold";

Select*
From EmployerCategory;

-- Post a new job by an employer.    
INSERT INTO Job 
	(Title, Category, JobDescription, DatePosted, NeededEmployees, AppliedEmployees, AcceptedOffers, EmployerId)
VALUES
("Frydant", 3, "Looking for fry prof, minimum of 5 years experience, competitive pay with benefits", "2020-05-25", 11, 0, 0, 5);

-- Provide a job offer for an employee by an employer. 
INSERT INTO JobOffer
	(EmployeeId, JobId, Status, CreationDate)
VALUES
(1, 9, 0, "2020-08-09");


-- Report of a posted job by an employer (Job title and description, date posted, list of employees applied to the job and status of each application). 
SELECT Job.Title, Job.JobDescription, Job.DatePosted, Employee.UserName , JobApplication.status
FROM Job, JobApplication, Employee
WHERE Job.JobId = JobApplication.JobId and JobApplication.EmployeeId = Employee.EmployeeId and Job.EmployerId = 1;

-- Report of posted jobs by an employer during a specific period of time (Job title, date posted, short description of the job up to 50 characters, number of needed employees to the post, number of applied jobs to the post, number of accepted offers). 
SELECT Job.Title, Job.JobDescription, Job.DatePosted, Employee.UserName , JobApplication.status
FROM Job, JobApplication, Employee
WHERE Job.JobId = JobApplication.JobId and JobApplication.EmployeeId = Employee.EmployeeId and Job.EmployerId = 1 and Job.DatePosted BETWEEN "2018-01-01" and 2020-01-01;

-- Create/Delete/Edit/Display an Employee. 
INSERT INTO Employee
	(UserName, UserPassword, Email, Telephone, PostalCode, City, Address, EmployeeCategoryId,Status)
VALUES 
("CPUessNe","53D50OKI2FM","acing.Mau@iduntcongueturpis.com","(116) 873-0697","H3D5C9","Parwood","P.O. Box 457, 2182 Diam Rd.", 3, "active");

DELETE FROM Employee
WHERE UserName = "CPUessNe";

UPDATE Employee
SET City = "Montreal"
WHERE EmployeeId = 3; 

-- Search for a job by an employee.
SELECT Job.*
FROM Job
WHERE NeededEmployees > 0;  -- Searching for jobs with NeedEmployees more than 0

-- Apply for a job by an employee. 
INSERT INTO JobApplication
	(EmployeeId,JobId, Status)
VALUES
(1,1,"Pending");	-- EmployeeId 1 applied for JobId 1 and the status is pending

-- Accept/Deny a job offer by an employee.
UPDATE JobOffer
SET Status = 1 -- Status 1 = accepted and Status 0 = rejected
WHERE EmployeeId = 1; -- For EmployeeId 2 the status of his/her JobOffer is changed to 1

-- Withdraw from an applied job by an employee. 
UPDATE JobApplication
SET status = "WithDrawn"
Where EmployeeId = 1; -- WithDrawn JobApplication for EmployeeId 1

-- Delete a profile by an employee. 
DELETE FROM UserProfile
WHERE EmployeeId = 10; -- Deleting UserProfile for EmployeeId 10

-- Report of applied jobs by an employee during a specific period of time (Job title, date applied, short description of the job up to 50 characters, status of the application). 
SELECT Job.Title, Job.JobDescription, Job.DatePosted, JobApplication.Status
FROM Job, JobApplication
Where Job.JobId = JobApplication.JobId and JobApplication.EmployeeId = 1 and Job.DatePosted BETWEEN "2018-01-01" and 2020-01-01 ;

-- Add/Delete/Edit a method of payment by a user.  
INSERT INTO Payment
	(PaymentType, WithDrawalType, Status,Balance, EmployeeId, EmployerId)
VALUES
("Checking account", "Manual", "Active",-100, null, 3); 

DELETE FROM Payment 
WHERE EmployerId = 3;

UPDATE Payment
SET PaymentType = "Credit card"
Where EmployeeId = 1;

-- Add/Delete/Edit an automatic payment by a user.
INSERT INTO Payment
	(PaymentType, WithDrawalType, Status, EmployeeId, EmployerId)
VALUES
("Checking account", "Automatic", "Active", null, 4);

DELETE FROM Payment 
WHERE EmployerId = 3 and WithDrawalType = "Automatic";

UPDATE Payment
SET PaymentType = "Credit card"
Where EmployeeId = 1 and WithDrawalType = "Automatic";

Select* From Payment;

-- Make a manual payment by a user.
INSERT INTO Payment
	(PaymentType, WithDrawalType, Status, EmployeeId, EmployerId)
VALUES
("Checking account", "Manual", "Active", 4, null);

-- Report of all users by the administrator for employers or employees (Name, email, category, status, balance.
Select UserProfile.FirstName, UserProfile.LastName, Employee.Email, EmployeeCategory.Status, Charge.balance
From Employee, UserProfile, EmployeeCategory, Payment, Charge
Where Employee.EmployeeId = UserProfile.EmployeeId and EmployeeCategory.EmployeeCategoryId = Employee.EmployeeCategoryId and Employee.EmployeeId = Payment.EmployeeId and Payment.PaymentId = Charge.PaymentId ;

Select Employer.Company, Employer.Email, EmployerCategory.Status, Charge.balance
From Employer, EmployerCategory, Payment, Charge
Where EmployerCategory.EmployerCategoryId = Employer.EmployerCategoryId and Employer.EmployerId = Payment.EmployerId and  Payment.PaymentId = Charge.PaymentId;

-- Report of all outstanding balance accounts (User name, email, balance, since when the account is suffering). 
Select Employee.UserName, Employee.Email, Charge.balance, Charge.OutStandingDate
From Employee, Payment, Charge
Where Charge.balance > 0 and Employee.EmployeeId = Payment.EmployeeId and   Payment.PaymentId = Charge.PaymentId;

Select Employer.UserName, Employer.Email, Charge.balance, Charge.OutStandingDate
From Employer, Payment, Charge
Where Charge.balance > 0 and Employer.EmployerId = Payment.EmployerId and   Payment.PaymentId = Charge.PaymentId;
