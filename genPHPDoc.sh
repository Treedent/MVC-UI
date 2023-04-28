#!/bin/bash
# Copyright SYRADEV - Regis TEDONE - 2023
# Génère la documentation PHPDoc

php ./phpDocumentor.phar -d . -t public/docs/api
