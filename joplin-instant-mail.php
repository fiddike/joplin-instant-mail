<?php
// ## prerequisites: installed joplin terminal app, set up your sync target, e.g. dropbox, see joplin website for instructions
//
// ## create and sync a joplin notebook called "Inbox", this is where todos from emails are put into.
//
// ## install this vendor library https://github.com/zbateson/mail-mime-parser and its dependencies:
// $ cd joplin-instant-mail
// $ composer install
//
// ## test that this script cat put notes / todos into joplin and sync:
// $ cd joplin-instant-mail
// $ cat mail-examples/mail-example-01.txt | php joplin-instant-mail.php
//
// ## connect with your email system / MTA to receive email instantly, this example assumes qmail is handling email:
// ## for an address of your choice, e.g. joplin-123@..., create a qmail file containing (only) the instruction to pipe any email directly to this script:
// |php $HOME/joplin-instant-mail/joplin-instant-mail.php

require_once __DIR__ . '/vendor/autoload.php';

$message = \ZBateson\MailMimeParser\Message::from(stream_get_contents(STDIN));
$safeMessageSubject = escapeshellarg($message->getHeaderValue('subject')); 
$safeMessageText = escapeshellarg($message->getTextContent());

exec('~/.joplin-bin/bin/joplin use Inbox ; \
~/.joplin-bin/bin/joplin mktodo '.$safeMessageSubject.' ; \
~/.joplin-bin/bin/joplin set '.$safeMessageSubject.' body '.$safeMessageText.'; \
~/.joplin-bin/bin/joplin sync');
