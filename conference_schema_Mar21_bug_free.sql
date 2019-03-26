CREATE TABLE Conference( conference_name VARCHAR(100) NOT NULL PRIMARY KEY );

INSERT INTO Conference(conference_name) VALUE('QUU Conference');

CREATE TABLE Sessions(
	session_name VARCHAR(100) NOT NULL,
	session_date DATE NOT NULL,
	session_start_time TIME NOT NULL,
	session_end_time TIME NOT NULL,
	room VARCHAR(100) NOT NULL,
	conference_name VARCHAR(100) NOT NULL,
	speaker_first_name VARCHAR(100) NOT NULL,
	speaker_last_name VARCHAR(100) NOT NULL,
	PRIMARY KEY(
		session_name),
	FOREIGN KEY(
		conference_name
		)REFERENCES Conference(
		conference_name
		)ON DELETE CASCADE
);

INSERT INTO Sessions(session_name, session_date, session_start_time, session_end_time, room, conference_name, speaker_first_name, speaker_last_name) VALUE('Scalable Bayesian Inference', '2019-03-01','10:00:00', '11:00:00', '101', 'QUU Conference', 'Shini', 'Ko');
INSERT INTO Sessions(session_name, session_date, session_start_time, session_end_time, room, conference_name, speaker_first_name, speaker_last_name) VALUE('Visualization for Machine Learning', '2019-03-01', '11:00:00', '12:00:00', '101', 'QUU Conference', 'Yuankang', 'Zhang');
INSERT INTO Sessions(session_name, session_date, session_start_time, session_end_time, room, conference_name, speaker_first_name, speaker_last_name) VALUE('Negative Dependence, Stable Polynomials, and All That', '2019-03-01','10:00:00', '11:00:00', '102', 'QUU Conference', 'Suvrit', 'Jegelka');
INSERT INTO Sessions(session_name, session_date, session_start_time, session_end_time, room, conference_name, speaker_first_name, speaker_last_name) VALUE('Unsupervised Deep Learning', '2019-03-01', '11:00:00', '12:00:00', '102', 'QUU Conference', 'Alex', 'Graves');

INSERT INTO Sessions(session_name, session_date, session_start_time, session_end_time, room, conference_name, speaker_first_name, speaker_last_name) VALUE('Machine Learning in Social Network', '2019-03-01', '14:00:00', '15:00:00', '102', 'QUU Conference', 'Mark', 'Zuckerberg');
INSERT INTO Sessions(session_name, session_date, session_start_time, session_end_time, room, conference_name, speaker_first_name, speaker_last_name) VALUE('Adversarial Robustness: Theory and Practice', '2019-03-01', '14:00:00', '15:00:00', '101', 'QUU Conference', 'Aleksander', 'Madry');

INSERT INTO Sessions(session_name, session_date, session_start_time, session_end_time, room, conference_name, speaker_first_name, speaker_last_name) VALUE('Common Pitfalls for Studying the Human Side of Machine Learning', '2019-03-02','10:00:00', '11:00:00', '101', 'QUU Conference', 'Deirdre', 'Mulligan');
INSERT INTO Sessions(session_name, session_date, session_start_time, session_end_time, room, conference_name, speaker_first_name, speaker_last_name) VALUE('Counterfactual Inference', '2019-03-02', '11:00:00', '12:00:00', '101', 'QUU Conference', 'Susan', 'Athey');
INSERT INTO Sessions(session_name, session_date, session_start_time, session_end_time, room, conference_name, speaker_first_name, speaker_last_name) VALUE('Automatic Machine Learning', '2019-03-02','10:00:00', '11:00:00', '102', 'QUU Conference', 'Frank', 'Hutter');
INSERT INTO Sessions(session_name, session_date, session_start_time, session_end_time, room, conference_name, speaker_first_name, speaker_last_name) VALUE('Statistical Learning Theory: a Hitchhiker Guide', '2019-03-02', '11:00:00', '12:00:00', '102', 'QUU Conference', 'Omar', 'Rivasplata');

INSERT INTO Sessions(session_name, session_date, session_start_time, session_end_time, room, conference_name, speaker_first_name, speaker_last_name) VALUE('Accountability and Algorithmic Bias: Why Diversity and Inclusion Matters', '2019-03-02', '14:00:00', '15:00:00', '102', 'QUU Conference', 'Laura', 'Gomez');
INSERT INTO Sessions(session_name, session_date, session_start_time, session_end_time, room, conference_name, speaker_first_name, speaker_last_name) VALUE('Machine Learning Meets Public Policy: What to Expect and How to Cope', '2019-03-02', '14:00:00', '15:00:00', '101', 'QUU Conference', 'Edward', 'Felten');


CREATE TABLE Sponsor_company(
	company_name VARCHAR(50) NOT NULL,
	grade ENUM('Platinum', 'Gold', 'Silver', 'Bronze') NOT NULL,
	email_allowance ENUM('5', '4', '3', '0') NOT NULL,
	email_sent INTEGER,
	rate INTEGER,
	PRIMARY KEY(
		company_name,
		grade,
email_allowance,
email_sent
	)
);	

INSERT INTO Sponsor_company(company_name, grade, rate, email_allowance, email_sent) VALUE('Apple Inc', 'Platinum', 10000, '5', 0);
INSERT INTO Sponsor_company(company_name, grade, rate, email_allowance, email_sent) VALUE('Queens U', 'Gold', 5000, '4', 1);
INSERT INTO Sponsor_company(company_name, grade, rate, email_allowance, email_sent) VALUE('TD', 'Gold', 5000, '4', 0);
INSERT INTO Sponsor_company(company_name, grade, rate, email_allowance, email_sent) VALUE('RBC', 'Silver', 3000, '3', 2);
INSERT INTO Sponsor_company(company_name, grade, rate, email_allowance, email_sent) VALUE('Fido', 'Bronze', 1000, '0', 0);
 
