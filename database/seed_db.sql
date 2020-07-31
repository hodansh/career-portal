

INSERT INTO EmployerCategory
    (Status, MonthlyCharge, MaxJobs)
VALUES
    ("Prime", 50, 5),
    ("Gold", 100, NULL);


INSERT INTO EmployeeCategory
    (Status, MonthlyCharge, MaxJobs)
VALUES
	("Basic", 0, 0),
    ("Prime", 10, 5),
    ("Gold", 20, NULL);

    
INSERT INTO Employer
    (UserName, UserPassword, Email, Company, Telephone, PostalCode, City, Address, EmployerCategoryId)
VALUES ("cARIdelS","PIN70ICY1AX","est@adui.net","Tempor Corporation","(607) 973-2300","J5B0R3","Dera Ismail Khan","Ap #812-3381 Ligula. Av." , 1),
("EDBuQuIp", "DEL33VHC5PT","Mauris.eu.turpis@sed.org","Dictum Cursus Nunc Industries","(787) 607-5124","S3N5J9","Heestert","467-7255 Lectus Street" , 2),
("RKowNtAt", "VVC00ZXW5RI","dictum.eleifend.nunc@Nullasemper.org","In Tempus Eu Industries","(492) 421-6534","M4W8A3","Holyhead","3488 Montes, Av.", 1),
("TOcHraNT", "TUP89PFG4DD","lacus@cursus.edu","Quis Institute","(600) 516-5717","G6X3K5","Rengo","Ap #244-7326 Odio St." , 2),
("ICANTERt", "OXU11KYH7TB","Cum.sociis@iderat.com","Ipsum Leo Inc.","(545) 952-7187","E9G9K6","Hillsboro","9356 Orci. Rd." , 1 ),
("rLICkErD", "YUJ17TMY9RP","urna.Vivamus@Integer.net","Lorem Corp.","(958) 640-4747","S2V4Y5","Hermosillo","761 Non, Avenue", 1),
("tEgRamen", "FRD46PUN3IR","Donec.porttitor@eratin.ca","Sed Institute","(200) 498-5397","V2G3S1","Maria","P.O. Box 101, 6691 Phasellus Street", 2),
("ORNMoStA", "GAB42XZN6IP","est@ametrisusDonec.co.uk","Est Nunc Inc.","(258) 602-0597","G3H9J3","Warisoulx","P.O. Box 529, 9904 Dolor, Ave" , 1);

INSERT INTO Job
	(Title, Category, JobDescription, DatePosted, NeededEmployees, AppliedEmployees, AcceptedOffers, EmployerId)
VALUES
("Insurance Broker", 1, "Sell people insurance", "2020-02-02", 3, 0, 0, 1),-- category 1 : sales
("Travel Agent", 1, "Sell people vacation packages", "2020-02-12", 5, 1, 1, 5),
("Car Salesman", 1, "Sell people cars", "2020-03-01", 6, 2, 2, 4),
("Accounting Professor", 2, "Teach accoutning to students. 20 years experience minimum", "2020-04-20", 1, 0, 0, 2),-- category 2 : eduation
("Anatomy Professor", 2, "Teach anatomy to student. 15 years experience minimum", "2020-05-11", 2, 1, 0, 3),
("Salad Maker", 3, "Must be able to toss salads. 30 years experience minimum. Competitive salary.", "2020-04-12", 5, 2, 1, 3),-- category 2 : food
("Sandwich Maker", 3, "Must be able to make great sandwiches", "2020-05-21", 6, 22, 1, 5),
("Cocktail Server", 3, "Must be able to serve cocktails. Potential make large amount of tips.", "2020-06-23", 2, 14, 1, 6),
("Dishwasher", 3, "Requirements : 3 or more years of experience in washing dishes. Must be able to work weekends and weekdays, day and night.", "2020-04-30", 10, 55, 1, 4),
("Fryline Attendant", 3, "Looking for fryline professionals, minimum of 5 years experience, competitive pay with benefits", "2020-05-25", 12, 33, 5, 5);


-- INSERT INTO Employee
  --   (EmployeeId, UserName, UserPassword, Email, Telephone, PostalCode, City, Address, EmployeeCategoryId)
-- VALUES
-- ()
-- ;

select * from EmployerCategory;
select * from EmployeeCategory;
select * from Employer;
select * from Job;