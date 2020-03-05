<?php
use lithium\data\Connections;

 Connections::add('default', array(
 	'type' => CONNECTION_TYPE,
 	'host' => array(CONNECTION,
		),
//	'replicaSet' => true,
 	'database' => CONNECTION_DB,
	'login' => CONNECTION_USER,
	'password' => CONNECTION_PASS,	
	//'classes' => array('server' => 'Mongo')
//	'setSlaveOkay' => true,
//	'readPreference' => Mongo::RP_NEAREST	
 ));

 Connections::add('default_Personality', array(
 	'type' => CONNECTIONPERSONALITY_TYPE,
 	'host' => array(CONNECTIONPERSONALITY,
		),
//	'replicaSet' => true,
	'database' => CONNECTIONPERSONALITY_DB,
	'login' => CONNECTIONPERSONALITY_USER,
	'password' => CONNECTIONPERSONALITY_PASS,	
//	'setSlaveOkay' => true,
//	'readPreference' => Mongo::RP_NEAREST	
 ));

 Connections::add('default_Navpallavan', array(
 	'type' => CONNECTIONNAVPALLAVAN_TYPE,
 	'host' => array(CONNECTIONNAVPALLAVAN,
		),
//	'replicaSet' => true,
	'database' => CONNECTIONNAVPALLAVAN_DB,
	'login' => CONNECTIONNAVPALLAVAN_USER,
	'password' => CONNECTIONNAVPALLAVAN_PASS,	
//	'setSlaveOkay' => true,
//	'readPreference' => Mongo::RP_NEAREST	
 ));

 Connections::add('default_Rbitcoin', array(
 	'type' => CONNECTIONRBITCOIN_TYPE,
 	'host' => array(CONNECTIONRBITCOIN,
		),
//	'replicaSet' => true,
	'database' => CONNECTIONRBITCOIN_DB,
	'login' => CONNECTIONRBITCOIN_USER,
	'password' => CONNECTIONRBITCOIN_PASS,	
//	'setSlaveOkay' => true,
//	'readPreference' => Mongo::RP_NEAREST	
 ));
	
 Connections::add('default_Modicare', array(
 	'type' => CONNECTIONMODICARE_TYPE,
 	'host' => array(CONNECTIONMODICARE,
		),
//	'replicaSet' => true,
	'database' => CONNECTIONMODICARE_DB,
	'login' => CONNECTIONMODICARE_USER,
	'password' => CONNECTIONMODICARE_PASS,	
//	'setSlaveOkay' => true,
//	'readPreference' => Mongo::RP_NEAREST	
 ));


?>