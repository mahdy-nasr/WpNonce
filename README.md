# WpNonce
Wordpress nonce in object oriented manner 

## Usage
This package used instead of wp_nonce_*() functionalities in wordpress.
It built in object orianted way and also make the code more readably.

## Environoment 
It used on any wordpress instilation. and it tested on wordpress v4.9.

## Instilation
Eather via direct composer command :
```BASH
composer require mahdy/wpnonce
```
Or via editing composer.json file and then use composer update
```JSON
{
	"require": {
		"mahdy/wpnonce" : "1.0.0"
	}
}
```

## How to use
The package used for generating and verifying the wordpress Nonce.

### Set the Action
1- Via constructor 
```PHP
$nonce =  new \WpNonce\Nonce("Xaction");
```
2- Via setter functionalities
```PHP
$nonce =  new \WpNonce\Nonce();
$nonce->setAction("Xaction");
```
### Set the name (Optional)
It used for URL and form field.
The default value is "_wpnonce"
```PHP
$nonce->setName("theNewName");
```
### Generate the Nonce string
1- Exciplicitly 
```PHP
/*if you didn't set the action in constructor, you have to use setter before to use this function*/
$nonce_string = $nonce->generateNonce();
```
2- As string
```PHP
/*use the object directly */
$str = "the following object will return as Nonce string ".$nonce;
```

### Generate the Nonce URL
```PHP
$url = "https://somewebsite.com/";
$nonce_url = $nonce->generateNonceUrl($url);
```
###Generate Nonce Field in form

It take 2 optional parametars: generateNonceField($referer = true, $echo = true)
```PHP
$nonce_HTML_input = $generateNonceField()
```
### Verifying Nonce string

it return 1 if the nonce generated in last 12h and 2 if it generated in last 24h
```PHP
if (\WpNonce\NonceVerifier::verify($nonce, $action)) {...}
```
### Verify Nonce from submitted 

Verifying using checkAdminReferer($action, $input_name = "_wpnonce") function.
```PHP
/* */
if (\WpNonce\NonceVerifier::checkAdminReferer($action)) {...}
```
### Verify Ajax requist 
the function checkAjaxReferer($action, $arg_name = false, $die = true) has 2 optional parametars.

```PHP
if (\WpNonce\NonceVerifier::checkAjaxReferer($action)) {...}
```


## Running the UnitTest

1- you have first to install PHPUnit
2- open the package folder : vendor/mahdy/wpnonce change to this directory to run the phpunit
3- before run change the vendor/mahdy/wpnonce/bootstrap.php and change the WORDPRESS_PATH to your wordpress instilation directory.
4- in command line from package directory run 
```BASH
$ phpunit
```


