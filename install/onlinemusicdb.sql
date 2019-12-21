CREATE DATABASE onlinemusicdb;
use onlinemusicdb;

CREATE TABLE album(
	id_album int AUTO_INCREMENT PRIMARY KEY,
    album_name varchar(100),
    alnum_img varchar(200)
);

CREATE TABLE singer(
	id_singer int AUTO_INCREMENT PRIMARY KEY,
    singer_name varchar(100),
    des_singer varchar(1000),
    singer_img varchar(200)
);

CREATE TABLE song(
	id_song int AUTO_INCREMENT PRIMARY KEY,
    song_name varchar(200),
    link_song varchar(200),
    status_song varchar(10),
    liycs_song varchar(2000),
    id_album int,
    id_user int,
    song_img varchar(200),
    FOREIGN KEY (id_album) REFERENCES album(id_album)
);

CREATE TABLE detail_song(
	id_song int PRIMARY key,
    id_singer int ,
    FOREIGN KEY (id_song) REFERENCES song(id_song),
     FOREIGN KEY (id_singer) REFERENCES singer(id_singer)
);


CREATE TABLE role(
	id_role varchar(10) PRIMARY KEY,
    name_role varchar(100)
);
CREATE TABLE user_web(
	id_user int AUTO_INCREMENT PRIMARY KEY,
    user_fullname varchar(200),
    birthday date,
    address varchar(200),
    user_name varchar(100),
    email varchar(100),
    user_password varchar(100),
    id_role int,
    user_img varchar(100)
);
CREATE TABLE category
( 
    id_category int AUTO_INCREMENT PRIMARY KEY, 
    category_name varchar(100) 
);
CREATE TABLE region ( id_region int AUTO_INCREMENT PRIMARY KEY, region_name varchar(100) )
ALTER TABLE song 
ADD COLUMN date_add date NULL
AFTER song_img;



ALTER TABLE detail_song 
ADD COLUMN id_album int NULL
AFTER id_singer;


ALTER TABLE detail_song ADD FOREIGN KEY (id_album) REFERENCES album1(id_album);
SELECT * FROM `song` WHERE WEEK(date_add) = WEEK(CURRENT_TIME);