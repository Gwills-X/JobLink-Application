This project is built for the benefit of the whole community and it is for the
purpose of making a bridge between Employers and Job seekers. Here, Employers
can Paste A Job request with all the requirements and salary then the job seeker
can apply and send request by applying and the employer will see it and either
accept it or reject and the job seeker will see if he was accepted or rejected
by the employer

<!-- for the users table -->

CREATE TABLE users ( id INT AUTO_INCREMENT PRIMARY KEY, username VARCHAR(100)
NOT NULL UNIQUE, email VARCHAR(150) NOT NULL UNIQUE, pwd VARCHAR(255) NOT NULL,
account ENUM('employer', 'job_seeker') NOT NULL, created_at TIMESTAMP DEFAULT
CURRENT_TIMESTAMP ) ENGINE=InnoDB;

<!-- For the Jobs Table -->

CREATE TABLE jobs ( id INT AUTO_INCREMENT PRIMARY KEY, employer_id INT NOT NULL,
title VARCHAR(255) NOT NULL, description TEXT NOT NULL, location VARCHAR(255)
DEFAULT 'Remote', salary DECIMAL(10,2) DEFAULT 0.00, applicants INT DEFAULT 0,
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, FOREIGN KEY (employer_id)
REFERENCES users(id) ON DELETE CASCADE ) ENGINE=InnoDB;

<!-- for the SQL code for applications table -->

CREATE TABLE applications ( id INT AUTO_INCREMENT PRIMARY KEY, job_id INT NOT
NULL, applicant_id INT NOT NULL, employer_id INT NOT NULL, cover_letter TEXT,
status ENUM('pending', 'accepted', 'rejected') DEFAULT 'pending',
application_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP, FOREIGN KEY (job_id)
REFERENCES jobs(id) ON DELETE CASCADE, FOREIGN KEY (applicant_id) REFERENCES
users(id) ON DELETE CASCADE, FOREIGN KEY (employer_id) REFERENCES users(id) ON
DELETE CASCADE ) ENGINE=InnoDB;
