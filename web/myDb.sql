PATH=%PATH%;C:\Program Files\PostgreSQL\10\bin;
heroku pg:psql

CREATE TABLE users
(
    usersId SERIAL PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(40) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE games
(
    gamesId SERIAL PRIMARY KEY,
    description TEXT NOT NULL,
    instructions TEXT NOT NULL,
    numOfPlayers INTEGER NOT NULL,
    timeLength INTEGER NOT NULL,
    numOfDecks INTEGER NOT NULL,
    relaxed BOOLEAN NOT NULL,
    title VARCHAR(50) NOT NULL,
    usersId INTEGER REFERENCES users(usersId) NOT NULL
);

CREATE TABLE savedGames
(
    savedGamesId SERIAL PRIMARY KEY,
    usersId INTEGER REFERENCES users(usersId) NOT NULL,
    gamesId INTEGER REFERENCES games(gamesId) NOT NULL
);

INSERT INTO users (username, email, password) VALUES
(
    'pizzaParty',
    'pizza@email.com',
    'password'
);

INSERT INTO users (username, email, password) VALUES
(
    'sampamalus',
    'sam@email.com',
    'password'
);

INSERT INTO games (description, instructions, numOfPlayers, timeLength, numOfDecks, relaxed, title, usersId) VALUES
(
    'Relive your childhood with this blast from the past. If you have more players just add another deck.',
    'Five cards are dealt from a standard 52-card deck to each player, or seven cards if there are four or fewer players. The remaining cards are shared between the players, usually spread out in a disorderly pile referred to as the "ocean" or "pool". The player whose turn it is to play asks another player for his or her cards of a particular face value. For example, Alice may ask, "Bob, do you have any threes?" Alice must have at least one card of the rank she requested. Bob must hand over all cards of that rank if possible. If he has none, Bob tells Alice to "go fish" (or just simply "fish"), and Alice draws a card from the pool and places it in her own hand. Then it is the next player''s turn – unless the card Alice drew is the card she asked for, in which case she shows it to the other players, and she gets another turn. When any player at any time has all four cards of one face value, it forms a book, and the cards must be placed face up in front of that player. Play proceeds to the left. When all sets of cards have been laid down in books, the game ends. The player with the most books wins.',
'7',
'15',
'1',
TRUE,
'Go Fish',
(SELECT usersId FROM users WHERE username = 'pizzaParty')
);

INSERT INTO games (description, instructions, numOfPlayers, timeLength, numOfDecks, relaxed, title, usersId) VALUES
(
    'Another simple game from your childhood. If you have more players just add another deck.',
    'Start by removing one of the Queens. Then take turns picking a card from the player to your right. If you get a match lay it down. Repeat until only one card is left. The player with the remaining Queen has lost.',
'5',
'15',
'1',
TRUE,
'Old Maid',
(SELECT usersId FROM users WHERE username = 'sampamalus')
);

INSERT INTO savedGames (usersId, gamesId) VALUES 
(
  (SELECT usersId FROM users WHERE username = 'pizzaParty'),
  (SELECT gamesId FROM games WHERE title = 'Go Fish')
);

INSERT INTO savedGames (usersId, gamesId) VALUES 
(
  (SELECT usersId FROM users WHERE username = 'sampamalus'),
  (SELECT gamesId FROM games WHERE title = 'Go Fish')
);

SELECT username, u.usersId, title, g.usersId, s.usersId FROM users u
    INNER JOIN savedGames s ON u.usersId = s.usersId
    INNER JOIN games g ON s.gamesId = g.gamesId;


DELETE FROM users WHERE username = 'testUser';