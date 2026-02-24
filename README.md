# Мониторинг процессов отчетов

## 1. Клонирование проекта
```bash
git clone https://github.com/thestarraccoon/Promodata.git
cd Promodata
```

## 2. Зависимости
```bash
composer install
```

## 3. .env и key
```bash
cp .env.example .env
php artisan key:generate
```

## 4. .env настройка
```bash
APP_URL=http://localhost:8000
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=your_db
DB_USERNAME=your_user
DB_PASSWORD=your_password
```

## 5. Миграции и сидеры
```bash
php artisan migrate:fresh --seed
```

## 6. Настройка Storage
```bash
php artisan storage:link
chmod -R 775 storage bootstrap/cache
```

## 7. Запуск сервера
```bash
php artisan serve
```

## 8. Запуск команды

### Генерация отчёта (замени 1 на ID категории)
```bash
php artisan reports:prices 1
```

## 9. View-таблицы процессов
```bash
http://127.0.0.1:8000/processes
```
## 10. Местоположение отчетов
```bash
storage/app/public/reports/
```

