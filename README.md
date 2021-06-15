# php-apple-apn-push
Quickly send an Apple Push Notification using PHP

Simple PHP example to send a notification with Apple Push Notification Service. Using apple/apn-push.

Updated for 2021 update for Apple push notifications using HTTP/2

Now requires Bundle ID in addition to key and device tocken. 


$cert_pem_filepath = 'cert.pem';
// Bundle Id
$bundle_id = 'com.example.com';
// Device Token
$device_token = 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx';


Installation instruction

Step 1: git clone the repo

Step 2: composer update

Step 3: Customise main.php to match your credentails and run. 
