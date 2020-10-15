<?php
require_once __DIR__ . '/vendor/autoload.php';

$message = \ZBateson\MailMimeParser\Message::from(stream_get_contents(STDIN));

$safeMessageSubject = escapeshellarg($message->getHeaderValue('subject'));
$safeMessageText = escapeshellarg($message->getTextContent());

exec('~/.joplin-bin/bin/joplin use Inbox ; \
~/.joplin-bin/bin/joplin mktodo '.$safeMessageSubject.' ; \
~/.joplin-bin/bin/joplin set '.$safeMessageSubject.' body '.$safeMessageText.'; \
~/.joplin-bin/bin/joplin sync');