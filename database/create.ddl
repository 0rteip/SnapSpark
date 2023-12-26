-- *********************************************
-- * SQL MySQL generation                      
-- *--------------------------------------------
-- * DB-MAIN version: 11.0.2              
-- * Generator date: Sep 20 2021              
-- * Generation date: Tue Dec 26 17:01:16 2023 
-- * LUN file: /opt/lampp/htdocs/SnapSpark/WEB.lun 
-- * Schema: db/1-1-1 
-- ********************************************* 


-- Database Section
-- ________________ 

create database SnapSpark;
use SnapSpark;


-- Tables Section
-- _____________ 

create table commenti (
     post_user char(30) not null,
     post_id int not null,
     user char(30) not null,
     id int not null,
     testo varchar(50) not null,
     upvote int not null,
     constraint ID_commenti_ID primary key (user, post_user, post_id, id));

create table follow (
     follower char(30) not null,
     following char(30) not null,
     constraint ID_follow_ID primary key (follower, following));

create table hashtags (
     nome char(20) not null,
     descrizione varchar(100) not null,
     nome_social char(15) not null,
     constraint ID_hashtags_ID primary key (nome));

create table posts (
     username char(30) not null,
     file char(20) not null,
     id int not null,
     descrizione varchar(100) not null,
     data date not null,
     spark int not null,
     constraint ID_posts_ID primary key (username, id));

create table likes (
     post_username char(30) not null,
     post_id int not null,
     username char(30) not null,
     constraint ID_likes_ID primary key (post_username, post_id, username));

create table socials (
     nome_social char(15) not null,
     mail char(40) not null,
     constraint ID_socials_ID primary key (nome_social));

create table utenti (
     username char(30) not null,
     nome char(20) not null,
     cognome char(20) not null,
     sesso char(1) not null,
     password char(30) not null,
     data_nascita int not null,
     mail char(40) not null,
     numero bigint not null,
     biografia varchar(100) not null,
     nome_social char(15) not null,
     constraint ID_utenti_ID primary key (username));


-- Constraints Section
-- ___________________ 

alter table commenti add constraint FKscruittura
     foreign key (user)
     references utenti (username);

alter table commenti add constraint FKricezione_FK
     foreign key (post_user, post_id)
     references posts (username, id);

alter table follow add constraint FKseguito_FK
     foreign key (following)
     references utenti (username);

alter table follow add constraint FKsegue
     foreign key (follower)
     references utenti (username);

alter table hashtags add constraint FKgiornaliero_FK
     foreign key (nome_social)
     references socials (nome_social);

alter table posts add constraint FKposta
     foreign key (username)
     references utenti (username);

alter table likes add constraint FKlik_ute_FK
     foreign key (username)
     references utenti (username);

alter table likes add constraint FKlik_pos
     foreign key (post_username, post_id)
     references posts (username, id);

alter table utenti add constraint FKappartengono_FK
     foreign key (nome_social)
     references socials (nome_social);


-- Index Section
-- _____________ 

create unique index ID_commenti_IND
     on commenti (user, post_user, post_id, id);

create index FKricezione_IND
     on commenti (post_user, post_id);

create unique index ID_follow_IND
     on follow (follower, following);

create index FKseguito_IND
     on follow (following);

create unique index ID_hashtags_IND
     on hashtags (nome);

create index FKgiornaliero_IND
     on hashtags (nome_social);

create unique index ID_posts_IND
     on posts (username, id);

create unique index ID_likes_IND
     on likes (post_username, post_id, username);

create index FKlik_ute_IND
     on likes (username);

create unique index ID_socials_IND
     on socials (nome_social);

create unique index ID_utenti_IND
     on utenti (username);

create index FKappartengono_IND
     on utenti (nome_social);

