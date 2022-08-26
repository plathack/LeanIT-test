<?php

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'test');
define('DB_TABLE_VERSIONS', 'versions');



function connectDB()
{
    $errorMessage = 'Невозможно подключиться к серверу базы данных';
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    if (!$conn)
        throw new Exception($errorMessage);
    else {
        $query = $conn->query('set names utf8');
        if (!$query)
            throw new Exception($errorMessage);
        else
            return $conn;
    }
}


function migrate($conn)
{

    $sections = 'create table `sections` (
        `id` int(10) unsigned not null auto_increment,
        `name` varchar(255) not null,
        primary key (id)
    )
    
    engine = innodb
    auto_increment = 1
    character set utf8
    collate utf8_general_ci;
     ';
     
     $posts = 'create table `posts` (
        `id` int(10) unsigned not null auto_increment,
        `name` varchar(255) not null,
        `description` text not null,
        primary key (id)
    )
    
    engine = innodb
    auto_increment = 1
    character set utf8
    collate utf8_general_ci;
     ';

    $conn->query($sections);
    $conn->query($posts);
}


function seed($conn) 
{
    $sectionSeeder = 'insert into `sections` (`name`) values
    ("JS"), ("PHP"), ("PYTHON");';

    $postSeeder = 'insert into `posts` (`name`, `description`) values
    ("JS", "JS is cool"), ("PHP", "PHP is cool"), ("PYTHON", "PYTHON is cool");';

    $conn->query($sectionSeeder);
    $conn->query($postSeeder);
}


migrate(connectDB());

seed(connectDB());




