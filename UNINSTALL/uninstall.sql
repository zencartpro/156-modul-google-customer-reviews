#############################################################################################
# Google Kundenrezensionen 2.1.0 Uninstall - 2017-11-12 - webchills
# NUR AUSFÜHREN FALLS SIE DAS MODUL VOLLSTÄNDIG ENTFERNEN WOLLEN!!!
#############################################################################################

DELETE FROM configuration_group WHERE configuration_group_title = 'Google Kundenrezensionen';
DELETE FROM configuration WHERE configuration_key = 'GCR_VERSION';
DELETE FROM configuration WHERE configuration_key = 'GCR_STATUS';
DELETE FROM configuration WHERE configuration_key = 'GCR_ID';
DELETE FROM configuration WHERE configuration_key = 'GCR_ESTIMATE_DELIVERY_TIME';
DELETE FROM configuration WHERE configuration_key = 'GCR_OPT_IN_STYLE';
DELETE FROM configuration WHERE configuration_key = 'GCR_BADGE_POSITION';
DELETE FROM configuration WHERE configuration_key = 'GCR_BADGE';
DELETE FROM configuration_language WHERE configuration_key = 'GCR_STATUS';
DELETE FROM configuration_language WHERE configuration_key = 'GCR_ID';
DELETE FROM configuration_language WHERE configuration_key = 'GCR_ESTIMATE_DELIVERY_TIME';
DELETE FROM configuration_language WHERE configuration_key = 'GCR_OPT_IN_STYLE';
DELETE FROM configuration_language WHERE configuration_key = 'GCR_BADGE_POSITION';
DELETE FROM configuration_language WHERE configuration_key = 'GCR_BADGE';
DELETE FROM admin_pages WHERE page_key='configGoogleKundenrezensionen';