-- Create the user table
CREATE TABLE user (
    User_ID INT PRIMARY KEY AUTO_INCREMENT,
    User_name VARCHAR(50),
    User_email VARCHAR(100),
    User_password VARCHAR(100),
    User_access INT,
    User_amount_of_posts INT,
    User_created_date_account DATE,
    User_birthdate DATE,
    User_city VARCHAR(100),
    User_first_name VARCHAR(50),
    User_last_name VARCHAR(50),
    Images_Images_ID INT,
    Statistics_Statistics_ID INT
);

-- Create the posts table
CREATE TABLE posts (
    Post_ID INT PRIMARY KEY AUTO_INCREMENT,
    Post_title VARCHAR(255),
    Post_created_date DATE,
    Post_author INT,
    Post_message TEXT,
    FOREIGN KEY (Post_author) REFERENCES user(User_ID)
);

-- Create the comment table
CREATE TABLE comment (
    Comment_ID INT PRIMARY KEY AUTO_INCREMENT,
    Post_ID INT,
    Comment_date_created DATE,
    Comment_author INT,
    Comment_text TEXT,
    FOREIGN KEY (Post_ID) REFERENCES posts(Post_ID),
    FOREIGN KEY (Comment_author) REFERENCES user(User_ID)
);
