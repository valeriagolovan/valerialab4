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

       
        <form action="" method="POST">
        <?php if ($errors['fio']) {print $messages[1];} ?>
          ФИО:
          <label>
            <input name="fio" placeholder="Введите ФИО" 
            <?php if ($errors['fio']) {print 'class="error"';} ?> value="<?php print $values['fio']; ?>">
          </label>
          <br>
          <br>
          <?php if ($errors['email']) {print $messages[2];} ?>
          E-mail:
          <label>
            <input type="email" name="email" placeholder="Введите e-mail" 
            <?php if ($errors['email']) {print 'class="error"';} ?> value="<?php print $values['email']; ?>">
          </label>
          <?php if ($errors['yob']) {print $messages[4];} ?>
          <p>Ваш год рождения:</p>
          <label>
          <input name="yob" placeholder="Введите год рождения" 
            <?php if ($errors['yob']) {print 'class="error"';} ?> value="<?php print $values['yob']; ?>">
          </label>
          <?php if ($errors['radio-pol']) {print $messages[5];} ?>
          <p>Пол:</p>
          <label>
            <input type="radio" name="radio-pol" value="M" <?php if($values['radio-pol']=='M') print "checked";?>>М
          </label>
          <label>
            <input type="radio" name="radio-pol" value="W" <?php if($values['radio-pol']=='W') print "checked";?>/>Ж
          </label>
          <?php if ($errors['radio-kon']) {print $messages[6];} ?>
          <p>Количество конечностей</p><br />
          <label>
            <input type="radio" name="radio-kon" value="0" <?php if($values['radio-kon']=='0') print "checked";?>/>0
          </label>
          <label>
            <input type="radio" name="radio-kon" value="1" <?php if($values['radio-kon']=='1') print "checked";?>/>1
          </label>
          <label>
            <input type="radio" name="radio-kon" value="2" <?php if($values['radio-kon']=='2') print "checked";?>/>2
          </label>
          <label>
            <input type="radio" name="radio-kon" value="3" <?php if($values['radio-kon']=='3') print "checked";?>/>3
          </label>
          <label>
            <input type="radio" name="radio-kon" value="4" <?php if($values['radio-kon']=='4') print "checked";?> />4
          </label>
          <label>
            <input type="radio" name="radio-kon" value="5" <?php if($values['radio-kon']=='5') print "checked";?> />5
          </label>
          <?php if ($errors['ability']) {print $messages[7];} ?>
          <p>Сверхспособности, если есть</p>
          <label>
            <select name="sp-sp[]" multiple=multiple <?php if ($errors['ability']) {print 'class="error"';} ?>>
              <option value="0" <?php if(in_array("0", $ability)) print "selected";?>>Бессмертие</option>
              <option value="1" <?php if(in_array("1", $ability)) print "selected";?>> Прохождение сквозь стены</option>
              <option value="2" <?php if(in_array("2", $ability)) print "selected";?>>Левитация</option>
            </select>
          </label>
          <?php if ($errors['biography']) {print $messages[3];} ?>
          <p id="bio">Биография</p>
          <label>
            <textarea placeholder="Напишите о себе" name="biography" rows="6" cols="60" 
            <?php if ($errors['biography']) {print 'class="error"';} ?>><?php print $values['biography'];?></textarea>
          </label>
          <br>
          <?php if ($errors['contract']) {print $messages[8];} ?>
          <label>
            С контрактом ознакомлен
            <input type="checkbox" name="contract" <?php if ($errors['contract']) {print 'class="error"';} ?>>
          </label>
          <br>
          <input type="submit" value="Отправить">
        </form>
      </div>
    </div>
  </div>
</body>

</html>
