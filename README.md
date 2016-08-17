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


# Setup with Docker Compose

If you have Docker and docker-compose installed, you can do:

`docker-compose up`

To create a wordpress and a mysql containers which mount the local folder inside the container.

http://localhost:8000

Go through the wordpress setup and activate the theme

If you get a white page, you need to go to Settings - Reading and change the default page.


