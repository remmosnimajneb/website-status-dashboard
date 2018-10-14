# Website Status System

Project: Website Status System
Code Version: 1.0
Author: Benjamin Sommer
GitHub: https://github.com/remmosnimajneb
Theme Design by: HTML5 UP (HTML5UP.NET) - Theme `Transit`
Licensing Information: CC BY-SA 4.0 (https://creativecommons.org/licenses/by-sa/4.0/)

## Table of Contents:
1. Overview
2. Requirements & Install Instructions
3. Code/Program Explanation
4. Updates to come

## SECTION 1 - OVERVIEW

So, you've got a website right? Well what happens if it goes down? How fast will you find out? Well this program does it for you

You install this nifty program on another server (backup server or something) and it checks the status of your sites and emails you if they go down!

It's as simple as that. You add sites, it checks however often you want and if it can't connect to your site 2 times in a row it sends an email to let you know!

This program is 100% open source, feel free to do anything you want to it! Just make sure to remember to give me some credit and make sure to ShareAlike! (For the full licence and fine text stuff see creativecommons.org/licenses/by-sa/4.0/).

Also while speaking about giving credit, the HTML theme comes from html5up.net made by @ajlkn (twitter.com/ajlkn). This guy makes siiiiick stuff, make sure to check him out at html5up.net (Free HTML5 Stunning Mobile Friendly Website Templates (Free!)), carrd.co (An Incredible website builder that looks amazing and works even better!) and his Twitter page (@ajlkn).


## SECTION 2 - REQUIRMENTS & INSTALL INSTRUCTIONS
	
Requirments:

- A web server, that can be accessed over the internet for use out of Local Area Network
- MySQL with PDO type PHP Extention (!Important!)
- PHP
- That's it

Aight, let's go! Let's install this thing already!!

Install: 

Here's how to install this:
1. Import or run the SQL commands to setup the system on the server - (File: SQLInstall.sql)
2. Open the functions file (File: functions.php) in your favorite text editor (h/t to mine Sublime Text 3) and configure:
	-> MySQL Database connection information
	-> (Optional) Website Title, customize it, have fun!
	-> (Optional) Admin panel credentials (Defualt is `admin` and `admin`)
	-> If anyone can access the Status Page or needs to be logged in first
	-> SMTP Settings for email
4. Move all the files to your public directory on the server (Can exclude this file and SQLInstall.sql, everything else required)
5. Setup on your Server to Auto Check the sites in whatever interval you want, On Linux you should use Crontab (http://corntab.com/) on Windows use Task Scheduler
6. That's it! Open your browser to the directory you stuck this in and add your sites!

## SECTION 3 - CODE/PROGRAM EXPLINATION

So how does this work you might be asking?
Well here we go:
1. We have a list of domains in our MySQL Database
2. Every n minutes/hours/ect. a script checks the status of each sites and updates the database with Last Seen, Last Error and Last Status
	-> If it fails to connect to a site, and Last Status is Down it sends an error email
		-> Once an email is sent it updates the database so not to send an email continously, it will reupdate the database to allow sending the next time it successfully connects
	-> It also dumps every Error to a Text file error.txt
3. The functions file allows the main page to be shown to everyone, regardless of login or only if your logged in

## SECTION 6 - FUTURE UPDATES LIST
So there's really not much I'm planning on adding but one thing I'm thinking about next is basically a Web Essentials System. A program to help you run your server with VHosts, Status, Support Tickets ect. so I figured if your here already, might as well let you know to keep an eye out for it!

Enjoy!