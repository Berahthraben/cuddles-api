#!/bin/bash

# Install deps (npm install do PHP)
php composer.phar install

# Generate autoload classes
php composer.phar dump-autoload -o
