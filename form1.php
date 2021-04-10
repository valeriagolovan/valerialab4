<!DOCTYPE html>

<head>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <meta charset="utf-8">
  <title>Задание 4</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <header>
    Форма
  </header>
  <div id="main-aside-wrapper">
    <div id="cont" class="container">
      <div id="form" class="col-12 order-lg-3 order-sm-2">

        <?php
          if (!empty($messages)) {
            print('<div id="messages">');
            // Выводим все сообщения.
            foreach ($messages as $message) {
              print($message);
            }
            print('</div>');
          }

          // Далее выводим форму отмечая элементы с ошибками классом error
          // и задавая начальные значения элементов ранее сохраненными.
        ?>
        <form action="" method="POST">
          ФИО:
          <label>
            <input name="fio" placeholder="Введите ФИО" 
            <?php if ($errors['fio']) {print 'class="error"';} ?> value="<?php print $values['fio']; ?>">
          </label>
          <br>
          <br>
          E-mail:
          <label>
            <input type="email" name="email" placeholder="Введите e-mail" 
            <?php if ($errors['email']) {print 'class="error"';} ?> value="<?php print $values['email']; ?>">
          </label>
          <p>Ваш год рождения:</p>
          <label>
          <input name="yob" placeholder="Введите год рождения" 
            <?php if ($errors['yob']) {print 'class="error"';} ?> value="<?php print $values['yob']; ?>">
          </label>

          <p>Пол:</p>
          <label>
            <input type="radio" name="radio-pol" checked="checked" value="M" checked = "checked">М
          </label>
          <label>
            <input type="radio" name="radio-pol" value="W"/>Ж
          </label>

          <p>Количество конечностей</p><br />
          <label>
            <input type="radio" name="radio-kon" value="0" />0
          </label>
          <label>
            <input type="radio" name="radio-kon" value="1" />1
          </label>
          <label>
            <input type="radio" name="radio-kon" value="2" />2
          </label>
          <label>
            <input type="radio" name="radio-kon" value="3" />3
          </label>
          <label>
            <input type="radio" checked="checked" name="radio-kon" value="4" />4
          </label>
          <label>
            <input type="radio" name="radio-kon" value="5" />5
          </label>

          <p>Сверхспособности, если есть</p>
          <label>
            <select name="sp-sp[]" multiple=multiple>
              <option value="Immortal">Бессмертие</option>
              <option value="Through the walls"> Прохождение сквозь стены</option>
              <option value="Levitation">Левитация</option>
            </select>
          </label>

          <p id="bio">Биография</p>
          <label>
            <textarea placeholder="Напишите о себе" name="biography" rows="6" cols="60" 
            <?php if ($errors['biography']) {print 'class="error"';} ?>><?php print $values['biography'];?></textarea>
          </label>
          <br>

          <label>
            С контрактом ознакомлен
            <input type="checkbox" name="check-ok" checked="checked">
          </label>
          <br>
          <input type="submit" value="Отправить">
        </form>
      </div>
    </div>
  </div>
</body>

</html>
