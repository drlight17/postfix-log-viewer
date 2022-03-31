# postfix-log-viewer
web gui for viewing parsed postfix logs

Place files from web folder wherever you want on web server. GUI is based on [phpMyEdit class](https://www.phpmyedit.org/) fixed and adopted for the viewer (php 8.0 and older is supported).

Data collects by [this](https://github.com/drlight17/maillog2db) maillog2db script.

In order to use maillog2db in web gui create mysql view with such query:
~~~sql
select `pfmaillog2db_deliveries`.`id` AS `id`,`pfmaillog2db_deliveries`.`delivery_timestamp` AS `delivery_timestamp`,`pfmaillog2db_deliveries`.`delivery_queueid` AS `queueid`,concat_ws('',`pfmaillog2db_messages`.`message_from`,`pfmaillog2db_deliveries`.`delivery_from`) AS `from`,`pfmaillog2db_deliveries`.`delivery_to` AS `to`,`pfmaillog2db_messages`.`message_subject` AS `subject`,`pfmaillog2db_messages`.`message_size` AS `size`,`pfmaillog2db_deliveries`.`delivery_status` AS `status`,`pfmaillog2db_deliveries`.`delivery_statusext` AS `status_advanced` from (`pfmaillog2db_deliveries` left join `pfmaillog2db_messages` on(`pfmaillog2db_deliveries`.`delivery_queueid` = `pfmaillog2db_messages`.`message_queueid`))
~~~

In order to delete 3 months older data create in maillog2db database cleanup schedule:
~~~sql
CREATE DEFINER=`postfix`@`%` EVENT `cleanup`
	ON SCHEDULE
		EVERY 1 DAY STARTS '2022-04-01'
	ON COMPLETION NOT PRESERVE
	ENABLE
	COMMENT 'delete data older then 3 months'
	DO BEGIN
DELETE from pfmaillog2db_logs WHERE `log_timestamp` <= NOW() - INTERVAL 3 MONTH;
DELETE `pfmaillog2db_messages` from `pfmaillog2db_messages` INNER join `pfmaillog2db_deliveries` on `pfmaillog2db_messages`.`message_queueid`=`pfmaillog2db_deliveries`.`delivery_queueid` where `pfmaillog2db_messages`.`message_timestamp` = '0000-00-00 00:00:00' AND `pfmaillog2db_deliveries`.`delivery_timestamp` <= NOW() - INTERVAL 3 MONTH;
DELETE from pfmaillog2db_messages WHERE `message_timestamp` <= NOW() - INTERVAL 3 MONTH;
DELETE from pfmaillog2db_deliveries WHERE `delivery_timestamp` <= NOW() - INTERVAL 3 MONTH;
END
~~~
