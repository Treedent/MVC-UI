#!/bin/bash
# Copyright SYRADEV - Regis TEDONE - 2023
# Génère la documentation PHPDoc

declare rootPath="/home/regis/Public/localsites/github/MVC-UI/"
php ./phpDocumentor.phar run -d "$rootPath" -t ../public/documentation/api
