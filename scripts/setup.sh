#!/bin/bash

app_root_path="`pwd`"
document_root="/var/www"
site_root_path=$(echo $app_root_path | sed -e "s|$document_root||g")
htaccess_path="${app_root_path}/.htaccess"
application_path="${app_root_path}/config/application.php"
log_path="${app_root_path}/logs/php_errors.log"
site_name=$(basename $app_root_path)


function setup_config_application_path() {
  echo "setup SITE_ROOT path on $application_path"

  sed "s|define('SITE_ROOT'.*);|define('SITE_ROOT', '$site_root_path');|g" $application_path > "${application_path}.changed"
  mv "${application_path}.changed" $application_path
}

function setup_htaccess_auto_prepend_path() {
  echo "setup htaccess auto_prepend_path on $htaccess_path"

  sed "s|php_value auto_prepend_file.*|php_value auto_prepend_file '$application_path'|g" $htaccess_path > "${htaccess_path}.changed"
  mv "${htaccess_path}.changed" "${htaccess_path}"
}

function setup_htaccess_error_log() {
  echo "setup htaccess error_log on $htaccess_path"

  sed "s|php_value error_log.*|php_value error_log '$log_path'|g" $htaccess_path > "${htaccess_path}.changed"
  mv "${htaccess_path}.changed" "${htaccess_path}"
}

function run() {
  setup_config_application_path
  setup_htaccess_auto_prepend_path
  setup_htaccess_error_log
}

run

