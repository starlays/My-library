Project structure
=================

* **docs/** - project documentation
    * **wireframe/**    - website wireframe
    * **roadmap/**      - project roadmap
    * **database**      - database documentation related files
    * **features.md**   - file containing app features description
    * **structure.md**  - file containing files/folders structure description
* **src/** - source code
    * **layout.php**         - website layout file
    * **style.css**          - website stylization file
    * **router.php**         - module loading coordinator file
    * **module_holder.php**  - module(pages) configuration file
    * **webroot/** - VIEW LOGIC
        * **index.php** - file integration and coordinator
     * **modules/** - BUSINESS LOGIC (modules location dir)
        * **user/**         - folder containing **Module User features** business logic
        * **books**         - folder containing **Module Books features** business logic
        * **admin**         - folder containing **Module Admin panel** business logic
        * **mysql**         - folder containing **Module MySql** business logic
        * **base**          - folder containing **Module App base** business logic
        * **register**      - folder containing **Module register** business logic
        * **recover**       - folder containing **Module recover** business logic
        * **login**         - folder containing **Module login** business logic
        * **home**          - folder containing **Module home** business logic
