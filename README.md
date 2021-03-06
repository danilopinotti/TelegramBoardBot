# TelegramBoardBot
Bot criado para o uso de um aviso eletrônico, podendo este ser controlado por um painel offline ou via comando no telegram.

![alt tag](https://raw.githubusercontent.com/danilopinotti/telegram-board-bot/master/assets/images/example.jpg)


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

 Abra o arquivo `config/application.php`
	
 Altere a constante ``SITE_ROOT`` para o diretório relativo do sistema:
```php
define('SITE_ROOT', '/board-bot');
```
#Configuração do Bot
Arquivo de configuração: `config/bot_config.php`

A configuração `"valid_boards"` é referente aos modelos de avisos possíveis. Será visto logo a frente como criar um modelo do zero manualmente.

A princípio, a configuração é formada com o conjunto dos comandos recebidos pelo Telegram associados ao nome do modelo de aviso.
```php
$telegramBotConfig["valid_boards"] = array(	// Message from TELEGRAM CHAT => board name
	    "/reuniao" => "reuniao",
	    "/aberto" => "aberto",
	    "/manutencao_datacenter" => "manutencao_datacenter"
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
O equipamento que irá servir como painel eletrônico (tablet por exemplo) deverá acessar o seguinte endereço:

``http://some-server/board-bot/pages/board``

##Acesso ao painel offline para alteração do aviso
Acessar o seguinte endereço

``http://some-server/board-bot/pages/panel``

##Alterar status pelo Telegram
Para poder alterar o aviso usando o Telegram, você, primeiramente, deve estar dentro da ``"white_list"`` presente nas configurações do bot.

Após isso, use os comandos criados pelo usuário manualmente no arquivo de configurações do bot ou pelo painel offline.

Exemplo de mensagem apra enviar para o bot (de acordo com as configurações atuais):

``/reuniao``

#Criação de novos avisos
##De forma manual
Crie um arquivo apenas com código HTML para seu aviso.

Exemplo de aviso:
```html
<h1>Em atendimento externo</h1>
<h2>Voltamos em breve</h2>
```

Salve o aquivo com o nome em ``snake case`` dentro da pasta `boards` com a extensão `.phtml`

Exemplo:
``boards/atendimento_externo.phtml``

No caso acima, o modelo ficou com o nome de `atendimento_externo`

Após criar o modelo de aviso, você deve configurar o comando para ele chamar no telegram.

Abra o arquivo de configuração `config/bot_config.php` e adicione a relação na configuração `"valid_boards"` como o exemplo a seguir:

```php
$telegramBotConfig["valid_boards"] = array(	// Message from TELEGRAM CHAT => board name
	    "/reuniao" => "reuniao",
	    "/aberto" => "aberto",
	    "/manutencao_datacenter" => "manutencao_datacenter",
	    "/at_externo" => "atendimento_externo"
	));

```

Deixando como acima, quando for enviado o comando `/at_externo` para o BOT no Telegram, automaticamente o sistema mudará o aviso para o recém criado `atendimento_externo`

##De forma automática
Acesse o painel disponível em:

`http://some-server/board-bot/pages/panel`

Preencha o formulário para criação de novo modelo de aviso.

Clique em `Criar`.

