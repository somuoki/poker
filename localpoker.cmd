

:: compile the application and create an executable file
php poker app:build poker -v --build-version=1


:: Change directory to location of executable file
cd builds

:: add file to environment variable
set PATH=%PATH%;%cd%/poker

:: associate the Phar file with php to run without prompting user
ftype PHARFile="C:\xampp\php\php.exe" "%1" %*
assoc .phar=PHARFile
set PATHEXT=%PATHEXT%;.PHAR

:: Test and Run the game in new window to use the set environment variable
start cmd.exe /k @php "%~dp0poker test"  && @php "%~dp0poker" %*

