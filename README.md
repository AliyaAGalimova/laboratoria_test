
## Реализованы следующие методы REST API для работы с пользователями:
1. Создание пользователя (register). Метод POST `{{protocol}}{{host}}:{{port}}/api/register?name=&email=&password=`
   Поле email уникальное. Пароль должен содержать более 6 символов, имя должно состоять из более чем двух букв.
2. Авторизация пользователя (login). Метод POST `{{protocol}}{{host}}:{{port}}/api/login?email=&password=`
  
3. Получение информации о пользователе (show). Метод GET `{{protocol}}{{host}}:{{port}}/api/user/{{id}}`
  
4. Обновление информации пользователя (update). Метод PUT `{{protocol}}{{host}}:{{port}}/api/user/{{id}}?{{query params}}`
  В качестве аргументов `query params` можно передать поля name, email и password 
   
5. Удаление пользователя (destroy). Метод DELETE `{{protocol}}{{host}}:{{port}}/api/user/{{id}}`

----

