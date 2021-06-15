<?php
// https://github.com/ZhukV/AppleApnPush/blob/master/docs/index.md

require_once "vendor/autoload.php";

use Apple\ApnPush\Certificate\Certificate;
use Apple\ApnPush\Protocol\Http\Authenticator\CertificateAuthenticator;
use Apple\ApnPush\Sender\Builder\Http20Builder;

use Apple\ApnPush\Model\Alert;
use Apple\ApnPush\Model\Aps;
use Apple\ApnPush\Model\Payload;

use Apple\ApnPush\Model\Notification;
use Apple\ApnPush\Model\DeviceToken;
use Apple\ApnPush\Model\Receiver;

use Apple\ApnPush\Exception\SendNotification\SendNotificationException;

// Pem format file path converted from p12

$cert_pem_filepath = 'cert.pem';
// Bundle Id
$bundle_id = 'com.example.com';
// Device Token
$device_token = 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx';

// Create certificate and authenticator
$certificate = new Certificate($cert_pem_filepath, '');
$authenticator = new CertificateAuthenticator($certificate);

// Generate a sender that uses the HTTP / 2 protocol updated for 2021 Apple push update
$builder = new Http20Builder($authenticator);
$sender = $builder->build();

// Specify the device token and generate a Receiver
$receiver = new Receiver(new DeviceToken($device_token), $bundle_id);

// Generate notification
$notification = Notification::createWithBody('Hello ;)');
$alert = (new Alert())
    ->withBody('Hello ;)')
    ->withTitle('Hi ;)');
$aps = (new Aps($alert))
    ->withBadge(2)
    ->withSound('pong.acc')
    ->withThreadId('my.app.thread')
    ->withContentAvailable(true);
$payload = (new Payload($aps));
$notification = (new Notification($payload));

try {
  // 3rd parameter is sandbod true / false. Change it to false for sending production push.
  $sender->send($receiver, $notification, true);
} catch (SendNotificationException $e) {
  var_dump($e);
}
