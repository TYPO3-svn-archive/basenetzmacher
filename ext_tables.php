<?php
if(!defined('TYPO3_MODE')){
    die('Access denied.');
}


/***************
 * Default TypoScript
 */
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Netzmacher Base');


/***************
 * BackendLayoutDataProvider
 */
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['BackendLayoutDataProvider'][$_EXTKEY] = 'Netzmacher\BaseNetzmacher\Hooks\Options\BackendLayoutDataProvider';


/***************
 * Backend Styling
 */
if (TYPO3_MODE == 'BE') {
    $settings = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$_EXTKEY]);
//    if(!isset($settings['Logo'])){
//        $settings['Logo'] = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Images/Backend/TopBarLogo@2x.png';
//    }
//    if(!isset($settings['LoginLogo'])){
//        $settings['LoginLogo'] = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Images/Backend/LoginLogo.png';
//    }
//    $GLOBALS['TBE_STYLES']['logo'] = $settings['Logo'];
//    $GLOBALS['TBE_STYLES']['logo_login'] = $settings['LoginLogo'];
//    $GLOBALS['TBE_STYLES']['htmlTemplates']['EXT:backend/Resources/Private/Templates/login.html'] = 'EXT:bootstrap_package/Resources/Private/Templates/Backend/Login.html';
    if(!isset($settings['Logo'])){
        $settings['Logo'] = 'gfx/typo3-topbar@2x.png';
    }
    if(!isset($settings['LoginLogo'])){
        $settings['LoginLogo'] = 'sysext/t3skin/images/login/typo3logo-white-greyback.gif';
    }
    $GLOBALS['TBE_STYLES']['logo'] = $settings['Logo'];
    $GLOBALS['TBE_STYLES']['logo_login'] = $settings['LoginLogo'];
    $GLOBALS['TBE_STYLES']['htmlTemplates']['EXT:backend/Resources/Private/Templates/login.html'] = 'sysext/t3skin/Resources/Private/Templates/login.html';
    unset($settings);
}