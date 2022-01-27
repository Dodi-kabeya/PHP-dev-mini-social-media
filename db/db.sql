
-- creating user --
create table utilisateurs(
	id int AUTO_INCREMENT,
    name varchar(30) not null,
    surname varchar(30) not null,
    email varchar(50) not null,
    phone varchar(15),
    profession varchar(30),
    address varchar(50),
    gender varchar(10),
    photo text,
    mot_de_passe text not null,
    artisan_num VARCHAR(15),
    date DATETIME,
    
    CONSTRAINT pk primary key(email),
    CONSTRAINT unk UNIQUE(id),
    CONSTRAINT unk_mail UNIQUE(email),
    constraint unk_art UNIQUE(artisan_num)
)


-- c'est bon posting photo --
CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `user_picture` text DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `date` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


-- sending and recieving messages --
create table conversations(
	id int AUTO_INCREMENT,
    email varchar(30) not null,
    recv varchar(30) not null,
    chats varchar(1500) not null,
    date datetime,
    
    constraint unk_id primary key(id),
    constraint fk_email foreign KEY(email) REFERENCES utilisateurs(email)
)