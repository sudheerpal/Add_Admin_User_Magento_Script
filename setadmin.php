
<?php

require_once('app/Mage.php'); //Path to Magento
umask(0);
Mage::app();



//create new user by providing details below
$user = Mage::getModel('admin/user')
		->setData(array(
			'username'  => 'admin123',
			'firstname' => 'Admin',
			'lastname'	=> 'User',
			'email'     => 'sudheerpal2@gmail.com',
			'password'  => 'admin@123',
			'is_active' => 1
		))->save();


//create new role
	$role = Mage::getModel("admin/roles")
			->setName('Developer')
			->setRoleType('G')
			->save();
	

//give "all" privileges to role
	Mage::getModel("admin/rules")
			->setRoleId($role->getId())
			->setResources(array("all"))
			->saveRel();


//assign user to role
	$user->setRoleIds(array($role->getId()))
		->setRoleUserId($user->getUserId())
		->saveRelations();


echo 'Admin User sucessfully created!';




?>