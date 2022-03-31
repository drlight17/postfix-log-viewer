# postfix-log-viewer
web gui for viewing parsed postfix logs

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

