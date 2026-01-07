
Best Teacher Election System (Sistem Pilihan Guru Terbaik)
Overview
============================================================================================================

This system is developed using PHP, SQL, HTML, CSS, and JavaScript.
It is a Malay (Bahasa Melayu) language system for conducting elections to select the best teacher.

The system has two user roles:

Elector (Pengundi) – Can vote for candidates (Calon) and view candidate profiles.

Admin (Pentadbir) – Can manage the system fully, including CRUD operations for admins, candidates, and electors, generate reports, and import data from text files into the database.


Features
============================================================================================================
Elector (Pengundi)

Vote for a candidate (Calon).

View detailed profiles of all candidates.

Restricted access to administrative functions.

Admin (Pentadbir)

Manage Users:

Add, Edit, Delete Admin accounts.

Add, Edit, Delete Candidates (Calon).

Add, Edit, Delete Electors (Pengundi).

Reporting:

Generate election reports.

Data Import:

Import bulk data for candidates or electors via text file for SQL insertion.

Technologies Used

Frontend: HTML, CSS, JavaScript

Backend: PHP

Database: MySQL / SQL

Language: Bahasa Melayu (BM)


Installation
============================================================================================================
Brackets IDE for PHP Code
Xampp for SQL Logic

Xampp Installer v7.4.33
https://sourceforge.net/projects/xampp/files/XAMPP%20Windows/7.4.33/xampp-windows-x64-7.4.33-0-VC15-installer.exe/download

Brackets Installer 
https://en.softonic.com/download/brackets/windows/post-download?dt=internalDownload&installerType=riseInstaller



Usage
============================================================================================================

Elector Login: Use elector credentials to vote and view candidates.

Admin Login: Use admin credentials to manage the system, generate reports, and import data.


Database Structure
============================================================================================================

The system mainly includes the following tables:

admin – Stores admin accounts.

calon – Stores candidate information.

pengundi – Stores elector information.


Notes
============================================================================================================

Only admins can perform CRUD and data import.

Electors can vote only once per election.

Reports are generated in a format suitable for printing or saving.


Step A - Z
============================================================================================================
Install both PHP IDE and SQL IDE
Paste folder under 
C:\XAMPP\htdocs\undi
Import the SQL file into XAMPP
Start XAMPP - Start Apache and MySQL
Open Browser - Type "localhost/undi"

Admin and User Account Credential
============================================================================================================
Admin
User: A00
PW: admin123

Calon
User: U00
PW: 1234
