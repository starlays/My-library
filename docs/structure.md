Project structure
=================

* **src/** - source code
    * **docs/** - project documentation
        * **wireframe/** - website wireframe
        * **features.md** - file containing app features description
        * **structure.md** - file containing files/folders structure description
        * **db_design.sql** - sql file containing database design
    * **webroot/** - VIEW LOGIC
        * **index.php** - file integration and coordinator
        * **templates** - web app aspect, different themes
            * **default/** - theme folder
    * **functions/** - BUSINESS LOGIC
        * **user/** - folder containing **User features** business logic
        * **books** - folder containing **Books features** business logic
        * **admin** - folder containing **Admin panel** business logic
        * **mysql** - folder containing **MySql** business logic
