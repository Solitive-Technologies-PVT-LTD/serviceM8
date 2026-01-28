# PowerShell Script to Import servicem8.sql Database
# Run this script from the serviceM8 directory

Write-Host "========================================" -ForegroundColor Cyan
Write-Host "  ServiceM8 Database Import Script" -ForegroundColor Cyan
Write-Host "========================================" -ForegroundColor Cyan
Write-Host ""

# Check if SQL file exists
$sqlFile = "servicem8.sql"
if (-not (Test-Path $sqlFile)) {
    Write-Host "ERROR: $sqlFile not found in current directory!" -ForegroundColor Red
    Write-Host "Please make sure servicem8.sql is in the serviceM8 folder." -ForegroundColor Yellow
    exit 1
}

Write-Host "✓ SQL file found: $sqlFile" -ForegroundColor Green
Write-Host ""

# Get MySQL credentials
Write-Host "Please enter your MySQL credentials:" -ForegroundColor Yellow
$mysqlUser = Read-Host "MySQL Username (default: root)"
if ([string]::IsNullOrWhiteSpace($mysqlUser)) {
    $mysqlUser = "root"
}

$mysqlPassword = Read-Host "MySQL Password" -AsSecureString
$mysqlPasswordPlain = [Runtime.InteropServices.Marshal]::PtrToStringAuto(
    [Runtime.InteropServices.Marshal]::SecureStringToBSTR($mysqlPassword)
)

Write-Host ""
Write-Host "Creating database 'servicem8'..." -ForegroundColor Yellow

# Create database
$createDbQuery = "CREATE DATABASE IF NOT EXISTS servicem8 CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
$createDbCmd = "mysql -u $mysqlUser -p$mysqlPasswordPlain -e `"$createDbQuery`""

try {
    $result = Invoke-Expression $createDbCmd 2>&1
    if ($LASTEXITCODE -eq 0) {
        Write-Host "✓ Database 'servicem8' created successfully" -ForegroundColor Green
    } else {
        Write-Host "Database might already exist, continuing..." -ForegroundColor Yellow
    }
} catch {
    Write-Host "Note: Database creation command executed" -ForegroundColor Yellow
}

Write-Host ""
Write-Host "Importing SQL file..." -ForegroundColor Yellow

# Import SQL file
$importCmd = "mysql -u $mysqlUser -p$mysqlPasswordPlain servicem8 < $sqlFile"

try {
    $result = Invoke-Expression $importCmd 2>&1
    if ($LASTEXITCODE -eq 0) {
        Write-Host "✓ Database imported successfully!" -ForegroundColor Green
    } else {
        Write-Host "ERROR: Import failed. Error details:" -ForegroundColor Red
        Write-Host $result -ForegroundColor Red
        exit 1
    }
} catch {
    Write-Host "ERROR: Failed to import database" -ForegroundColor Red
    Write-Host $_.Exception.Message -ForegroundColor Red
    exit 1
}

Write-Host ""
Write-Host "========================================" -ForegroundColor Cyan
Write-Host "  Database Import Complete!" -ForegroundColor Green
Write-Host "========================================" -ForegroundColor Cyan
Write-Host ""
Write-Host "Next steps:" -ForegroundColor Yellow
Write-Host "1. Copy .env.example to .env (if not done)" -ForegroundColor White
Write-Host "2. Update .env with your database credentials:" -ForegroundColor White
Write-Host "   DB_DATABASE=servicem8" -ForegroundColor Gray
Write-Host "   DB_USERNAME=$mysqlUser" -ForegroundColor Gray
Write-Host "   DB_PASSWORD=your_password" -ForegroundColor Gray
Write-Host "3. Run: php artisan key:generate" -ForegroundColor White
Write-Host "4. Test connection: php artisan migrate:status" -ForegroundColor White
Write-Host ""

