drop database if exists AC2024;
Create DATABASE AC2024;
USE AC2024;

Create Table Users (
    ID BIGINT NOT NULL Primary Key,
    first_name Varchar(50) NOT NULL,
    middle_name Varchar(50) NULL DEFAULT NULL,
    last_name Varchar(50) NOT NULL,
    username Varchar(50) NOT NULL,
    email Varchar(50) NOT NULL,
    password_hash Varchar(50) NOT NULL,
    profile_picture Varchar(300) NULL DEFAULT NULL,
    Nationality Varchar(100) NULL DEFAULT NULL,
    Created_at DATETIME NOT NULL,
    Updated_at DATETIME NOT NULL,
    Unique index uq_username (username ASC),
    Unique index uq_email (email ASC)
);

Create Table Posts (
    id BIGINT NOT NULL AUTO_INCREMENT Primary Key,
    user_id BIGINT NOT NULL,
    content TEXT NOT NULL,
    created_at DATETIME NOT NULL,
    updated_at DATETIME NULL DEFAULT NULL,
    INDEX idx_post_user (user_id ASC),
     CONSTRAINT fk_post_user
     FOREIGN KEY (user_id)
     REFERENCES users (id)
     ON DELETE NO ACTION
    ON UPDATE NO ACTION
);

Create Table Comments (
    ID Bigint not null auto_increment Primary Key,
    post_id BIGINT NOT NULL,
    user_id BIGINT NOT NULL,
    content TEXT NOT NULL,
    created_at DATETIME NOT NULL,
    updated_at DATETIME NULL DEFAULT NULL,
    PRIMARY KEY (id),
    INDEX idx_comment_post (post_id ASC),
    INDEX idx_comment_user (user_id ASC),
    CONSTRAINT fk_comment_post
    FOREIGN KEY (post_id)
    REFERENCES posts (id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
    CONSTRAINT fk_comment_user
    FOREIGN KEY (user_id)
    REFERENCES users (id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION

);

Create Table Likes (
    id bigint AUTO_INCREMENT Primary Key,
    post_id BIGINT NOT NULL,
    user_id BIGINT NOT NULL,
    StudentID Int References Students(StudentID),
    Title Varchar(100) References Books(Title),
    BorrowDate DATE NOT NULL,
    like_type ENUM('LIKE', 'DISLIKE') NOT NULL,
    created_at DATETIME NOT NULL,
    updated_at DATETIME NULL DEFAULT NULL,
    INDEX idx_like_post (post_id ASC),
    INDEX idx_like_user (user_id ASC),
    CONSTRAINT fk_like_post
    FOREIGN KEY (post_id)
    REFERENCES posts (id)
	ON DELETE NO ACTION
    ON UPDATE NO ACTION,
    CONSTRAINT fk_like_user
    FOREIGN KEY (user_id)
    REFERENCES users (id)
    ON DELETE NO ACTION
);

