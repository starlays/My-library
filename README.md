My-library
==========
Personal home library book organizer. The main features of the software are build    
around the user allowing him to have a nice experience while using this software.    

Installation informations:
=========================
Requirements:
------------
*  PHP, MySQL and an HTTP daemon installed

Optional requirements:
---------------------
*  You need to have git installed
*  Your browser needs to support javascript for better functionality

Install steps:
-------------
1. Clone the project using:    
`git clone git://github.com/starlays/My-library.git my-library`    
or download manually, and unzip, the latest version from [github](https://github.com/starlays/My-library/tags "Download My-library latest version").
2. Setup you timezone in php.ini, ex. date.timezone = Europe/Bucharest, see     
[php manual](http://php.net/manual/en/timezones.php "PHP manual for timezone settings")
for more informations.
3.  Set your HTTP daemon to serve `webroot` dir inside `src` dir.
4.  Create a database with the name `mylibrary` and import `mylibrary.sql` file     
from `docs\database\` to mysql, in `mylibrary` database.
5.  Go to: `config\` dir and rename `mysql_credentials.php-dist` in to `mysql_credentials.php`.
6.  Edit `mysql_credentials.php` and fill MySQL required informations.
7.  OS releated     
    *  GNU/Linux: 
         *  Take care of the rights for folder `uploads` inside `src`, the user under    
            apache runs needs writing permissions on it
8. Access your virtual Library website with `http://localhost` or `http://<your-ip>`    
or `http://example.org`