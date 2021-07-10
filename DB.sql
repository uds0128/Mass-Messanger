
/*users table*/

/*Reminder to update table to created date and modify timnestamp*/
-- CREATE TABLE users
-- (
--     id bigint PRIMARY KEY AUTO_INCREMENT,
--     email varchar(320) UNIQUE,
--     firstname varchar(30),
--     lastname  varchar(30),
--     password_hash varchar(255)
-- ) ;





/*CREATE TABLE usersintermidiate
(
    id bigint PRIMARY KEY AUTO_INCREMENT,
    email varchar(320) UNIQUE,
    firstname varchar(30),
    lastname  varchar(30),
    password_hash varchar(255),
    token varchar(255),
    requested_at datetime DEFAULT CURRENT_TIMESTAMP,
    verified_status boolean DEFAULT false,
    verified_at datetime DEFAULT null
) ;*/


CREATE TABLE users
(
    id bigint PRIMARY KEY AUTO_INCREMENT,
    email varchar(320) UNIQUE,
    firstname varchar(30),
    lastname  varchar(30),
    password_hash varchar(255),
    created_at datetime DEFAULT CURRENT_TIMESTAMP,
    updated_at datetime DEFAULT null,
    is_admin boolean default false
) ;


CREATE TABLE resetpasswordtokens 
(
    id bigint PRIMARY KEY AUTO_INCREMENT,
    userid bigint,
    token varchar(255),
    timestamp datetime DEFAULT CURRENT_TIMESTAMP,
    status boolean DEFAULT false,
    FOREIGN KEY (userid) REFERENCES users(id)
);

CREATE TABLE resetedpasswords
(
    id bigint PRIMARY KEY AUTO_INCREMENT,
    userid bigint,
    old_hash varchar(255),
    new_hash varchar(255),
    changed_at datetime DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (userid) REFERENCES users(id)
);

CREATE TABLE contacts 
( 
    id bigint AUTO_INCREMENT PRIMARY KEY,
    firstname varchar(20),
    middlename varchar(20),
    lastname varchar(20),
    email varchar(255),
    contactno varchar(10),
    created_at datetime DEFAULT CURRENT_TIMESTAMP,
    updated_at datetime
);

CREATE TABLE groupsmaster 
(
    id bigint PRIMARY KEY AUTO_INCREMENT,
    name varchar(50) UNIQUE,
    description varchar(255) DEFAULT null,
    created_at datetime DEFAULT CURRENT_TIMESTAMP
);


CREATE TABLE groupdetails
(
    id bigint AUTO_INCREMENT PRIMARY KEY,
    contactid bigint,
    groupid bigint,
    created_at datetime DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (contactid) REFERENCES contacts(id) ON DELETE CASCADE,
    FOREIGN KEY (groupid) REFERENCES groupsmaster(id) ON DELETE CASCADE
)

CREATE VIEW contactgroup as SELECT groupdetails.id, groupdetails.groupid, groupdetails.contactid, contacts.firstname, contacts.middlename, contacts.lastname, contacts.email, contacts.contactno;