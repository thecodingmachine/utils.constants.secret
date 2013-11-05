<?php
/*
 * Copyright (c) 2013 David Negrier
 * 
 * See the file LICENSE.txt for copying permission.
 */
namespace Mouf\Utils\Constants;

use Mouf\Installer\PackageInstallerInterface;
use Mouf\MoufManager;

/**
 * A logger class that writes messages into the php error_log.
 */
class SecretInstaller implements PackageInstallerInterface {

	/**
	 * (non-PHPdoc)
	 * @see \Mouf\Installer\PackageInstallerInterface::install()
	 */
	public static function install(MoufManager $moufManager) {
		$configManager = $moufManager->getConfigManager();
		
		$constants = $configManager->getMergedConstants();
		
		if (!isset($constants['SECRET'])) {
			$configManager->registerConstant("SECRET", "string", self::generateRandomString(), "A random string. It should be different for any application deployed.");
		}
		
		$configPhpConstants = $configManager->getDefinedConstants();
		$configPhpConstants['SECRET'] = self::generateRandomString();
		$configManager->setDefinedConstants($configPhpConstants);
		
		// Let's rewrite the MoufComponents.php file to save the component
		$moufManager->rewriteMouf();
	}
	
	private static function generateRandomString($length = 20) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, strlen($characters) - 1)];
		}
		return $randomString;
	}
	
}
