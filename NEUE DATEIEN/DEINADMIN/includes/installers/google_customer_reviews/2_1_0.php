<?php
/**
* @package Google Customer Reviews
* @copyright Copyright 2003-2019 Zen Cart Development Team
* @copyright Portions Copyright 2003 osCommerce
* @license https://www.zen-cart-pro.at/license/3_0.txt GNU General Public License V3.0
* @version $Id: 2_1_0.php 2017-11-12 18:13:51Z webchills $
*/

$db->Execute(" SELECT @gid:=configuration_group_id
FROM ".TABLE_CONFIGURATION_GROUP."
WHERE configuration_group_title= 'Google Kundenrezensionen'
LIMIT 1;");


$db->Execute("INSERT IGNORE INTO ".TABLE_CONFIGURATION." (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES
('Google Customers Reviews Status', 'GCR_STATUS', 'false', 'Activate Google Customer Reviews?', @gid, 1, NOW(), NOW(), NULL, 'zen_cfg_select_option(array(\"true\", \"false\"),'),
('Google Merchant Center ID', 'GCR_ID', '', 'This is your Google Merchant Center ID listed in your account and in the Google provided javascript code, it will be a numbered ID, for example ID: 123456:', @gid, 2, NOW(), NOW(), NULL, NULL),
('Default Shipping Time', 'GCR_ESTIMATE_DELIVERY_TIME', '7', 'Enter the number of days for your slowest shipping method here.', @gid, 3, NOW(), NOW(), NULL, NULL),
('Opt-In Style', 'GCR_OPT_IN_STYLE', 'CENTER_DIALOG', 'Specifies how the opt-in  dialog box is displayed. Default is CENTER_DIALOG, do the opt-in is displayed as a dialog box in the center of the view.<br/>', @gid, 4, NOW(), NOW(), NULL, 'zen_cfg_select_option(array(\"CENTER_DIALOG\", \"BOTTOM_RIGHT_DIALOG\", \"BOTTOM_LEFT_DIALOG\", \"TOP_RIGHT_DIALOG\", \"TOP_LEFT_DIALOG\",\"BOTTOM_TRAY\"),'),
('Badge Position', 'GCR_BADGE_POSITION', 'BOTTOM_RIGHT', 'Renders the badge in one of the following locations (Default ist BOTTOM_RIGHT. Renders the badge in the place in which the code appears. When using INLINE, be sure that other elements on the page do not block or obscure the badge.):<br/>', @gid, 5, NOW(), NOW(), NULL, 'zen_cfg_select_option(array(\"BOTTOM_RIGHT\", \"BOTTOM_LEFT\", \"INLINE\"),'),
('Show Badge?', 'GCR_BADGE', 'true', 'Display the optional Google Customer Reviews Badge?', @gid, 6, NOW(), NOW(), NULL, 'zen_cfg_select_option(array(\"true\", \"false\"),');");

// add German configuration
$db->Execute("REPLACE INTO ".TABLE_CONFIGURATION_LANGUAGE." (configuration_title, configuration_key, configuration_description, configuration_language_id) VALUES
('Google Kundenrezensionen aktivieren?', 'GCR_STATUS', 'Wollen Sie die Google Kunderezensionen Bewertungsaufforderung aktivieren?', 43),
('Google Merchant Center ID', 'GCR_ID', 'Geben Sie hier Ihre Google Mechant Center ID ein. Sie wird in Ihrem Merchant Center Account angezeigt und ist auch in den dort von Google bereitgestellten Javascripts zu finden.', 43),
('Versanddauer', 'GCR_ESTIMATE_DELIVERY_TIME', 'Geben Sie hier die Versanddauer Ihrer am längsten dauernden Versandart in Tagen an. Nach diesem hier eingestellten Zeitraum bekommt der Kunde von Google die Bewertungsaufforderung.<br/>', 43),
('Opt-In Fenster Stil', 'GCR_OPT_IN_STYLE', 'Auf der Checkout Success Seite kann das Popup mit dem Bewertungs Opt-In an verschiedenen Positionen dargestellt werden. Voreingestellt ist CENTER_DIALOG, also genau in der Seitenmitte, Sie können hier aber auch eine andere Position wählen.<br/>', 43),
('Badge Position', 'GCR_BADGE_POSITION', 'Wo soll das Google Kundenrezensionen Badge falls aktiviert angezeigt werden?<br/>Normalerweise unten rechts, es ist aber auch unten links oder Inline möglich. Falls Sie INLINE verwenden, müssen Sie sicherstellen, dass das Badge nicht von anderen Elementen überlagert wird, Am besten links unten oder rechts unten verwenden!<br/>', 43),
('Badge anzeigen?', 'GCR_BADGE', 'Wollen Sie das Google Kundenrezensionen Badge anzeigen?', 43)");


$admin_page = 'configGoogleKundenrezensionen';
// delete configuration menu
$db->Execute("DELETE FROM " . TABLE_ADMIN_PAGES . " WHERE page_key = '" . $admin_page . "' LIMIT 1;");
// add configuration menu
if (!zen_page_key_exists($admin_page)) {
$db->Execute(" SELECT @gid:=configuration_group_id
FROM ".TABLE_CONFIGURATION_GROUP."
WHERE configuration_group_title= 'Google Kundenrezensionen'
LIMIT 1;");

$db->Execute("INSERT INTO " . TABLE_ADMIN_PAGES . " (page_key,language_key,main_page,page_params,menu_key,display_on_menu,sort_order) VALUES 
('configGoogleKundenrezensionen','BOX_CONFIGURATION_GCR','FILENAME_CONFIGURATION',CONCAT('gID=',@gid),'configuration','Y',@gid)");
$messageStack->add('Google Kundenrezensionen Konfiguration erfolgreich hinzugefügt.', 'success');  
}