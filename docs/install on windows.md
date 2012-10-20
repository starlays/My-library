Installation steps on Windows:
========

1. Download one of the tags (latest is better): https://github.com/starlays/My-library/tags;
2. Assuming you have already php, mysql and apache installed copy what you have downloaded into apache root directory;
3. Setup you timezone in php.ini, ex. date.timezone = Europe/Bucharest, http://php.net/manual/en/timezones.php;
4. Create a database, go to docs\database\ and import mylibrary.sql file to mysql using phpmyadmin or mysql cli;
5. Edit your mysql credentials by going to config\mysql_credentials.php;
6. For security measures edit DocumentRoot and the access to it in httpd.conf allowing only .../webroot/ folder to users.
7. That is it access your new Library website with http://localhost or http://<your-ip>