CREATE TABLE Rooms(
	room_id VARCHAR(50) NOT NULL,
	bed_count INTEGER NOT NULL,
	PRIMARY KEY(
		room_id,
		bed_count
	)
);
INSERT INTO Rooms(room_id,bed_count) VALUE('904', 2);
INSERT INTO Rooms(room_id,bed_count) VALUE('903', 2);
INSERT INTO Rooms(room_id,bed_count) VALUE('902', 2);
INSERT INTO Rooms(room_id,bed_count) VALUE('901', 2);

CREATE TABLE Attendee(
	attendee_id INTEGER NOT NULL,
	attendee_first_name VARCHAR(50) NOT NULL,
	attendee_last_name VARCHAR(50) NOT NULL,
	attendee_type ENUM('student', 'professional', 'sponsor'),
	rate INTEGER,
	email VARCHAR(100) NOT NULL,
	phone VARCHAR(100), 
	company_name  VARCHAR(100),
	speak_at VARCHAR(50),
	live_in VARCHAR(50),
	PRIMARY KEY(
		attendee_id
	),
	FOREIGN KEY(
		company_name
	) REFERENCES Sponsor_company(
		company_name
	),
	FOREIGN KEY(
		speak_at
	) REFERENCES Sessions(
		session_name
	),
	FOREIGN KEY(
		live_in
	) REFERENCES Rooms(
		room_id
	)
);

INSERT INTO Attendee(attendee_id, attendee_first_name, attendee_last_name, attendee_type, rate, email, phone, live_in) VALUE(2001, 'Eric', 'Chu', 'student', 50, 'eric.chu@queensu.ca', '6137702515', '903');
INSERT INTO Attendee(attendee_id, attendee_first_name, attendee_last_name, attendee_type, rate, email, phone, live_in) VALUE(2002, 'Kobe', 'James', 'student', 50, 'kobe.james@queensu.ca', '6137702001','903');
INSERT INTO Attendee(attendee_id, attendee_first_name, attendee_last_name, attendee_type, rate, email) VALUE(3001, 'Steve', 'Curry', 'professional', 100,  'steve.c@gmail.com');
INSERT INTO Attendee(attendee_id, attendee_first_name, attendee_last_name, attendee_type, rate, email, company_name) VALUE(4001, 'Steves', 'Jobs', 'sponsor', 0, 'steves.j@apple.com', 'Apple Inc');
INSERT INTO Attendee(attendee_id, attendee_first_name, attendee_last_name, attendee_type, rate, email, speak_at, live_in) VALUE(1001, 'Shini', 'Ko', 'student', 50, 'shini.ko@queensu.com', 'Scalable Bayesian Inference', "902");
INSERT INTO Attendee(attendee_id, attendee_first_name, attendee_last_name, attendee_type, rate, email, speak_at) VALUE(1002, 'Yuankang', 'Zhang', 'student', 50, 'yuankang.zhang@queensu.com', 'Visualization for Machine Learning');
INSERT INTO Attendee(attendee_id, attendee_first_name, attendee_last_name, attendee_type, rate, email, speak_at) VALUE(1003, 'Mark', 'Zuckerberg', 'professional', 100, 'm.z@facebool.com', 'Machine Learning in Social Network');

 
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

INSERT INTO Committee(committee_name) VALUE('QUU Committee');

CREATE TABLE Sub_committee(
	sub_committee_name VARCHAR(100) NOT NULL,
	committee_name VARCHAR(100) NOT NULL,
	PRIMARY KEY(
		sub_committee_name
	),
	FOREIGN KEY(
		committee_name
	) REFERENCES Committee(
		committee_name
	) ON DELETE CASCADE
);

INSERT INTO Sub_committee(sub_committee_name, committee_name) VALUE('Program Committee', 'QUU Committee');
INSERT INTO Sub_committee(sub_committee_name, committee_name) VALUE('Registration Committee', 'QUU Committee');
INSERT INTO Sub_committee(sub_committee_name, committee_name) VALUE('Sponsorship Committee', 'QUU Committee');

CREATE TABLE Member(
	member_id INTEGER NOT NULL,
	member_first_name VARCHAR(50) NOT NULL,
	member_last_name VARCHAR(50) NOT NULL,
	conference_name VARCHAR(50) NOT NULL,
	chair_of VARCHAR(50),
	PRIMARY KEY(
      member_id
	),
	FOREIGN KEY(
      conference_name
	)REFERENCES Conference(
      conference_name
	)ON DELETE CASCADE,
	FOREIGN KEY(
      chair_of
	)REFERENCES Sub_committee(
      sub_committee_name
    )ON DELETE CASCADE
);

INSERT INTO Member(member_id, member_first_name, member_last_name, conference_name, chair_of) VALUE(9999, 'Elon', 'Musk', 'QUU Conference', 'Program Committee');
INSERT INTO Member(member_id, member_first_name, member_last_name, conference_name, chair_of) VALUE(9998, 'Stephen', 'King', 'QUU Conference', 'Registration Committee');
INSERT INTO Member(member_id, member_first_name, member_last_name, conference_name, chair_of) VALUE(9997, 'Tim', 'Cook', 'QUU Conference','Sponsorship Committee');
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
