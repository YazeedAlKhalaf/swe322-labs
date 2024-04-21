#!/bin/bash

# sleep 10 seconds, see why the thing below is getting connection failed
sleep 10

# Create the database if it doesn't exist
mysql -h ${DB_HOST} -u root -p"${DB_PASS}" -e "CREATE DATABASE IF NOT EXISTS ${DB_NAME};"

# Run database migrations
php vendor/bin/phinx migrate -c phinx.php

# Start Apache
apache2-foreground
