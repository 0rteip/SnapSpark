-- Populate table

-- Inserisci dati per la tabella socials
INSERT INTO socials (nome_social, mail) VALUES
('SnapSpark', 'info@snapsocial.com');

-- Inserisci dati aggiuntivi per la tabella utenti
INSERT INTO utenti (username, nome, cognome, sesso, password, data_nascita, mail, numero, biografia, nome_social) VALUES
('john_doe', 'John', 'Doe', 'M', 'password123', '1990-01-01', 'john.doe@example.com', '1234567890', 'I love sharing positive moments!', 'SnapSpark'),
('jane_smith', 'Jane', 'Smith', 'F', 'pass123', '1988-05-15', 'jane.smith@example.com', '9876543210', 'Enjoying life one moment at a time.', 'SnapSpark'),
('mary_jones', 'Mary', 'Jones', 'F', 'marypass', '1995-03-10', 'mary.jones@example.com', '5551112233', 'Spreading happiness every day!', 'SnapSpark'),
('sam_wilson', 'Sam', 'Wilson', 'M', 'samuelpass', '1983-08-22', 'sam.wilson@example.com', '9871122334', 'Living life to the fullest!', 'SnapSpark'),
('emily_wang', 'Emily', 'Wang', 'F', 'emilypass', '1992-12-05', 'emily.wang@example.com', '1234455667', 'Chasing dreams and capturing moments.', 'SnapSpark'),
('alex_smith', 'Alex', 'Smith', 'M', 'alexpass', '1997-05-18', 'alex.smith@example.com', '4567788990', 'Exploring the world one photo at a time.', 'SnapSpark'),
('olivia_taylor', 'Olivia', 'Taylor', 'F', 'oliviapass', '1989-09-30', 'olivia.taylor@example.com', '7890011223', 'Making memories and sharing joy!', 'SnapSpark'),
('will_miller', 'Will', 'Miller', 'M', 'willpass', '1993-04-12', 'will.miller@example.com', '1122334455', 'Life is an adventure!', 'SnapSpark'),
('grace_anderson', 'Grace', 'Anderson', 'F', 'gracepass', '1996-07-25', 'grace.anderson@example.com', '3344556677', 'Every day is a gift.', 'SnapSpark'),
('daniel_carter', 'Daniel', 'Carter', 'M', 'danielpass', '1985-11-08', 'daniel.carter@example.com', '5566778899', 'Photography enthusiast and positivity spreader.', 'SnapSpark'),
('sophia_garcia', 'Sophia', 'Garcia', 'F', 'sophiapass', '1994-02-14', 'sophia.garcia@example.com', '8899001122', 'Believe in the beauty of every moment.', 'SnapSpark'),
('ryan_nguyen', 'Ryan', 'Nguyen', 'M', 'ryanpass', '1991-06-03', 'ryan.nguyen@example.com', '1122334455', 'Living the dream and inspiring others.', 'SnapSpark');

-- Inserisci dati per la tabella hashtags
INSERT INTO hashtags (nome, descrizione, nome_social) VALUES
('happy', 'Share your happy moments!', 'SnapSpark'),
('inspiration', 'Inspiring moments to brighten your day.', 'SnapSpark'),
('motivation', 'Get inspired and motivated!', 'SnapSpark'),
('travel', 'Explore the world and share your adventures.', 'SnapSpark'),
('fitness', 'Stay fit and healthy together!', 'SnapSpark'),
('pets', 'Celebrate the joy of having pets.', 'SnapSpark'),
('art', 'Express yourself through art and creativity.', 'SnapSpark'),
('music', 'Share your favorite tunes and musical moments.', 'SnapSpark'),
('books', 'Discuss and recommend your favorite books.', 'SnapSpark'),
('positivity', 'Spread positivity and good vibes!', 'SnapSpark');


-- DATI AGGIUNTIVI


-- Inserisci dati di follow tra gli utenti
INSERT INTO follow (follower, following) VALUES
('john_doe', 'jane_smith'),
('jane_smith', 'mary_jones'),
('mary_jones', 'sam_wilson'),
('sam_wilson', 'emily_wang'),
('emily_wang', 'alex_smith'),
('alex_smith', 'olivia_taylor'),
('olivia_taylor', 'will_miller'),
('will_miller', 'grace_anderson'),
('grace_anderson', 'daniel_carter'),
('daniel_carter', 'sophia_garcia'),
('sophia_garcia', 'ryan_nguyen'),
('john_doe', 'sam_wilson'),
('sam_wilson', 'olivia_taylor'),
('olivia_taylor', 'grace_anderson'),
('grace_anderson', 'daniel_carter'),
('daniel_carter', 'ryan_nguyen'),
('ryan_nguyen', 'mary_jones'),
('mary_jones', 'emily_wang'),
('emily_wang', 'alex_smith'),
('alex_smith', 'will_miller'),
('will_miller', 'sophia_garcia'),
('sophia_garcia', 'john_doe');

-- Inserisci dati per la tabella posts
INSERT INTO posts (username, file, id, descrizione, data, spark) VALUES
('john_doe', 'image1.jpg', 1, 'Enjoying a sunny day!', '2023-12-26', 0),
('john_doe', 'imag21.jpg', 2, 'Enjoying a snowy day!', '2023-12-28', 0),
('jane_smith', 'video1.mp4', 1, 'Feeling inspired today!', '2023-12-25', 0),
('mary_jones', 'foodpic.jpg', 1, 'Delicious homemade meal!', '2023-12-24', 0),
('sam_wilson', 'travel1.jpg', 1, 'Exploring new places!', '2023-12-23', 0),
('emily_wang', 'artwork.jpg', 1, 'Expressing creativity through art.', '2023-12-22', 0),
('alex_smith', 'petselfie.jpg', 1, 'Quality time with my furry friend!', '2023-12-21', 0),
('olivia_taylor', 'musiccover.mp3', 1, 'Jamming to my favorite song!', '2023-12-12', 0),
('olivia_taylor', 'runsong.mp3', 2, 'What a Beautiful day to run!', '2023-12-20', 0),
('will_miller', 'fashionstyle.jpg', 1, 'Today\'s stylish outfit!', '2023-12-19', 0),
('grace_anderson', 'bookshelf.jpg', 1, 'A glimpse into my book collection.', '2023-12-18', 0),
('daniel_carter', 'techgadget.jpg', 1, 'Exciting new tech gadget!', '2023-12-17', 0);
