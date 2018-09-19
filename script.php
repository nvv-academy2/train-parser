<?php

while (true) {
    echo exec("php artisan trains:get").PHP_EOL;
    sleep(1);
}