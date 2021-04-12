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
  $errors['radio-pol'] = !empty($_COOKIE['radio-pol_error']);
  $errors['radio-kon'] = !empty($_COOKIE['radio-kon_error']);
  $errors['ability'] = !empty($_COOKIE['ability_error']);
  $errors['contract'] = !empty($_COOKIE['contract_error']);



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
  if ($errors['radio-pol']) {
    // Удаляем куку, указывая время устаревания в прошлом.
    setcookie('radio-pol_error', '', 100000);
    // Выводим сообщение.
    $messages[5] = '<div class="error">Выберите пол/div>';
  }
  if ($errors['radio-kon']) {
    // Удаляем куку, указывая время устаревания в прошлом.
    setcookie('radio-kon_error', '', 100000);
    // Выводим сообщение.
    $messages[6] = '<div class="error">Выберите количество конечностей</div>';
  }
  if ($errors['ability']) {
    // Удаляем куку, указывая время устаревания в прошлом.
    setcookie('ability_error', '', 100000);
    // Выводим сообщение.
    $messages[7] = '<div class="error">Выберите супер способности</div>';
  }
  if ($errors['contract']) {
    // Удаляем куку, указывая время устаревания в прошлом.
    setcookie('contract_error', '', 100000);
    // Выводим сообщение.
    $messages[8] = '<div class="error">Необходимо согласие</div>';
  }

  // Складываем предыдущие значения полей в массив, если есть.
  $values = array();
  $values['fio'] = empty($_COOKIE['fio_value']) ? '' : $_COOKIE['fio_value'];
  $values['email'] = empty($_COOKIE['email_value']) ? '' : $_COOKIE['email_value'];
  $values['biography'] = empty($_COOKIE['biography_value']) ? '' : $_COOKIE['biography_value'];
  $values['yob'] = empty($_COOKIE['yob_value']) ? '' : $_COOKIE['yob_value'];
  $values['radio-pol'] = empty($_COOKIE['radio-pol_value']) ? '' : $_COOKIE['radio-pol_value'];
  $values['radio-kon'] = empty($_COOKIE['radio-kon_value']) ? '' : $_COOKIE['radio-kon_value'];
  $values['contract'] = empty($_COOKIE['contract_value']) ? '' : $_COOKIE['contract_value'];
  // создаем массив способностей
  $ability = array();
  $ability = empty($_COOKIE['ability_values']) ? array() : unserialize($_COOKIE['ability_values'], ["allowed_classes" => false]);
  // unserialize принимает одну сериализованную переменную и конвертирует её обратно в значение PHP.
  // allowed_classes - Массив имён классов, которые должны быть приняты, false для указания не принимать никаких классов


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

  if (!isset($_POST['radio-pol'])) {  
    // Выдаем куку на день с флажком об ошибке в поле biography.
    setcookie('radio-pol_error', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  }
  else {
    // Сохраняем ранее введенное в форму значение на год.
    setcookie('radio-pol_value', $_POST['radio-pol'], time() + 30 * 24 * 60 * 60 * 365);
  }

  if (empty($_POST['yob']) || preg_match('/^[0-9]+$/' , $_POST['yob']) == 0 || ($_POST['yob']>2021 || $_POST['yob']<1900)) {  
    // Выдаем куку на день с флажком об ошибке в поле biography.
    setcookie('yob_error', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  }
  else {
    // Сохраняем ранее введенное в форму значение на год.
    setcookie('yob_value', $_POST['yob'], time() + 30 * 24 * 60 * 60 * 365);
  }

  if (!isset($_POST['radio-kon'])) {  
    // Выдаем куку на день с флажком об ошибке в поле biography.
    setcookie('radio-kon_error', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  }
  else {
    // Сохраняем ранее введенное в форму значение на год.
    setcookie('radio-kon_value', $_POST['radio-kon'], time() + 30 * 24 * 60 * 60 * 365);
  }
  
  if (!isset($_POST['sp-sp'])) {  
    // Выдаем куку на день с флажком об ошибке в поле biography.
    setcookie('ability_error', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
  }
  else {
    // Сохраняем ранее введенное в форму значение на год.
    setcookie('ability_values', serialize($_POST['sp-sp']), time() + 30 * 24 * 60 * 60 * 365);
  }

  if (!isset($_POST['contract'])) {  
    // Выдаем куку на день с флажком об ошибке в поле biography.
    setcookie('contract_error', '1', time() + 24 * 60 * 60);
    $errors = TRUE;
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
    setcookie('radio-pol_error', '', 100000);
    setcookie('radio-kon_error', '', 100000);
    setcookie('ability_error', '', 100000);
    setcookie('contract_error', '', 100000);


    
  }

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

//  stmt - это "дескриптор состояния".
 
//  Именованные метки.
//$stmt = $db->prepare("INSERT INTO test (label,color) VALUES (:label,:color)");
//$stmt -> execute(array('label'=>'perfect', 'color'=>'green'));
 
//Еще вариант
/*$stmt = $db->prepare("INSERT INTO users (firstname, lastname, email) VALUES (:firstname, :lastname, :email)");
$stmt->bindParam(':firstname', $firstname);
$stmt->bindParam(':lastname', $lastname);
$stmt->bindParam(':email', $email);
$firstname = "John";
$lastname = "Smith";
$email = "john@test.com";
$stmt->execute();
*/

// Делаем перенаправление.
// Если запись не сохраняется, но ошибок не видно, то можно закомментировать эту строку чтобы увидеть ошибку.
// Если ошибок при этом не видно, то необходимо настроить параметр display_errors для PHP.
header('Location: ?save=1');
}