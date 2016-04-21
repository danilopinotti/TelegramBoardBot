# TelegramBoardBot
Bot criado para o uso de um aviso eletrônico, podendo este ser controlado por um painel offline ou via comando no telegram.

#Instalação do sistema
##Configuração Automática
Executar o seguinte script:
```bash
	$ ./scripts/install.sh
```

##Configuração Manual
1 - No diretório raiz da aplicação criar o arquivo com o nome ".htaccess" e configurar os respectivos diretórios absolutos:
	Conteúdo de .htaccess 
```
php_value auto_prepend_file "/var/www/html/config/application.php"
		
php_flag log_errors on
		
php_value error_log "/var/www/html/logs/php_errors.log"
		
```
2 - Configuração do arquivo application.php
	Abra o arquivo config/application.php
	Altere a constante SITE_ROOT para o diretório relativo do sistema:
```php
define("SITE_ROOT", "/github");
```
