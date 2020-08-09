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
	(UserName, UserPassword, Email, Company, Telephone, PostalCode, City, Address, EmployerCategoryId, Status)
VALUES ("cARIdelS","PIN70ICY1AX","est@adui.net","Tempor Corporation","(607) 973-2300","J5B0R3","Dera Ismail Khan","Ap #812-3381 Ligula. Av." , 1, "active"),
("EDBuQuIp", "DEL33VHC5PT","Mauris.eu.turpis@sed.org","Dictum Cursus Nunc Industries","(787) 607-5124","S3N5J9","Heestert","467-7255 Lectus Street" , 2, "active"),
("RKowNtAt", "VVC00ZXW5RI","dictum.eleifend.nunc@Nullasemper.org","In Tempus Eu Industries","(492) 421-6534","M4W8A3","Holyhead","3488 Montes, Av.", 1, "active"),
("TOcHraNT", "TUP89PFG4DD","lacus@cursus.edu","Quis Institute","(600) 516-5717","G6X3K5","Rengo","Ap #244-7326 Odio St." , 2, "active"),
("ICANTERt", "OXU11KYH7TB","Cum.sociis@iderat.com","Ipsum Leo Inc.","(545) 952-7187","E9G9K6","Hillsboro","9356 Orci. Rd." , 1, "active"),
("rLICkErD", "YUJ17TMY9RP","urna.Vivamus@Integer.net","Lorem Corp.","(958) 640-4747","S2V4Y5","Hermosillo","761 Non, Avenue", 1, "active"),
("tEgRamen", "FRD46PUN3IR","Donec.porttitor@eratin.ca","Sed Institute","(200) 498-5397","V2G3S1","Maria","P.O. Box 101, 6691 Phasellus Street", 2, "active"),
("ORNMoStA", "GAB42XZN6IP","est@ametrisusDonec.co.uk","Est Nunc Inc.","(258) 602-0597","G3H9J3","Warisoulx","P.O. Box 529, 9904 Dolor, Ave" , 1, "active");

INSERT INTO Employee
	(UserName, UserPassword, Email, Telephone, PostalCode, City, Address, EmployeeCategoryId, Status)
VALUES ("InVOYlSt","RTE63MML2BG","elit@lacusAliquam.net","(950) 451-5515", "H8R5P9" ,"Velaine-sur-Sambre","P.O. Box 846, 5504 Quisque Street", 1, "active"),
("hOUTeTEs","TOY58FPK4BH","in@inceptoshymenaeos.edu","(118) 546-3737","L3V0S4","FlŽnu","Ap #855-6921 Nunc St.", 2, "active"),
("rAVEntRo","YNH09ICY3JD","nec@faucibus.ca","(824) 986-3970", "E5T5T7","Wolkrange","256 Orci, Avenue", 3, "active"),
("INUIdITe","PZD60LAB3GJ","eu.tellus.Phasellus@Nullamut.net","(808) 403-6752","E8B8E5","Hoeilaart","1317 Tincidunt Avenue", 1, "active"),
("iNgSONjO","FOJ81MDI4DP","turpis.In.condimentum@laoreet.ca","(263) 809-3227","E6J9P4","Mirpur","P.O. Box 499, 1021 Arcu. Road", 1, "active"),
("istersIF","COT14RBF3LR","ultrices@nullaIntincidunt.edu","(868) 294-0509","E6J2A4","Maizeret","P.O. Box 207, 4921 Pellentesque Rd.", 2, "active"),
("seLiGUAd", "MKD16IAF8LI","sagittis@tellusjustosit.edu","(838) 226-0703","J2K4J1","Ipatinga","1360 A, St.", 3, "active"),
("TSWAWOvE","GNC23GKH3ZU","at.nisi.Cum@aliquamarcu.com","(311) 937-6139","B1H1P7","Lorient","453-4390 Ante. St.", 1, "active"),
("apERMaTe","LGR68TUH3VC","tortor@Phasellusdapibus.co.uk","(827) 615-8069","H8Y8M7","Parndorf","976-2969 Sem, St.", 2, "active"),
("EoRtEbUl","HTI82ENW8UK","orci.in@Donecnibhenim.co.uk","(394) 368-4806","G8P7R6","San Pablo","922-9462 Libero. Av.", 3, "active"),
("iONESupT","KCO10RXK9NG","mi.lorem.vehicula@tellusjusto.net","(980) 801-7416","E8C4Y8","Gwalior","Ap #977-4149 Egestas. Rd.", 3, "active"),
("IngrOpEC","NNB69VVT9BE","Ut@hendreritaarcu.org","(348) 365-0308","G6G2V0","Helkijn","Ap #852-2963 Sit St.", 3, "active"),
("SiaBlEMy", "PJD75AZW9HD","orci.quis@congueaaliquet.org","(113) 286-2877","G0N5C9","Greenlaw","P.O. Box 918, 437 Lorem, Av.", 2, "active"),
("ICUriaNe","OJL48OKI2FM","adipiscing.Mauris@tinciduntcongueturpis.ca","(336) 873-0697","G0N5C9","Sparwood","P.O. Box 757, 3282 Diam Rd.", 3, "active");

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

INSERT INTO Payment
	(PaymentType, WithDrawalType, Status, EmployeeId, EmployerId)
VALUES
("Credit card", "Automatic", "Active", 1, null),
("Checking account", "Manual" , "Frozen" , 2, null),
("Credit card", "Automatic", "Active", null, 1),
("Checking account", "Manual", "Active", null, 2);

INSERT INTO UserProfile
	(FirstName, LastName, Degree, EmployeeId)
VALUES
("Haviva","Barton","BB",1),
("Cadman","Flowers","AA",2),
("William","Fisher","AC", 3),
("Jorden","Wood","VE", 4),
("Jarrod","Mccormick","ER",5),
("Bernard","Gibson","DA",6),
("Serena","Oneal","QW", 7),
("Joshua","Fleming","RE",8),
("Wylie","Gilbert","YE",9),
("Anjolie","Gamble","ET",10),
("Farrah","Dotson","LK",11),
("Ezekiel","Griffin","SDC",12),
("Stone","King","DSDS",13),
("Ryan","Douglas","SSQ",14);

select * from EmployerCategory;
select * from EmployeeCategory;
select * from Employer;
select * from Job;
SElECT * From Employee;
SELECT * From Payment;
SELECT * From UserProfile;
