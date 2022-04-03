<head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf8">
        <title>Postfix logs viewer</title>
        <link rel="stylesheet" href="style.css">
		<!-- samoilov 03.04.2022 add datetimepicker -->
		<link rel="stylesheet" type="text/css" href="js/datetimepicker/jquery.datetimepicker.min.css"/>
		<link rel="icon" type="image/png" href="images/watermark.png" />
</head>

<html>

<body>
<div style="width: 100%; text-align: center; margin-top: 10px;">
<td class="navbartop" valign="middle" align="center">
	<strong>
	    <a href="https://mail.arcticdigital.ru/rc" title="Почта">Почта</a>&nbsp;|

<a href="https://mail.arcticdigital.ru/index2.php" title="Управление почтой">Администрирование почты</a>&nbsp;|
<a href="https://www.kgilc.ru" title="Сайт АО КГИЛЦ">Сайт АО КГИЛЦ</a>&nbsp;

<!--<a href="news.php" title="Новости">Новости</a>&nbsp;
-->
<!-- <a href="weather.php" title="Погода">Погода</a>&nbsp; -->


<!--	<a href="user.php" title="Уголок пользователя">Уголок пользователя</a>&nbsp;|-->
    <!--	<a href="about.php" title="О нас">О нас</a>&nbsp;-->
    <!--<a href="http://forum.arcticsu.ru" title="Форум">Форум</a>&nbsp;|-->
    <!--<a href="" title=""></a>&nbsp;|-->
	</strong>
</td>
</div>

<div style="width: 100%; text-align: center; margin-top: 10px;"><span style="font-size: 20pt; color: black;">Просмотр логов доставки почтовой системы АО "КГИЛЦ"</span></div><br>
<!-- samoilov 03.04.2022 add jquery -->
<script src="js/jquery-1.12.4.min.js"></script>
<!-- samoilov 09.04.2018 add sticky header script -->
<script src="js/jquery.stickytableheaders.min.js"></script>
<script>
 jQuery(document).ready(function($) {
     var $table = $('.pme-main');
    var $nav_buttons = $('table.pme-navigation');
  $table.stickyTableHeaders({
        cacheHeaderHeight: true,
        fixedOffset: $nav_buttons,
        //scrollableArea: $nav_buttons
    });
        /*$nav_buttons.stickyTableHeaders({
        fixedOffset: 100,
        //scrollableArea: $nav_buttons
    });*/
});
</script>
<!-- samoilov 03.04.2022 add date time convert -->
<script>
jQuery(document).ready(function($) {
$('body > form > table.pme-main > tbody > tr[class^="pme-row"]> td:nth-child(3)').each(function() {
	//console.log(formatDate($(this).html()));
	//$(this).html() = formatDate($(this).html());
	$(this).html(formatDate($(this).html()));
});

function formatDate(date) {
     var d = new Date(date),
         month = '' + (d.getMonth() + 1),
         day = '' + d.getDate(),
         year = d.getFullYear(),
		 time = d.toLocaleTimeString('ru-RU');

     if (month.length < 2) month = '0' + month;
     if (day.length < 2) day = '0' + day;

     var to_return = [day, month, year].join('.');
	 return to_return += ' ' + time;

 }
 //console.log(formatDate('2022-03-28 18:21:58'));
 });
</script>
<!-- samoilov 03.04.2022 add datetimepicker -->
<script src="js/datetimepicker/jquery.datetimepicker.full.js"></script>
<script>
 jQuery(document).ready(function($) {
	 	 var $input_to_pick = $('input[name^="PME_sys_qf1"]');// change if date column number is changed
	 $input_to_pick.datetimepicker({
lang: 'ru',

format: 'Y-m-d H:i',
formatDate:'Y-m-d',
formatTime:'H:i',
dayOfWeekStart:1,
step:5,
mask: true,
timepicker: true,
todayButton: true,
closeOnDateSelect:false,
ownerDocument: document,
allowBlank: true,
maxDate: '0',
closeOnWithoutClick :true,
defaultTime: '',
validateOnBlur: false
});
$.datetimepicker.setLocale('ru');
 });
</script>

<?php
/*
 * IMPORTANT NOTE: This generated file contains only a subset of huge amount
 * of options that can be used with phpMyEdit. To get information about all
 * features offered by phpMyEdit, check official documentation. It is available
 * online and also for download on phpMyEdit project management page:
 *
 * http://www.platon.sk/projects/main_page.php?project_id=5
 */
 // samoilov hide all outputs (errors, warnings and so on)
ini_set('display_errors','Off');
ini_set('error_reporting', E_ALL );
// MySQL host name, user name, password, database, and table
$opts['hn'] = 'localhost';
$opts['un'] = 'postfix';
$opts['pw'] = '12345';
$opts['db'] = 'postfix_logs';
$opts['tb'] = 'pfmaillog2db_view';

// Name of field which is the unique key
$opts['key'] = 'id';

// Type of key field (int/real/string/date etc.)
$opts['key_type'] = 'int';

// Sorting field(s)
//$opts['sort_field'] = array('delivery_timestamp');
$opts['sort_field'] = '-delivery_timestamp';

// Number of records to display on the screen
// Value of -1 lists all records in a table
$opts['inc'] = 50;

// Options you wish to give the users
// A - add,  C - change, P - copy, V - view, D - delete,
// F - filter, I - initial sort suppressed
$opts['options'] = 'FL';

// Number of lines to display on multiple selection filters
//$opts['multiple'] = '4';

// Navigation style: B - buttons (default), T - text links, G - graphic links
// Buttons position: U - up, D - down (default)
$opts['navigation'] = 'TD';
/* Display special page elements*/
$opts['display'] = array(
        'form'  => true,
        'query' => false,
        'sort'  => false,
        'time'  => false,
        'tabs'  => false
);
$opts['display']['num_pages'] = true;
$opts['display']['num_records'] = true;

