# Setting up the Piratar.is website locally

## Purpose and intended audience
The purpose of this tutorial is to provide continuity for the development and administration of the website of Pirate Party Iceland. The product of this tutorial is a full copy of the live website, with real data, running on a user's local computer or virtual machine.

If you have not been provided a role in improving or administering the website by the executive council or its deputies, then this tutorial is probably useless to you.

## Assumptions

* It is assumed that you are using a **Debian-based hosting environment** (for example Debian or Ubuntu). If you are running Windows or Mac OS X, you can choose between figuring out how to do what is described here on your operating system, or you can run Debian or Ubuntu in a virtual environment, such as VirtualBox. This tutorial was tested using Debian on VirtualBox.
* It is assumed that you are already **familiar with general system administration** tasks, such as using a Linux command line, retrieving files online and such.
* It is assumed that you have been provided with the **necessary access** to the website's hosting environment to retrieve the live data required in this tutorial. This means that you need to get approval from the executive council or its deputies, as well as the technical information needed for retrieving the data.

Assumed file names, passwords and locations in this tutorial:

* The MySQL root password is assumed to be `mysql_root_password`, which of course, it shouldn't be.

## Requirements

### Software requirements:
* Git
* Apache
* PHP
* MySQL

### Data requirements
* A copy of the 'htdocs' directory from the Pirate Party Iceland live website, from now on referred to as `htdocs`.
* A copy of the live database, from now on referred to as `localhost.sql`.

**NOTE**: These can only be obtained by the authority of the executive council or its deputies. Their retrieval is beyond the scope of this tutorial. You should get copies of these two items before you continue.

## Step 0: Before we begin
Commands that are demonstrated here should be run on the command line unless otherwise stated. This tutorial was written with copy-pasting in mind, so if you stick to the same directory structure and use the same file names, you should be able to copy and paste the commands from here directly into your command line, except when we're dealing with passwords.

The local URL for our the website will be `http://piratar.dev`, or in other words, the local domain name will be `piratar.dev`.

**IMPORTANT**: Once you have the local website working and start browsing it, you should pay special attention to the URL and make sure that you are indeed browsing http://piratar.dev and not http://piratar.is. You should pay special attention to this if you have problems with your local changes to the website not taking effect.

We'll be doing all of this as the root user, so let's start there.
```
# Become root.
sudo su -
```

## Step 1: Install required software.

```
sudo apt-get -y install apache2 libapache2-mod-php5 mysql-server php5-mysql git
```

During the installation process you may be asked to provide a MySQL root password, if the MySQL server was not already installed. For this tutorial, we assume that the password is `mysql_root_password`, but of course you should pick something else.

## Step 2: Gather the web files

Most of the custom-made material on the website are publicly available in a Git repository on GitHub, at `https://github.com/piratar/piratar.is.git`.

Still, the live website contains more material which is not in the GitHub repository, including the WordPress installation itself as well as various configuration options, plugins and such.

We want these two collections of files to live together in our local installation; the files from the Git repository, as well as the files from the live website. We should be able to copy our files to the live site to realize our changes, but most of the time we'll be changing files that also belong in the Git repository, so they must be uploaded there as well. *Please note that this does not mean that all the files from the live site belong in the Git repository - only the other way around.*

Let's start by copying the files that we should have obtained from the live site, to the proper local location. The `htdocs` are assumed to be in root's home directory, `/root`. We also assume that the directory `/var/www/piratar.is` does not already exist.

```
cp -a /root/htdocs /var/www/piratar.is
```

Now we want to clone the Git repository into this folder, so that the files live together as previously described. We use a little trick in order to achieve this effect, which is cloning the online Git repo to a temporary directory, then copying its `.git` directory to the web files directory and deleting the temporary directory. By doing this, we get a directory which contains both the live files as well as the files from the Git repository.

