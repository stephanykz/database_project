CREATE TABLE Conference( conference_name VARCHAR(100) NOT NULL PRIMARY KEY );

INSERT INTO Conference(conference_name) VALUE('QUU Conference');

CREATE TABLE Sessions(
	session_name VARCHAR(100) NOT NULL,
	session_date DATE NOT NULL,
	session_start_time TIME NOT NULL,
	session_end_time TIME NOT NULL,
	room VARCHAR(100) NOT NULL,
	conference_name VARCHAR(100) NOT NULL,
	PRIMARY KEY(
		session_name),
	FOREIGN KEY(
		conference_name
		)REFERENCES Conference(
		conference_name
		)ON DELETE CASCADE
);

INSERT INTO Sessions(session_name, session_date, session_start_time, session_end_time, room, conference_name) VALUE('Maths', '2019-03-01','10:00:00', '11:00:00', 102, 'QUU Conference');
INSERT INTO Sessions(session_name, session_date, session_start_time, session_end_time, room, conference_name) VALUE('Physics', '2019-03-01'. '12:00:00', '13:00:00', 102, 'QUU Conference');
INSERT INTO Sessions(session_name, session_date, session_start_time, session_end_time, room, conference_name) VALUE('Computer Science', '2019-03-02', '14:00:00', '15:00:00', 102, 'QUU Conference');

CREATE TABLE Sponsor_company(
	company_name VARCHAR(50) NOT NULL,
	grade ENUM('Platinum', 'Gold', 'Silver', 'Bronze') NOT NULL,
	email_allowance ENUM('5', '4', '3', '0') NOT NULL,
	email_sent INTEGER,
	PRIMARY KEY(
		company_name,
		grade,
email_allowance,
email_sent
	)
);	
INSERT INTO Sponsor_company(company_name, grade, email_allowance, email_sent) VALUE('Apple Inc', 'Platinum', '5', 0);
 
CREATE TABLE Attendee(
	attendee_id INTEGER NOT NULL,
	attendee_first_name VARCHAR(50) NOT NULL,
	attendee_last_name VARCHAR(50) NOT NULL,
	attendee_type ENUM('student', 'professional', 'sponsor') ,
	rate ENUM('$50', '$100', 'Free'),
	email VARCHAR(100) NOT NULL,
	phone VARCHAR(100), 
	company_name  VARCHAR(100),
	speak_at VARCHAR(50)
	PRIMARY KEY(
		attendee_id
	),
	FOREIGN KEY(
		company_name
	) REFERENCES Sponsor_company(
		company_name
	) 
);
INSERT INTO Attendee(attendee_id, attendee_first_name, attendee_last_name, attendee_type, rate, email, phone) VALUE(2001, 'Eric', 'Chu', 'student', '$50', 'eric.chu@queensu.ca', '6137702515');
INSERT INTO Attendee(attendee_id, attendee_first_name, attendee_last_name, attendee_type, rate, email, phone) VALUE(2002, 'Kobe', 'James', 'student', '$50', 'kobe.james@queensu.ca', '6137702001');
INSERT INTO Attendee(attendee_id, attendee_first_name, attendee_last_name, attendee_type, rate, email) VALUE(3001, 'Steve', 'Curry', 'professional', '$100',  'steve.c@gmail.com');
INSERT INTO Attendee(attendee_id, attendee_first_name, attendee_last_name, attendee_type, rate, email, company_name) VALUE(4001, 'Steves', 'Jobs', 'sponsor', 'FREE', 'steves.j@apple.com', 'Apple Inc');
INSERT INTO Attendee(attendee_id, attendee_first_name, attendee_last_name, email, speak_at) VALUE(1001, 'Shini', 'Ko',  'shini.ko@queensu.com', 'Maths');
INSERT INTO Attendee(attendee_id, attendee_first_name, attendee_last_name, email, speak_at) VALUE(1002, 'Yuankang', 'Zhang',  'yuankang.zhang@queensu.com', 'Physics');
 
