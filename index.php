<?php
/**
 * Реализовать проверку заполнения обязательных полей формы в предыдущей
 * с использованием Cookies, а также заполнение формы по умолчанию ранее
 * введенными значениями.
 */

// Отправляем браузеру правильную кодировку,
// файл index.php должен быть в кодировке UTF-8 без BOM.
header('Content-Type: text/html; charset=UTF-8');

// В суперглобальном массиве $_SERVER PHP сохраняет некторые заголовки запроса HTTP
// и другие сведения о клиненте и сервере, например метод текущего запроса $_SERVER['REQUEST_METHOD'].
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  // Массив для временного хранения сообщений пользователю.
  $messages = array();
  // В суперглобальном массиве $_COOKIE PHP хранит все имена и значения куки текущего запроса.
  // Выдаем сообщение об успешном сохранении.
  if (!empty($_COOKIE['save'])) {
    // Удаляем куку, указывая время устаревания в прошлом.
    setcookie('save', '', 100000);
    // Если есть параметр save, то выводим сообщение пользователю.
    $messages[0] = 'Спасибо, результаты сохранены.';
  }

  // Складываем признак ошибок в массив.
  $errors = array();
  $errors['fio'] = !empty($_COOKIE['fio_error']);
  $errors['email'] = !empty($_COOKIE['email_error']);
  $errors['biography'] = !empty($_COOKIE['biography_error']);
  $errors['yob'] = !empty($_COOKIE['yob_error']);


  // Выдаем сообщения об ошибках.
  if ($errors['fio']) {
    // Удаляем куку, указывая время устаревания в прошлом.
    setcookie('fio_error', '', 100000);
    // Выводим сообщение.
    $messages[1] = '<div class="error">Имя не соответствует формату [A-Za-z]</div>';
  }
  if ($errors['email']) {
    // Удаляем куку, указывая время устаревания в прошлом.
    setcookie('email_error', '', 100000);
    // Выводим сообщение.
    $messages[2] = '<div class="error">Почта не соответствует формату *@mail.ru</div>';
  }
  if ($errors['biography']) {
    // Удаляем куку, указывая время устаревания в прошлом.
    setcookie('biography_error', '', 100000);
    // Выводим сообщение.
    $messages[3] = '<div class="error">Биография не соответствует формату A-Za-z.-,!</div>';
  }
  if ($errors['yob']) {
    // Удаляем куку, указывая время устаревания в прошлом.
    setcookie('yob_error', '', 100000);
    // Выводим сообщение.
    $messages[4] = '<div class="error">Введите дату рождения</div>';
  }

  // Складываем предыдущие значения полей в массив, если есть.
  $values = array();
  $values['fio'] = empty($_COOKIE['fio_value']) ? '' : $_COOKIE['fio_value'];
  $values['email'] = empty($_COOKIE['email_value']) ? '' : $_COOKIE['email_value'];
  $values['biography'] = empty($_COOKIE['biography_value']) ? '' : $_COOKIE['biography_value'];
  $values['yob'] = empty($_COOKIE['yob_value']) ? '' : $_COOKIE['yob_value'];


  // Включаем содержимое файла form.php.
  // В нем будут доступны переменные $messages, $errors и $values для вывода 
  // сообщений, полей с ранее заполненными данными и признаками ошибок.
  include('form1.php');
}
// Иначе, если запрос был методом POST, т.е. нужно проверить данные и сохранить их в XML-файл.
else {
  // Проверяем ошибки.
  $errors = FALSE;
  if (empty($_POST['fio']) || preg_match('/^[a-zA-Z]+$/', $_POST['fio']) == 0) {
    // Выдаем куку на день с флажком об ошибке в поле fio.
    $errors = TRUE;
    setcookie('fio_error', '1', time() + 24 * 60 * 60);
  }
  else {
    // Сохраняем ранее введенное в форму значение на год.
    setcookie('fio_value', $_POST['fio'], time() + 30 * 24 * 60 * 60 * 365);
  }
  if (empty($_POST['email']) || preg_match("/@mail.ru/", $_POST['email']) == 0) { 
    // Выдаем куку на день с флажком об ошибке в поле email.
    setcookie('email_error', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  }
  else {
    // Сохраняем ранее введенное в форму значение на год.
    setcookie('email_value', $_POST['email'], time() + 30 * 24 * 60 * 60 * 365);
  }
  if (empty($_POST['biography']) || preg_match('/^[a-zA-Z.,!-]+$/' , $_POST['biography']) == 0) {  
    // Выдаем куку на день с флажком об ошибке в поле biography.
    setcookie('biography_error', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  }
  else {
    // Сохраняем ранее введенное в форму значение на год.
    setcookie('biography_value', $_POST['biography'], time() + 30 * 24 * 60 * 60 * 365);
  }
  if (empty($_POST['yob']) || preg_match('/^[0-9]+$/' , $_POST['yob']) == 0) {  
    // Выдаем куку на день с флажком об ошибке в поле biography.
    setcookie('yob_error', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  }
  else {
    // Сохраняем ранее введенное в форму значение на год.
    setcookie('yob_value', $_POST['yob'], time() + 30 * 24 * 60 * 60 * 365);
  }



  if ($errors) {
    // При наличии ошибок перезагружаем страницу и завершаем работу скрипта.
    header('Location: index.php');
    exit();
  }
  else {
    // Удаляем Cookies с признаками ошибок.
    setcookie('fio_error', '', 100000);
    setcookie('email_error', '', 100000);
    setcookie('biography_error', '', 100000);
    setcookie('yob_error', '', 100000);

    // Сохранение в базу данных.
    $user = 'u24095';
    $pass = '8452445';
    $db = new PDO('mysql:host=localhost;dbname=u24095', $user, $pass, array(PDO::ATTR_PERSISTENT => true));

// Подготовленный запрос. Не именованные метки.

    try {
      $str = implode(',',$_POST['sp-sp']);
      
      $stmt = $db->prepare("INSERT INTO appl SET fio = ?, email = ?, yob = ?, pol = ?, limb = ?, biograghy = ?");
      $stmt -> execute([$_POST['fio'],$_POST['email'],$_POST['yob'],$_POST['radio-pol'],$_POST['radio-kon'],$_POST['biography']]);

      $stmt = $db->prepare("INSERT INTO abilities SET abilities = ?");
      $stmt -> execute([$str]);
      
    }
    catch(PDOException $e){
      print('Error : ' . $e->getMessage());
      exit();
    }
    // TODO: тут необходимо удалить остальные Cookies.
  }

  // Сохранение в XML-документ.
  // ...

  // Сохраняем куку с признаком успешного сохранения.
  setcookie('save', '1');

  // Делаем перенаправление.
  header('Location: index.php');
}

// Сохранение в базу данных.