```
# Enter the local website location.
cd /var/www/piratar.is

# Clone the repo into a temporary directory.
git clone https://github.com/piratar/piratar.is.git temp

# Move the Git files from the Git repository to the current directory.
mv temp/.git .

# Delete the temporary repo directory.
rm -rf temp

# Hard-reset, so that we have the web files and Git repo combined.
git reset --hard
```

Now we have all the files living in the same place, whether they belong only in the Git repository, or in the Git repository as well as on the live site.

## Step 3: Set up the website's database access

First we need to give our website access to a MySQL database.

There are two ways to do this. You can either use your own password and configure WordPress accordingly, or you can simply copy and use whatever password is currently set in the existing live files. Here, we will go the simple route and do the latter. If you want to use your own password instead, change the setting in the configuration file instead of copying it and then use your own password instead of the one copied. If this paragraph only confused you, ignore it and move on.

Find the website configuration file.
```
# Enter the website directory.
cd /var/www/piratar.is
```

Open the file `wp-config.php` with your favorite text editor. Find a line that looks like this:
```
define('DB_PASSWORD', 'some-string');
```

Note that the phrase "some-string" is something different. Whatever it says, copy it to your clipboard, without the quotes. In this tutorial, we will continue to refer to the password as `some-string`, so whenever you see this tutorial mention `some-string`, replace it with the password that you copied to your clipboard.

Now we are going to create a database which the website has access to, using this password.

**NOTE**: As described in the introduction, the MySQL root password is assumed to be `mysql_root_password`.

```
# Connect to MySQL as root.
mysql -u root -p
# Enter MySQL root password.
```

Once you have the MySQL prompt, create the database and grant access to it.
**WARNING**: If you copy and paste the following 3 lines from this tutorial into your MySQL shell, you need to replace `some-string` with the password you copied from the configuration file above.
```
CREATE DATABASE `1_piratar`;
GRANT ALL ON `1_piratar`.* TO `1_piratar`@`localhost` IDENTIFIED BY 'some-string';
EXIT; # Exit from MySQL, back to the operating system's shell.
```

At this point we should be back in the operating system shell, and we have gathered the website's files that we need, and we have an empty database which the website has access to.

## Step 4: Set up live data in local database
We will now copy the live database into our MySQL instance.

**NOTE**: As described in the introduction, it is assumed that the live site's database file exists in the root's home directory `/root` and that it has the filename `localhost.sql`.

```
# Import the live site data into the website's database.
mysql 1_piratar -u 1_piratar -p < /root/localhost.sql
# Paste the password you copied from the w-config.php file here.
# This could take a while.
```

Next we need to update a bunch of values in the database so that it works on our local `piratar.dev` domain. Otherwise, it will simply redirect you to `piratar.is`, which is useless.

Connect to the MySQL database as the user `1_piratar`, supplying the website's MySQL password like before.

```
mysql 1_piratar -u 1_piratar -p
# Paste the password again.
```

Then copy-paste this sequence of lines. Note that the string `piratar.dev` is the desired domain name.

*NOTE*: Doing this means that you can run the live website locally, but it also means that you will be unable to copy the database back to the live site, unless you revert the values back to `piratar.is`. This is fine, because you shouldn't copy the database back to the live site anyway. If you need to make database changes to the lives site, you should test them locally and repeat what you did on the live database.

Anyway, run this in the MySQL shell:
```
UPDATE `1_piratar`.`wpir4t4r_site` SET `domain`='piratar.dev' WHERE `id`='1';
UPDATE `1_piratar`.`wpir4t4r_sitemeta` SET `meta_value`='http://piratar.dev/' WHERE `meta_id`='14';
UPDATE `1_piratar`.`wpir4t4r_blogs` SET `domain`='piratar.dev' WHERE `blog_id`='1';
UPDATE `1_piratar`.`wpir4t4r_blogs` SET `domain`='piratar.dev' WHERE `blog_id`='2';
UPDATE `1_piratar`.`wpir4t4r_blogs` SET `domain`='piratar.dev' WHERE `blog_id`='3';
UPDATE `1_piratar`.`wpir4t4r_options` SET `option_value`='http://piratar.dev' WHERE `option_id`='1';
UPDATE `1_piratar`.`wpir4t4r_options` SET `option_value`='http://piratar.dev' WHERE `option_id`='2';
UPDATE `1_piratar`.`wpir4t4r_2_options` SET `option_value`='http://piratar.dev/kosningar' WHERE `option_id`='1';
UPDATE `1_piratar`.`wpir4t4r_2_options` SET `option_value`='http://piratar.dev/kosningar' WHERE `option_id`='2';
```

