Create database TWS
use TWS;

--Drop Table Rescues;
--Drop Table Management;
--Drop Table Public;
--Drop Table Projects;
--Drop Table Events;
--Drop Table EventPublicData;
--Drop Table RescuePublicData;
--Drop Table sponsorData;
--Drop Table fosterData;


Create Table Rescues(Rescue_ID int AUTO_INCREMENT primary key,Animal char(3) not NULL check(Animal like'Cat' OR Animal like 'Dog') ,Name varchar(20) not NULL,Gender char(6) not NULL check(Gender like'Male' OR Gender like 'Female') ,Age varchar(20),Sterile char(3) not NULL check(Sterile like'Yes' OR Sterile like 'No') ,Vac_status char(3) not NULL check( Vac_status like'Yes' OR  Vac_status like 'No'),Status varchar(20),rescued_Date Date);
Create Table Management(Management_ID int  AUTO_INCREMENT primary key,First_Name varchar(20) not NULL,Second_Name varchar(20) not NULL,Gender char(6) not NULL check(Gender like'Male' OR Gender like 'Female'),DOB Date,CNIC varchar(15) not NULL check(CNIC like'_____-_______-_'),Designation char(10) not NULL check(Designation like 'Admin' OR Designation like 'Volunteer'),Phone char(15),Pass varchar(20));
Create Table Public(Public_ID int  AUTO_INCREMENT primary key,First_Name varchar(20) not NULL,Second_Name varchar(20) not NULL,Gender char(6) not NULL check(Gender like'Male' OR Gender like 'Female'),DOB Date,CNIC varchar(15) not NULL check(CNIC like'_____-_______-_'),Phone char(15),Type_Public varchar(16));
Create Table Projects(Project_ID int AUTO_INCREMENT primary key,Project_Name varchar(20) not NULL,Area varchar(20),Starting_Date date,Ending_Date date,Goal varchar(50),Project_status varchar(10) not NULL check(Project_status like'Completed' OR Project_status like 'Ongoing' OR Project_status like'Future'));
Create Table Events(Event_ID int AUTO_INCREMENT primary key,Event_Name varchar(20) not NULL,Venue varchar(20),Event_Date date,aboutEvent varchar(100));
Create Table EventPublicData(Event_ID int,Public_ID varchar(15) not NULL check(Public_ID like'_____-_______-_'),PRIMARY KEY (Event_ID, Public_ID));
Create Table RescuePublicData(Rescue_ID int,Public_ID varchar(15) not NULL check(Public_ID like'_____-_______-_'),PRIMARY KEY (Rescue_ID, Public_ID),First_Name varchar(20) not NULL,Second_Name varchar(20) not NULL,Gender char(6) not NULL check(Gender like'Male' OR Gender like 'Female'),DOB Date,Phone char(15),Type_Public varchar(16),Dateofprocess Date);
Create Table sponsorData(Rescue_ID int,Public_ID varchar(15) not NULL check(Public_ID like'_____-_______-_'),PRIMARY KEY (Rescue_ID, Public_ID));
Create Table fosterData(Rescue_ID int,Public_ID varchar(15) not NULL check(Public_ID like'_____-_______-_'),PRIMARY KEY (Rescue_ID, Public_ID));

