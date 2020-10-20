<?php
require_once __DIR__ . '/vendor/autoload.php';

$message = \ZBateson\MailMimeParser\Message::from(stream_get_contents(STDIN));

$safeMessageSubject = escapeshellarg($message->getHeaderValue('subject'));
$safeMessageText = escapeshellarg($message->getTextContent());

// multiple calls to joplin for now, because command chaining inside joplin is not yet availabe, see
// https://discourse.joplinapp.org/t/how-to-chain-commands-in-terminal-app-for-joplin-instant-mail/11801
exec('~/.joplin-bin/bin/joplin use Inbox ; \
~/.joplin-bin/bin/joplin mktodo '.$safeMessageSubject.' ; \
~/.joplin-bin/bin/joplin set '.$safeMessageSubject.' body '.$safeMessageText.'; \
~/.joplin-bin/bin/joplin sync');