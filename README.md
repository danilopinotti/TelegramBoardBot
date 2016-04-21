# TelegramBoardBot
Bot criado para o uso de um aviso eletrônico, podendo este ser controlado por um painel offline ou via comando no telegram.

#Configuração do sistema
##Configuração Automática
Executar o seguinte script:
```bash
	$ ./scripts/install.sh
```

##Configuração Manual
1 - No diretório raiz da aplicação criar o arquivo com o nome `".htaccess"` e configurar os respectivos diretórios absolutos:

Conteúdo de `.htaccess` 
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
#Configuração do Bot
Arquivo de configuração: config/bot_config.php

A configuração `"valid_boards"` é referente aos modelos de avisos possíveis. Será visto logo a frente como criar um modelo do zero manualmente.

A princípio, a configuração é formada com o conjunto dos comandos recebidos pelo Telegram associados ao nome do modelo de aviso.
```php
$telegramBotConfig["valid_boards"] = array(	// Message from TELEGRAM CHAT => board name
	    "/reuniao" => "reuniao",
	    "/aberto" => "aberto",
	    "/manutencao_datacenter" => "manutencao_datacenter",
	    "/atendimento_externo" => "atendimento_externo"
	));
```


A configuração `"white_list"` é referente ao nome de usuário ou id dos usuários do Telegram que podem interagir com o sistema.
```php
	//List of allowed users.
	$telegramBotConfig["white_list"] = array(	//Allowed persons (ID or Username) to interact with BOT
		"DaniloPinotti",	//Danilo
		"144880123"
	);
```


As seguintes configurações são de extrema importância, pois, sem elas, o bot não funcionará e só será possível alterar o aviso do bot através do painel offline.

A configuração `"token"` é referente ao token de acesso ao bot. Este token é fornecido para você através do BotFather.

A configuração `"bot_name"` é referente ao nome dado ao Bot no momento da criação.
```php
	//Specific bot settings
	$telegramBotConfig["token"] = "1111111:IAOAIUHPKASIJDOAJSDP";
	$telegramBotConfig["bot_name"] = "@PinottiBoardBot";
```

As configurações a seguir são relacionadas à pasta onde os modelos de avisos ficarão armazenados e com o arquivo temporário de configuração, respectivamente.
```php
	//General configurations
	$telegramBotConfig["boards_folder"] = APP_ROOT_FOLDER."/boards";
	$telegramBotConfig["config_file"] = APP_ROOT_FOLDER."/.config";
```
#Usando o sistema
##Acesso ao aviso eletrônico
O equipamento que irá servir como painel eletrônico (tablet por exemplo) deverá acessar o endereço raiz da aplicação:

``http://some-server/board-bot``

##Acesso ao painel offline para alterar o aviso
Acessar o seguinte endereço

``http://some-server/board-bot/pages/panel``

##Alterar status pelo Telegram
Para poder alterar o aviso usando o Telegram, você, primeiramente, deve estar dentro da ``"white_list"`` presente nas configurações do bot.

Após isso, use os comandos criados pelo usuário manualmente no arquivo de configurações do bot ou pelo painel offline.

Exemplo de mensagem apra enviar para o bot nas configurações atuais:

``/atendimento_externo``



