Process payment notifications tool

To install the project :
- Clone the project in your local environment
- In your terminal, run : <pre>composer install</pre> to install all the needed libraries
- Create an empty database. Edit the database details in 'bootstrap.php' file
- In your terminal, run : <pre>vendor/bin/doctrine orm:schema-tool:update --dump-sql --force</pre>
to create the tables according to the project entities.
- Run your web server, then run init.php file to fill the reference tables
- The project is now ready to use! Open your web browser and go to the project root : You should see the main page of the project
