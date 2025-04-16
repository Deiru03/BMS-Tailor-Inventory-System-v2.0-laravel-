@echo off

:: Automatically detect the directory of this batch file
cd /d "%~dp0"

:: Run npm build
echo Running npm build...
npm run build
if %errorlevel% neq 0 (
    echo npm build failed. Exiting...
    pause
    exit /b %errorlevel%
)

:: Start PHP artisan server in a new Command Prompt window
echo Starting PHP artisan server in a new window...
start cmd /k "C:\xampp\php\php.exe artisan serve"

:: Notify the user
echo PHP artisan server is running in a new Command Prompt window.
pause