                                                         Lucky Game

Завдання на Laravel 12, PHP 8.2 і MySQL 8.

Як запустити проект.

Потрібен запущений Docker Desktop.

1. Скопіювати конфіг оточення:

   cp .env.example .env

2. Підняти контейнери.

   docker compose up -d --build

3. Створити таблиці:

   docker compose exec web php artisan migrate

4. Відкрити http://localhost:8080/

Маршрути.

GET / головна з формою реєстрації (Username, Phonenumber)
POST /register створює користувача, генерує лінк і кидає на сторінку А
GET /page-a/{link} сторінка А, тільки за діючим лінком
POST /page-a/{link}/lucky Imfeelinglucky
POST /page-a/{link}/history History
POST /page-a/{link}/regenerate перегенерувати лінк
POST /page-a/{link}/deactivate деактивувати лінк

Лінк діє 7 днів. Якщо він протермінований, деактивований або просто набраний
неправильно, користувача повертає на головну з повідомленням про помилку.

Що вміє сторінка А

Imfeelinglucky генерує число від 1 до 1000.
Парне означає Win, непарне Lose.
Сума виграшу рахується від цього числа: більше 900 це 70 відсотків, більше 600
це 50, більше 300 це 30, решта 10. Якщо Lose, сума нульова.

History показує три останні спроби.

Regenerate Link видає новий лінк і одразу міняє адресу в браузері.

Deactivate Link закриває доступ за поточним лінком і повертає на форму
реєстрації. Врахуйте, що це незворотньо: щоб перегенерувати лінк, потрібен
діючий, а після деактивації його вже немає. Треба буде реєструватись заново.

Як влаштовано

Бізнес-логіка лежить в app/Actions, окремий клас на кожну операцію:

RegisterUserAction реєстрація користувача
RegenerateLinkAction новий лінк
DeactivateLinkAction деактивація
PlayLuckyGameAction власне гра і підрахунок виграшу
Concerns/GeneratesUniqueLink генерація лінка і дати протермінування

Доступ до сторінки А стереже app/Http/Middleware/EnsureValidGameLink.php.
Він шукає користувача за лінком, і якщо все гаразд, підставляє знайдену модель
у параметр маршруту. Тому контролери одразу отримують готовий User і нічого
не довантажують самі.

Валідація форми реєстрації в app/Http/Requests/RegisterUserRequest.php.
Моделі User і Game, результат гри в енамі App\Enums\GameResultStatus.
Контролери тонкі, вони тільки викликають потрібний Action і роблять редірект.
Схема бази створюється міграціями.

Зупинити

docker compose down

Якщо треба заодно стерти дані MySQL:

docker compose down -v

