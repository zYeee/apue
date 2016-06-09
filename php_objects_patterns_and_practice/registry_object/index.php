<?php
require "autoload.php";
use woo\base\ApplicationRegistry;

ApplicationRegistry::setDsn('abbb');
ApplicationRegistry::getDsn();
