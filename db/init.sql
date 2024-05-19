-- Insert sample data into the user table
INSERT INTO user (User_name, User_email, User_password, User_access, User_amount_of_posts, User_created_date_account, User_birthdate, User_city, User_first_name, User_last_name, Images_Images_ID, Statistics_Statistics_ID) VALUES
('john_doe', 'john@example.com', 'password123', 1, 10, '2024-01-01', '1990-05-10', 'New York', 'John', 'Doe', 1, 1),
('jane_smith', 'jane@example.com', 'password456', 1, 5, '2024-02-15', '1985-08-20', 'Los Angeles', 'Jane', 'Smith', 2, 2),
('bob_jones', 'bob@example.com', 'password789', 1, 3, '2024-03-20', '1978-11-30', 'Chicago', 'Bob', 'Jones', 3, 3);

-- Insert sample data into the posts table
INSERT INTO posts (Post_title, Post_created_date, Post_author, Post_message) VALUES
('First Post', '2024-01-05', 1, 'This is the content of the first post.'),
('Second Post', '2024-02-20', 2, 'This is the content of the second post.'),
('Third Post', '2024-03-25', 3, 'This is the content of the third post.');

-- Insert sample data into the comment table
INSERT INTO comment (Post_ID, Comment_date_created, Comment_author, Comment_text) VALUES
(1, '2024-01-06', 2, 'Nice post!'),
(1, '2024-01-07', 3, 'Great job, John!'),
(2, '2024-02-21', 1, 'Interesting read.'),
(3, '2024-03-26', 2, 'I agree with your points.');
