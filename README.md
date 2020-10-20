# joplin-instant-mail
Instantly convert email into a note or todo item in Joplin.

Joplin instant mail was originally announced here:
https://discourse.joplinapp.org/t/joplin-instant-mail-instantly-converts-email-into-a-note-or-todo-item-in-joplin/11721

## Prerequisites
* install and setup an email system / MTA (this example uses qmail)
* install php and composer
* install Joplin terminal app
* set up your sync target in the Joplin terminal app, e.g. Dropbox, see Joplin website for instructions
## Install script and vendor libraries
Clone this repository into you users home directory using you favourite git client, then:
```
$ cd joplin-instant-mail
$ composer install
```

## Test that this script cat put notes / todos into joplin and sync:
Create a notebook called "Inbox" in Joplin. Make sure you set up and sync that notebook or adapt the script to reflect the folder where you want to receive new todos.
```
$ cd joplin-instant-mail
$ cat mail-examples/mail-example-01.txt | php joplin-instant-mail.php
```
## Connect with your email system / MTA with the script to pass email instantly
If you are using qmail, this can be achieved as follows:
For an address of your choice, e.g. joplin-123@..., create a qmail file containing (only) the instruction to pipe any email directly to this script:
```
|php $HOME/joplin-instant-mail/joplin-instant-mail.php
```
You are done! Send an email to your chosen address, like joplin-123@..., to verify.