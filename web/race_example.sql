CREATE TABLE event
(
    id SERIAL PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    location VARCHAR(100) NOT NULL,
    "date" date
)

INSERT INTO event (name, location, date) VALUES ('Color Run', 'Awesome Event Center', '2018-07-20');
INSERT INTO event (name, location, date) VALUES ('Turkey Trot', 'Porter Park', NULL);
INSERT INTO event (name, location) VALUES ('Fantastic 5k Run', 'Nature Park');

CREATE TABLE participant
(
    id SERIAL PRIMARY KEY,
    lastName VARCHAR(25) NOT NULL;
    firstName VARCHAR(25) NOT NULL;
    age INTEGER NOT NULL;
    phoneNumber VARCHAR(13) NOT NULL;
    gender BOOLEAN;
    shirtSize VARCHAR(3);
)

INSERT INTO participant (name) VALUES ('Jimmy'), ('Caleb'), ('Carl');

CREATE TABLE event_participant
(
    id SERIAL PRIMARY KEY,
    event_id INTEGER REFERENCES event(id) NOT NULL;
    participant_id INTEGER REFERENCES participant(id) NOT NULL;
)

INSERT INTO event_participant(event_id, participant_id) VALUES (1, 1) /* Color Run, Jimmy */
INSERT INTO event_participant(event_id, participant_id) VALUES (2, 1) /* Turkey Trot, Jimmy */
INSERT INTO event_participant(event_id, participant_id) VALUES (2, 2) /* Turkey Trot, Caleb */