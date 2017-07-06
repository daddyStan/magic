<?php
/**
 * Created by PhpStorm.
 * User: Koshpaev SV
 * Date: 06.07.2017
 * Time: 23:07
 */

$tables = [
    'content' => 'CREATE TABLE `magic`.`content` 
                  ( `content_id` INT NOT NULL AUTO_INCREMENT , 
                    `name` TEXT NOT NULL , 
                    `title` INT NOT NULL , 
                    `text` INT NOT NULL , 
                    `img` TEXT NOT NULL , 
                    `dop_text` INT NOT NULL , 
                    `main_title` TEXT NOT NULL , 
                    `date_changed` INT NOT NULL ,
                     PRIMARY KEY (`content_id`)) 
                     ENGINE = InnoDB;',
                    'content_from_storm' => 'create table content
                        (content_id int auto_increment
                        primary key,
                        name text not null,
                        title text not null,
                        text text not null,
                        img text not null,
                        dop_text text not null,
                        main_title text not null,
                        date_changed date not null);'
];