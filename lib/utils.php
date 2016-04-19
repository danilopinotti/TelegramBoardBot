<?php 
/*
 * Função redireciona se não existirem parametros por post.
 * Caso o último parâmetro seja location, este determinará para 
 * qual página dese ser redirecionado o site.
 * Caso ele não seja enviado, será direcionado para o root do site
 */
function redirect_if_not_post() {
  $location = "location: " . SITE_ROOT;
  $params = func_get_args();

  $last_element = end($params);
  if (strpos($last_element, 'location:') !== false)
    $location = array_pop($params);

  foreach($params as $param) {
    if (!isset($_POST[$param])) {
      header($location);
      exit();
    }
  }
}

/*
 * Função para criar links.
 * Importante para definir os caminhos dos arquivos
 * Caso começe com / indica caminho absolute a partir do root da aplicação,
 * caso contrário é camaminho relativo
 */
function link_to($path, $name, $options = '') {
  if (substr($path, 0, 1) == '/')
    $link = SITE_ROOT . $path;
  else
    $link = $path;
  return "<a href='{$link}' {$options}> $name </a>";
}

/* Inclui arquivos css
 * Se o caminho começar com / deve ser considerado a partir da pasta ASSETS_FOLDER
 * caso contrário a partir de ASSETS_FORLDER/css/
 */
function stylesheet_include_tags() {
  $params = func_get_args();

  foreach($params as $param) {
    $path = ASSETS_FOLDER;
    $path .= (substr($param, 0, 1) === '/') ? $param : '/css/' . $param ;
    echo "<link href='{$path}' rel='stylesheet' type='text/css' />";
  }
}

/*
 * Inclui arquivos js
 * Se o caminho começar com / deve ser considerado a partir da pasta ASSETS_FOLDER
 * caso contrário a partir de ASSETS_FORLDER/css/
 */
function javascript_include_tags(){
  $params = func_get_args();
  foreach($params as $param){
    $path = ASSETS_FOLDER;
    $path .= (substr($param, 0, 1) === '/') ? $param : '/js/' . $param ;
    echo "<script src='{$path}' type='text/JavaScript'></script>";
  }
}

/*
 * Determina se um link é á página atual ou não
 * Caso seja retorna a class active
 * O caractere # indicador de inicio e fim da expressão regular.
 * */
function active_class($route) {
  $route = SITE_ROOT . $route;
  if (preg_match('#^' . $route . '$#', $_SERVER['REQUEST_URI']))
    return 'active';

  return '';
}

/*
 * Função usada para criar as urls das actions dos forms
 */ 
function url_for($path){
  if (substr($path, 0, 1) == '/')
    $url = SITE_ROOT . $path;
  else
    $url = $path;

  return $url;
}

/*
 * Flash message
 * A função flash permite armazenar mensagens durante uma única mudança de página,
 * dessa forma, você consegue acessar as mensagem apenas um única vez.
 * Excelente para avisos e alertas;
 */
function flash($key=null, $value = null) {
  if (isset($key)) {
    if (isset($value)){
      $_SESSION['flash'][$key] = $value;
    }else{
      $val = isset($_SESSION['flash'][$key]) ? $_SESSION['flash'][$key] :'';
      unset($_SESSION['flash'][$key]);
      return $val;
    }
  }else{
    $flashs = isset($_SESSION['flash']) ? $_SESSION['flash'] : array();
    unset($_SESSION['flash']);
    return $flashs;
  }
}

/*
 * Método destinada ao redirecionamento de páginas
 * Lembre-se que quando um endereço inicia-se com '/' diz respeito
 * a um caminho absoluto, caso contrário é um caminho relativo.
 */
function redirect_to($address) {
  if (substr($address, 0, 1) == '/')
    header('location: ' . SITE_ROOT . $address);
  else
    header('location: ' . $address);
  
  exit();
}

/*
 * Retorna o endereço da última página carregada,
 * caso não exista retorna o endereço da página principal da aplicação
 */
function back(){
  if (isset($_SERVER['HTTP_REFERER'])){
    return $_SERVER['HTTP_REFERER'];
  }else{
    return '/';
  }
}

/* 
 * Retorna uma array com os arquivos de um diretório.
 * Caso seja passado o segundo parâmetro como true, é retornado sem extensão
 */

function files_in_directory($directory, $without_extension = false){
  $files_raw = array_slice(scandir($directory), 2);
  $files = [];
  if ($without_extension == true){
    foreach ($files_raw as $file) {
      $files[] = preg_replace('/\\.[^.\\s]{3,5}$/', '', $file);
    }
    return $files;
  }
  else
    return $files_raw;
}

?>
