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
?>