/*$opts['buttons']['L']['up'] = array('-<<','-<','-add','-view','-change','-copy','-delete',
                                    '->','->>','-goto','-goto_combo',);*/



/* Get the user's default language and use it if possible or you can
   specify particular one you want to use. Refer to official documentation
   for list of available languages. */
//30.03.2018 samoilov check prioritied language
        $langcode = (!empty($_SERVER['HTTP_ACCEPT_LANGUAGE'])) ? $_SERVER['HTTP_ACCEPT_LANGUAGE'] : '';
        $langcode = (!empty($langcode)) ? explode(";", $langcode) : $langcode;
        $langcode = (!empty($langcode['0'])) ? explode(",", $langcode['0']) : $langcode;
        $langcode = (!empty($langcode['0'])) ? explode("-", $langcode['0']) : $langcode;
$opts['language'] = $langcode['0'];
//echo $langcode['0'];

/* Table-level filter capability. If set, it is included in the WHERE clause
   of any generated SELECT statement in SQL query. This gives you ability to
   work only with subset of data from table.
*/
//$opts['filters'] = "display='YES'";
/*$opts['filters'] = "section_id = 9";
$opts['filters'] = "PMEtable0.sessions_count > 200";
*/

/* Field definitions

Fields will be displayed left to right on the screen in the order in which they
appear in generated list. Here are some most used field options documented.

['name'] is the title used for column headings, etc.;
['maxlen'] maximum length to display add/edit/search input boxes
['trimlen'] maximum length of string content to display in row listing
['width'] is an optional display width specification for the column
          e.g.  ['width'] = '100px';
['mask'] a string that is used by sprintf() to format field output
['sort'] true or false; means the users may sort the display on this column
['strip_tags'] true or false; whether to strip tags from content
['nowrap'] true or false; whether this field should get a NOWRAP
['required'] true or false; if generate javascript to prevent null entries
['select'] T - text, N - numeric, D - drop-down, M - multiple selection
['options'] optional parameter to control whether a field is displayed
  L - list, F - filter, A - add, C - change, P - copy, D - delete, V - view
            Another flags are:
            R - indicates that a field is read only
            W - indicates that a field is a password field
            H - indicates that a field is to be hidden and marked as hidden
['URL'] is used to make a field 'clickable' in the display
        e.g.: 'mailto:$value', 'http://$value' or '$page?stuff';
['URLtarget']  HTML target link specification (for example: _blank)
['textarea']['rows'] and/or ['textarea']['cols']
  specifies a textarea is to be used to give multi-line input
  e.g. ['textarea']['rows'] = 5; ['textarea']['cols'] = 10
['values'] restricts user input to the specified constants,
           e.g. ['values'] = array('A','B','C') or ['values'] = range(1,99)
['values']['table'] and ['values']['column'] restricts user input
  to the values found in the specified column of another table
['values']['description'] = 'desc_column'
  The optional ['values']['description'] field allows the value(s) displayed
  to the user to be different to those in the ['values']['column'] field.
  This is useful for giving more meaning to column values. Multiple
  descriptions fields are also possible. Check documentation for this.
*/

$opts['fdd']['queueid'] = array(
  'name'     => 'Очередь',
  'select'   => 'T',
  'maxlen'   => 255,
  'default'  => '',
  'sort'     => true
);
$opts['fdd']['delivery_timestamp'] = array(
  'name'     => 'Дата и время доставки',
  'select'   => 'T',
  'maxlen'   => 255,
  'default'  => '',
  'sort'     => true
);
$opts['fdd']['from'] = array(
  'name'     => 'От',
  'select'   => 'T',
  'maxlen'   => 255,
  'default'  => '',
  'sort'     => true
);
$opts['fdd']['from']['URLprefix'] = 'mailto:';
$opts['fdd']['to'] = array(
  'name'     => 'Получатель',
  'select'   => 'T',
  'maxlen'   => 255,
  'default'  => '',
  'sort'     => true
);
$opts['fdd']['to']['URLprefix'] = 'mailto:';
//$opts['fdd']['login']['URLdisp'] = '$value';
//$opts['fdd']['login']['URLprefix'] = 'mailto:';
//$opts['fdd']['login']['URLpostfix'] = '@arcticsu.ru';
//$opts['fdd']['login']['sql'] = 'CONCAT(login, "@", domain)';
$opts['fdd']['status'] = array(
  'name'     => 'Статус',
  'select'   => 'T',
  'maxlen'   => 255,
  'default'  => '',
  'sort'     => true
);
//$opts['fdd']['phone1']['URLprefix'] = 'tel:';
$opts['fdd']['status_advanced'] = array(
  'name'     => 'Подробный статус',
  'select'   => 'T',
  'maxlen'   => 255,
  'default'  => '',
  'sort'     => false
);
$opts['fdd']['subject'] = array(
  'name'     => 'Тема',
  'select'   => 'T',
  'maxlen'   => 255,
  'default'  => '',
  'sort'     => false
);
$opts['fdd']['size'] = array(
  'name'     => 'Размер (байт)',
  'select'   => 'T',
  'maxlen'   => 255,
  'default'  => '',
  'sort'     => true
//  'URLdisp'  => $value.'@arcticsu'
);
//$opts['fdd']['status_advanced']['width'] = '500px';


// Now important call to phpMyEdit
require_once 'phpMyEdit.class.php';
new phpMyEdit($opts);

//}
?>
<div class="footer"><span style="font-weight: normal;">&copy; 2016 - <?php echo date('Y');?> | <a href="https://kgilc.ru">АО КГИЛЦ</a> | ver.0.9.9 </span></div>
</body>
</html>
