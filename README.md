# ThriftApp

ThriftApp is a web app that helps with thrift contribution management, its implemented with 
HTML, CSS, JS and PHP.

## Local Setup
- Move entire project folder into the xampp htdocs folder
- open constants.php at app/utils and edit the database constants values with your dbms corresponding details.
- make sure the db details provided are those used by your local xampp mysql server.
- Create 'thriftApp' database using phymyadmin or any tool that can help with the db creation.
- using phpmyadmin or any tool of your choice, import the thriftApp.sql file in the base folder of the app into the thriftApp database.
- try the url 'http://localhost/thriftApp/public' and see if there's no error generated
- if an error exist, go over the setup instructions again and troubleshoot.


## Cron job setup
add the following line to your cron tab and replace '/path/to/project' with the path to the project 
```bash
0 0 25-31 * * php /path/to/project/app/cronJobs/thriftReminder.php
```

## Start app
- try the url 'http://localhost/thriftApp/public' and see if there's no error generated else retry the local setup steps

## Contributing

Pull requests are welcome. For major changes, please open an issue first
to discuss what you would like to change.

Please make sure to update tests as appropriate.
