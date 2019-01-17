
@setlocal

set YII_PATH=%~dp0

if "%PHP_COMMAND%" == "" set PHP_COMMAND=/opt/local/bin/php

"%PHP_COMMAND%" "%YII_PATH%composer.phar" %*

@endlocal
