<?php

require_once 'petitionemailcontactref.civix.php';
use CRM_Petitionemailcontactref_ExtensionUtil as E;

/**
 * Implements hook_civicrm_config().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_config
 */
function petitionemailcontactref_civicrm_config(&$config) {
  _petitionemailcontactref_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_xmlMenu().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_xmlMenu
 */
function petitionemailcontactref_civicrm_xmlMenu(&$files) {
  _petitionemailcontactref_civix_civicrm_xmlMenu($files);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_install
 */
function petitionemailcontactref_civicrm_install() {
  _petitionemailcontactref_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_postInstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_postInstall
 */
function petitionemailcontactref_civicrm_postInstall() {
  _petitionemailcontactref_civix_civicrm_postInstall();
}

/**
 * Implements hook_civicrm_uninstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_uninstall
 */
function petitionemailcontactref_civicrm_uninstall() {
  _petitionemailcontactref_civix_civicrm_uninstall();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_enable
 */
function petitionemailcontactref_civicrm_enable() {
  _petitionemailcontactref_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_disable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_disable
 */
function petitionemailcontactref_civicrm_disable() {
  _petitionemailcontactref_civix_civicrm_disable();
}

/**
 * Implements hook_civicrm_upgrade().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_upgrade
 */
function petitionemailcontactref_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _petitionemailcontactref_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implements hook_civicrm_managed().
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_managed
 */
function petitionemailcontactref_civicrm_managed(&$entities) {
  _petitionemailcontactref_civix_civicrm_managed($entities);
}

/**
 * Implements hook_civicrm_caseTypes().
 *
 * Generate a list of case-types.
 *
 * Note: This hook only runs in CiviCRM 4.4+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_caseTypes
 */
function petitionemailcontactref_civicrm_caseTypes(&$caseTypes) {
  _petitionemailcontactref_civix_civicrm_caseTypes($caseTypes);
}

/**
 * Implements hook_civicrm_angularModules().
 *
 * Generate a list of Angular modules.
 *
 * Note: This hook only runs in CiviCRM 4.5+. It may
 * use features only available in v4.6+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_angularModules
 */
function petitionemailcontactref_civicrm_angularModules(&$angularModules) {
  _petitionemailcontactref_civix_civicrm_angularModules($angularModules);
}

/**
 * Implements hook_civicrm_alterSettingsFolders().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_alterSettingsFolders
 */
function petitionemailcontactref_civicrm_alterSettingsFolders(&$metaDataFolders = NULL) {
  _petitionemailcontactref_civix_civicrm_alterSettingsFolders($metaDataFolders);
}

/**
 * Implements hook_civicrm_entityTypes().
 *
 * Declare entity types provided by this module.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_entityTypes
 */
function petitionemailcontactref_civicrm_entityTypes(&$entityTypes) {
  _petitionemailcontactref_civix_civicrm_entityTypes($entityTypes);
}

/**
 * Implements hook_civicrm_buildForm().
 *
 * @param string $formName
 * @param CRM_Core_Form $form
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_buildForm/
 */
function petitionemailcontactref_civicrm_buildForm($formName, &$form) {
  if ($formName == 'CRM_Custom_Form_CustomDataByType') {
    CRM_Core_Resources::singleton()->addScriptFile('com.jlacey.petitionemailcontactref', 'js/petitionemailcontactref.js');
  }
}

/**
 * Implements hook_civicrm_validateForm().
 *
 * @param string $formName
 * @param array $fields
 * @param array $files
 * @param CRM_Core_Form $form
 * @param array $errors
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_validateForm/
 */
function petitionemailcontactref_civicrm_validateForm($formName, &$fields, &$files, &$form, &$errors) {
  if ($formName == 'CRM_Campaign_Form_Petition') {
    $email_recipient_system_id = civicrm_api3('CustomField', 'getvalue', [
      'return' => "id",
      'name' => "Email_Recipient_System",
    ]);
    $email_recipient_system_custom_field_name = "custom_" . $email_recipient_system_id . "_1";
    if ($fields["$email_recipient_system_custom_field_name"] == 'Contactref') {
      $recipient_contact_reference_id = civicrm_api3('CustomField', 'getvalue', [
        'return' => "id",
        'name' => "Recipient_Contact_Reference",
      ]);
      $recipient_contact_reference_custom_field_name = "custom_" . $recipient_contact_reference_id . "_1";
      if (!empty($fields["$recipient_contact_reference_custom_field_name"])) {
        $recipient_contact_id = $fields["$recipient_contact_reference_custom_field_name"];
        $recipient_contact_email = civicrm_api3('Contact', 'get', [
          'return' => "email",
          'id' => $recipient_contact_id,
        ]);
        if (empty($recipient_contact_email['values'][$recipient_contact_id]['email'])) {
          //FIXME this doesn't highlight the field.
          $errors["$recipient_contact_reference_custom_field_name"] = ts('Please select a recipient contact with an email address');
        }
      }
    }
  }
}