CREATE TABLE Rooms(
	room_id VARCHAR(50) NOT NULL,
	bed_count INTEGER NOT NULL,
	PRIMARY KEY(
		room_id,
		bed_count
	)
);
INSERT INTO Rooms(room_id,bed_count) VALUE('903', 2);
 

CREATE TABLE Attendee_in_room(
	attendee_id INTEGER NOT NULL,
	attendee_first_name VARCHAR(50) NOT NULL,
attendee_last_name VARCHAR(50) NOT NULL,
room_id VARCHAR(50) NOT NULL,

PRIMARY KEY(
	attendee_id
),
FOREIGN KEY(
		room_id
	) REFERENCES Room(
		room_id
),
FOREIGN KEY(
	attendee_id
	) REFERENCES Attendee(
		attendee_id
	)ON DELETE CASCADE
);

INSERT INTO Attendee_in_room(attendee_id, attendee_first_name, attendee_last_name, room_id) VALUE(2001, ‘Eric’, ‘Chu’, ‘903’);		

CREATE TABLE Ads(
	company_name VARCHAR(100) NOT NULL,
	job_title VARCHAR(100) NOT NULL,
	location_city VARCHAR(100) NOT NULL,
	location_province VARCHAR(100) NOT NULL,
	pay_rate INTEGER NOT NULL,
	PRIMARY KEY(
		job_title,
		location_city,
		location_province,
		pay_rate
	),
	FOREIGN KEY(
		company_name
	) REFERENCES Sponsor_company(
		company_name
	)
);
INSERT INTO Ads(company_name, job_title, location_city, location_province, pay_rate) VALUE('Apple Inc', 'Data Engineer', 'Kingston', 'Ontario', 100000); 

CREATE TABLE Committee(
committee_name VARCHAR(100) NOT NULL PRIMARY KEY
);

INSERT INTO Conference(committee_name) VALUE('QUU Committee');

CREATE TABLE Member(
	member_id INTEGER NOT NULL,
	member_first_name VARCHAR(50) NOT NULL,
	member_last_name VARCHAR(50) NOT NULL,
	conference_name VARCHAR(50) NOT NULL,
	chair_of VARCHAR(50)
	PRIMARY KEY(
      member_id，
      committee_chair
	),
	FOREIGN KEY(
      conference_name
	)REFERENCES Conference(
      conference_name
	)ON DELETE CASCADE
);

INSERT INTO Member(member_id, member_first_name, member_last_name, conference_name, chair_of) VALUE(9999, 'Elon', 'Musk', 'QUU Conference', 'Program Committee');
INSERT INTO Member(member_id, member_first_name, member_last_name, conference_name, chair_of) VALUE(9998, 'Stephen', 'King', 'QUU Conference', 'Registration Committee');
INSERT INTO Member(member_id, member_first_name, member_last_name, conference_name, chair_of) VALUE(9997, 'Tim', 'Cook', 'QUU Conference', 'Sponsorship Committee');
INSERT INTO Member(member_id, member_first_name, member_last_name, conference_name) VALUE(9996, 'Sherry', 'Hollie', 'QUU Conference');
 

CREATE TABLE Sub_committee_members(
	member_id INTEGER NOT NULL,
	sub_committee_name VARCHAR(100) NOT NULL,
	PRIMARY KEY(
		member_id,
		sub_committee_name
	)
);

INSERT INTO Sub_committee_members(member_id, sub_committee_name) 
VALUE(9999, 'Program Committee');
INSERT INTO Sub_committee_members(member_id, sub_committee_name) 
VALUE(9999, 'Registration Committee');
INSERT INTO Sub_committee_members(member_id, sub_committee_name) 
VALUE(9998, 'Registration Committee');
INSERT INTO Sub_committee_members(member_id, sub_committee_name) 
VALUE(9997, 'Sponsorship Committee');

