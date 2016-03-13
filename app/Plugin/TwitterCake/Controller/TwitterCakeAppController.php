<?php

require "vendor/autoload.php";

use Abraham\TwitterOAuth\TwitterOAuth;
// /app/Plugin/TwitterCake/Controller/TwitterCakeAppController.php:

class TwitterCakeAppController extends AppController {

   public function connect($consumerKey,$consumerSecret)
   {
     $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token, $access_token_secret);
     debug($connection);
   }
}