insert into Rescues (Animal,Name,Gender,Age,Sterile,Vac_status,Status,rescued_Date) VALUES ('Cat','BlinkA','Male',NULL,'Yes','Yes','Adoption',NULL);
insert into Rescues (Animal,Name,Gender,Age,Sterile,Vac_status,Status,rescued_Date) VALUES ('Cat','BlinkB','Male',NULL,'Yes','Yes','Foster',NULL);
insert into Rescues (Animal,Name,Gender,Age,Sterile,Vac_status,Status,rescued_Date) VALUES ('Cat','BlinkC','Male',NULL,'Yes','Yes','Sponsor',NULL);
insert into Rescues (Animal,Name,Gender,Age,Sterile,Vac_status,Status,rescued_Date) VALUES ('Cat','NekoA','Female',NULL,'Yes','Yes','Adoption',NULL);
insert into Rescues (Animal,Name,Gender,Age,Sterile,Vac_status,Status,rescued_Date) VALUES ('Cat','NekoB','Female',NULL,'Yes','Yes','Foster',NULL);
insert into Rescues (Animal,Name,Gender,Age,Sterile,Vac_status,Status,rescued_Date) VALUES ('Cat','NekoC','Female',NULL,'No','No','Sponsor',NULL);
insert into Rescues (Animal,Name,Gender,Age,Sterile,Vac_status,Status,rescued_Date) VALUES ('Dog','Kelsy','Female','2 years','Yes','Yes','Adoption',NULL);
insert into Rescues (Animal,Name,Gender,Age,Sterile,Vac_status,Status,rescued_Date) VALUES ('Dog','Jax','Male','1 year','Yes','Yes','Foster','2021-04-12');
insert into Rescues (Animal,Name,Gender,Age,Sterile,Vac_status,Status,rescued_Date) VALUES ('Dog','Merry','Female','4 months','Yes','Yes','Sponsor','2020-03-12');
insert into Rescues (Animal,Name,Gender,Age,Sterile,Vac_status,Status,rescued_Date) VALUES ('Dog','Pluto','Male','14 months','Yes','Yes','Adoption','2022-12-23');
insert into Rescues (Animal,Name,Gender,Age,Sterile,Vac_status,Status,rescued_Date) VALUES ('Dog','Bruno','Female',NULL,'Yes','Yes','Foster',NULL);
insert into Rescues (Animal,Name,Gender,Age,Sterile,Vac_status,Status,rescued_Date) VALUES ('Dog','Cinamon','Male',NULL,'No','No','Sponsor',NULL);


insert into Public (First_Name,Second_Name,Gender,DOB,CNIC,Phone,Type_Public) VALUES('RandomA','PublicA','Female','2002-06-27','35202-7586101-8','03162455583','Adoption Parent');
insert into Public (First_Name,Second_Name,Gender,DOB,CNIC,Phone,Type_Public) VALUES('RandomB','PublicB','Male','2001-08-22','35202-7545101-8','03161655583','Sponsor');


insert into Projects (Project_Name,Area,Starting_Date,Ending_Date,Goal,Project_status) VALUES('TNVR','Valencia','2023-01-01',NULL,'Spay/Neuter stray dogs','Ongoing');
insert into Projects (Project_Name,Area,Starting_Date,Ending_Date,Goal,Project_status) VALUES('TNVR','Yumnabad','2023-03-01',NULL,'Spay/Neuter stray dogs','Ongoing');
insert into Projects (Project_Name,Area,Starting_Date,Ending_Date,Goal,Project_status) VALUES('TNVR','Wabi','2023-03-01',NULL,'Adoption Campaign','Completed');
insert into Projects (Project_Name,Area,Starting_Date,Ending_Date,Goal,Project_status) VALUES('TNVR','Shelter','2023-03-01',NULL,'Fundraiser','Completed');
insert into Projects (Project_Name,Area,Starting_Date,Ending_Date,Goal,Project_status) VALUES('TNVR','Johar town',NULL,NULL,'Spay/Neuter stray dogs','Future');
insert into Projects (Project_Name,Area,Starting_Date,Ending_Date,Goal,Project_status) VALUES('TNVR','Wapda town',NULL,NULL,'Spay/Neuter stray dogs','Future');

insert into Events (Event_Name,Venue,Event_Date,aboutEvent) VALUES('Halloween','testStudio','2023-06-03','Halloween Party for fundrasing');
insert into Events (Event_Name,Venue,Event_Date,aboutEvent) VALUES('Birthday Party','Shelter','2023-07-03','Birthday Party for fundrasing');

insert into Management (First_Name,Second_Name,Gender,DOB,CNIC,Designation,Phone,Pass) VALUES('admin','admin','Male','2001-12-02','11111-1111111-1','Admin','03000000','123');


select * from Rescues;
select * from Management;
select * from Projects;
select * from Public;
select * from Events;
select * from EventPublicData;
select * from RescuePublicData;
select * from sponsorData;
select * from fosterData;