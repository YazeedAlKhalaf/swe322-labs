#!/bin/bash

# sleep 10 seconds, see why the thing below is getting connection failed
sleep 10

# Run database migrations
php vendor/bin/phinx migrate -c phinx.php

# Start Apache
apache2-foreground