If everything went fine, you can exit:

```
EXIT;
```

## Step 5: Set up Apache.
Enter the directory where Debian keeps its site-specific Apache configuration files.

```
cd /etc/apache2/sites-available
```

The directory ```/etc/apache2/sites-available``` is where Debian keeps its configuration files. However, in order to enable them, they must be symbolically linked in ```/etc/apache2/sites-enabled``` as well. We'll do this in a moment, but first we need to create a file called ```piratar.dev.conf```. The exact name of the file is not important, as long as it ends with ```.conf```.

Here is an example of a file which should work out of the box:

```
<VirtualHost *:80>
	ServerName piratar.dev
	ServerAdmin webmaster@localhost
	DocumentRoot /var/www/piratar.is
	
	ErrorLog ${APACHE_LOG_DIR}/error.log
	CustomLog ${APACHE_LOG_DIR}/access.log combined

	# BEGIN WordPress
	<Directory /var/www/piratar.is>
		<IfModule mod_rewrite.c>
		RewriteEngine On
		RewriteBase /
		RewriteRule ^index\.php$ - [L]
		RewriteCond %{REQUEST_FILENAME} !-f
		RewriteCond %{REQUEST_FILENAME} !-d
		RewriteRule . /index.php [L]
		</IfModule>
		AllowOverride All
	</Directory>
	# END WordPress
</VirtualHost>
```
Then we create a symbolic link in the proper place, in order to enable the configuration.

```
# Enter the sites-enabled directory.
cd /etc/apache2/sites-enabled

# Create a symbolic link to the configuration.
ln -s ../sites-available/piratar.dev.conf
```

We must also enable the Apache module `rewrite`. The available/enabled functionality is the same in that regard:

```
# Enter the mods-enabled directory.
cd /etc/apache2/mods-enabled

# Create a symbolic link to the rewrite-module.
ln -s ../mods-available/rewrite.load
```

We then restart Apache for our changes to take effect.

```
service apache2 restart
```

## Step 5: Fake the piratar.dev domain

Now we need to tell you computer that the fake domain `piratar.dev` actually refers to your web server. In order to do this, we need to edit the so-called `hosts` file. This is the same procedure on Linux, Unix-based systems (such as Mac OS X) and Windows, except the location of the file is different on Windows.

First we need the IP address of the machine that is running your local copy of the website. If you are setting this up directly on your own local computer, or if you intend to develop and test the site from within the virtual machine, then this IP address will be `127.0.0.1`.

If you are running your web server in a virtual machine (such as VirtualBox) but want to browse it from your host system, you need to find the virtual machine's IP address, make sure that you can reach it from your operating system and edit the `hosts` file on your host machine. This is beyond the scope of this tutorial, so we will assume that you intend to develop and test on the same machine as the web server runs on, in which case the IP is 127.0.0.1.

On Linux and Mac OS X, the file is `/etc/hosts`. On Windows, it's `C:\Windows\System32\drivers\etc\hosts`. You will need root privileges or administrator privileges to change it.

Open the file with your favorite text editor.

Add the following line somewhere:
```
127.0.0.1 piratar.dev
```

Save and close the file.

## Step 6: Test the website locally

Open your favorite browser and go to the URL `http://piratar.dev`. The Pirate Party Iceland website should appear. Click some links to make sure that you stay on `piratar.dev` and not `piratar.is`. Note that sometimes there are hard links that go to `piratar.is`, but navigation and general links should still keep you on `piratar.dev`.

That's it! Now you can mess around with it and see if you can improve stuff!
