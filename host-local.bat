@echo off
setlocal enabledelayedexpansion

:: Set terminal colors for the welcome message (light green text, black background)
color 0A
echo ============================================================
echo Welcome to the BMS Tailor Local Development Server
echo ============================================================
echo Developed by: Dale Decain (Deiru)
echo ============================================================
echo.

:: Set terminal colors for the "searching" animation (light yellow text, black background)
color 0E
echo Searching for the project directory...
for /l %%i in (1,1,3) do (
    set "dots="
    for /l %%j in (1,1,%%i) do set "dots=!dots!."
    echo Locating directory!dots!
    timeout /t 1 >nul
)
echo Project directory found!
echo.

:: Set terminal colors for the directory display (light cyan text, black background)
color 0B
cd /d "%~dp0"
echo Current directory: %~dp0
echo ============================================================
echo.

:: Set terminal colors for the loading animation (light purple text, black background)
color 0B
echo Preparing to start the Laravel development server...
for /l %%i in (1,1,5) do (
    echo Starting Laravel server... %%i/5
    timeout /t 1 >nul
)
echo Laravel server started successfully!
echo ============================================================
echo.

:: Set terminal colors for the warning message (light red text, black background)
color 0C
echo IMPORTANT:
echo ============================================================
echo Do NOT close this Command Prompt while the server is running.
echo To stop the server, close this window when you are done.
echo ------------------------------------------------------------
echo Open your browser and go to: http://127.0.0.1:8000
echo Or press CTRL + Click on the link above to open it directly.
echo ============================================================
echo.
timeout /t 3 >nul

:: Set terminal colors for the server output (light green text, black background)
color 0F
php artisan serve

:: Set terminal colors for the exit message (light white text, black background)
color 0F
echo ============================================================
echo Server stopped. Thank you for using the BMS Tailor Server.
echo Developed by: Dale Decain (Deiru)
echo ============================================================
pause