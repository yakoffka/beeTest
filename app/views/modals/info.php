<!-- Button trigger modal -->
<a class="cursor_pointer" data-toggle="modal" data-target="#info">
    info
</a>

<!-- Modal -->
<div class="modal fade" id="info" tabindex="-1" role="dialog" aria-labelledby="info beeTest"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="exampleModalLongTitle">
                    Пример простого приложения-задачника
                </h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5>Требования к приложению</h5>
                <p>На стартовой странице располагается список задач с возможностью сортировки по имени пользователя,
                    email и статусу.
                    <br>Видеть список задач и создавать новые может любой посетитель без авторизации.
                    <br>Вывод задач - страницами по 3 штуки (с пагинацией).
                </p>
                <p>Администратор (логин "admin", пароль "123") имеет возможность редактировать текст задачи и поставить галочку о выполнении.
                    <br>Выполненные задачи в общем списке выводятся с соответствующей отметкой.
                </p>
                <p>В приложении необходимо реализовать модель MVC с помощью чистого PHP.
                    <br>Фреймворки PHP использовать нельзя, библиотеки - можно. Этому приложению не нужна сложная архитектура, решите поставленные
                    задачи минимально необходимым количеством кода.
                    <br>Верстка на bootstrap, к дизайну особых требований нет.
                </p>

                <h5>Протокол тестирования</h5>
                <ol>
                    <li>Перейти на стартовую страницу приложения.
                        <br>Должен отобразиться список задач.
                        <br>В списке присутствуют поля: имя пользователя, email, текст задачи, статус.
                        <br>Не должно быть опечаток. Зазоры должны быть ровные. Ничего не ползет.
                        <br>Должна быть возможность создания новой задачи.
                        Должна быть кнопка для авторизации.
                    </li>
                    <li>Не заполнять поля для новой задачи. Сохранить задачу.
                        <br>Должны вывестись ошибки валидации.
                        <br>Ввести в поле email “test”.
                        <br>Должна вывестись ошибка, что email не валиден.
                    </li>
                    <li>Создать задачку с корректными данными (имя “test”, email “test@test.com”, текст “test job”).
                        <br>Задача должна отобразиться в списке задач.
                        <br>Данные должны быть ровно те, что были введены в поле формы.
                        <br>После создания задачи должно вывестись оповещение об успехе добавления.
                    </li>
                    <li>Для проверки XSS уязвимости нужно создать задачу с тегами в описании задачи (добавить в поле
                        описания задачи текст '<?= htmlentities("<script>alert(‘test’);</script>") ?>', заполнить
                        остальные поля).
                        <br>Задача должна отобразиться в списке задач, при этом не должен всплыть alert c текстом ‘test’.
                    </li>
                    <li>Создать еще 2 задачи.
                        <br>Должна появиться новая страница в пагинации.
                    </li>
                    <li>Отсортировать список по полю “имя пользователя” по возрастанию.
                        <br>Список должен пересортироваться.
                        <br>Перейти на последнюю страницу в пагинации.
                        <br>Сортировка не должна сбиться, задачи с последней
                        страницы должны быть отображены.
                        <br>Далее отсортировать по тому же полю, но по убыванию.
                        <br>Перейти на первую страницу. Имя пользователя, которое было последним в списке, должно стать первым.
                        <br>Проделать этот тест для полей “email” и “статус”.
                    </li>
                    <li>Перейти на страницу авторизации пользователя. Попробовать залогиниться с пустыми полями.
                        <br>Должна вывестись ошибка, что поля обязательны для заполнения или, что введенные данные не верные.
                        <br>Ввести в поле для имени пользователя “admin1”, в поле для пароля “321”.
                        <br>Должна вывестись ошибка о неправильных реквизитах доступа. Админский доступ не должен быть предоставлен.
                        <br>Ввести данные “admin” в поле для имени и “123” в поле для пароля.
                        <br>Авторизация должна пройти успешно. Должна отобразиться кнопка для выхода из профиля админа.
                    </li>
                    <li>Для созданной задачи проставить отметку “выполнено”. Перезагрузить страницу.
                        Отредактировать текст задачи. Сохранить и перезагрузить страницу.
                        <br>Текст задачи должен быть тот, который ввели при редактировании. В общем списке задача должна отображаться уже с двумя
                        отметками: "выполнено" и “отредактировано администратором”.
                        <br>Отметка “отредактировано администратором” должна появляться только в случае изменения текста в теле задачи.
                        <br>В общем списке задача должна отображаться со статусом задачи “выполнено”.
                    </li>
                    <li>Открыть параллельно приложение в новой вкладке. Разлогиниться в новой вкладке.
                        <br>В новой вкладке не должно быть возможности редактировать задачу.
                        <br>Вернуться в предыдущую вкладку. Отредактировать задачу и сохранить.
                        <br>Отредактированная задача не должна быть сохранена. Приложение должно запросить авторизацию.
                    </li>
                </ol>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn cancel_b" data-dismiss="modal">close</button>
            </div>
        </div>
    </div>
</div>
