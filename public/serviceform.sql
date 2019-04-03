use userbase_system;

CREATE TABLE subscription_form  (
	id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
	servicetitle VARCHAR(50) NOT NULL,
	servicesdesc VARCHAR(50) NOT NULL,
	servicescost VARCHAR(30) NOT NULL, 
    servicedate VARCHAR(30) NOT NULL,
    servicelength VARCHAR(30) NOT NULL,
    service_end VARCHAR(30),
	date TIMESTAMP
);