# Приложение обработки отложенных запросов

1. Инициализация
   ```bash
   make init
   ```
2. В одном терминале запустить consumer
   ```bash
   make consume
   ```

3. Отправить сообщение в брокера можно 2 путями:
   1. Через форму на http://localhost
   2. Через консоль в отдельном терминале
      ```bash
      make publish EMAIL=test@example.com
      ```
---
Админка RabbitMQ - http://localhost:15672 (guest / guest)

