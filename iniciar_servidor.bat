@echo off
echo ================================
echo   Sistema de Geração de Currículo
echo ================================
echo.

echo Verificando PHP...
where php >nul 2>&1
if %errorlevel% neq 0 (
    echo [ERRO] PHP não encontrado no PATH.
    echo.
    echo Opções para instalar PHP:
    echo 1. XAMPP: https://www.apachefriends.org/download.html
    echo 2. PHP Standalone: https://windows.php.net/download/
    echo 3. WAMP: https://www.wampserver.com/
    echo.
    echo Após instalar, reinicie o terminal e tente novamente.
    pause
    exit /b 1
)

echo PHP encontrado!
echo.

echo Navegando para pasta public...
cd /d "%~dp0public"

echo Iniciando servidor PHP em localhost:8000...
echo.
echo =====================================
echo  Acesse: http://localhost:8000
echo =====================================
echo.
echo Pressione Ctrl+C para parar o servidor
echo.

php -S localhost:8000
pause