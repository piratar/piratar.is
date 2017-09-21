# Site map / Veftré

This is the site map for the new piratar.is site. The map has been developed using research done by Halla Kolbeinsdóttir. This will serve as the base and reference for the new site. All features and templates should be derived from it. If there is stuff that is not defined in the map, please ask first on our [Facebook page](https://www.facebook.com/groups/153461471471460/) or open an issue to discuss it.

* [Site map on Google docs](https://docs.google.com/document/d/1lOsphPWbUIDPF5ExBk-NgaIr8FC7naqt50YmIFsUDpY/edit?usp=sharing)
* [Wireframe on Invision](https://invis.io/ZN511PW8J)
* [Design on Dropbox] (https://www.dropbox.com/sh/bwb5k4ivgphvi23/AAAmsh7ts2w5C1PW-B7TWnh9a?dl=0)

# Templates

* Front page
* Page
* Single (post)
* Search
* People (directory)
* Person
* Participate
* News (browse)
* Constituency (kjördæmi)
* Group/association
* Alþingi

# Theme

The theme used for the Pirate Party site is the Underscores starter theme created by WordPress/Automattic.

There are two theme folders being used:

* piratar        = piratar.is
* piratar-child/ = piratar.is/kosningar

# Development (branch)

This URL pulls the development branch every 5 minutes (for now)

http://dev.piratar.is:8080/


# Setup with Docker Compose

If you have Docker and docker-compose installed, you can do:

`docker-compose up`

Which creates a **wordpress** and **mysql** containers which mount the local folder inside the container.

(If port 80 is in use, change it in docker-compose.yml)

Visit `http://localhost/`

Go through the wordpress setup and activate the theme.

If you get a white page on your frontpage, you need to go to Settings - Reading and change the default page.


### Importing a database, f.x. from production or another project

If you need to import your own database via Docker you can do the following:

#### Importing the database to **mysql** container

1. On your local machine, copy the .sql file to the repos *piratar.is/.data/db/* This directory is mounted as */var/lib/mysql/* in the container. 

  Next you open a shell in that container, similar to SSH. 
  (Do `docker ps` to get the correct container name.)
1.  `docker exec -it pirataris_db_1 bash`  
  
  From within the container, import the .sql file. Pass & dbname = wordpress
2.  `mysql -u root -p wordpress < /var/lib/mysql/FILE.sql`

#### Edit wp-settings.php on **wordpress** container

1. `docker exec -it pirataris_wordpress_1 bash`

  You might need to install vim or nano in that container with apt-get:
   
2. `apt-get update && apt-get install vim`

3. Edit the $table_prefix or DB_NAME, depending on if you imported the tables into the same db or not.
