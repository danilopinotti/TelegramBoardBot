<?php

class ViewHelpers {

  /* Inclui arquivos css
   * Se o caminho começar com / deve ser considerado a partir da pasta ASSETS_FOLDER
   * caso contrário a partir de ASSETS_FORLDER/css/
   */
  public static function stylesheetIncludeTag() {
    $params = func_get_args();

    $links = "";
    foreach($params as $param) {
      $path = ASSETS_FOLDER;
      $path .= (substr($param, 0, 1) === '/') ? $param : '/css/' . $param ;
      $links .= "<link href='{$path}' rel='stylesheet' type='text/css' />";
    }
    return $links;
  }

  /*
   * Inclui arquivos js
   * Se o caminho começar com / deve ser considerado a partir da pasta ASSETS_FOLDER
   * caso contrário a partir de ASSETS_FORLDER/css/
   */
  public static function javascriptIncludeTag(){
    $params = func_get_args();

    $links = "";
    foreach($params as $param){
      $path = ASSETS_FOLDER;
      $path .= (substr($param, 0, 1) === '/') ? $param : '/js/' . $param ;
      $links .= "<script src='{$path}' type='text/JavaScript'></script>";
    }
    return $links;
  }

  /*
   * Função para criar links.
   * Importante para definir os caminhos dos arquivos
   * Caso começe com / indica caminho absolute a partir do root da aplicação,
   * caso contrário é camaminho relativo
   */
  public static function linkTo($path, $name, $options = '') {
    if (substr($path, 0, 1) == '/')
      $link = SITE_ROOT . '/pages' . $path;
    else
      $link = '/pages' . $path;
    return "<a href='{$link}' {$options}> $name </a>";
  }

  /*
   * Função para criação de urls
   * Importante, pois com elas não é necessário fazer diversas
   * alterações quando mudar a url principal do site
   */
  public static function urlFor($path){
    return SITE_ROOT . $path;
  }

  public static function imageTag($path, $options = "") {
    $path = ASSETS_FOLDER;
    $path .= (substr($path, 0, 1) === '/') ? $path : '/images/' . $path ;
    return "<img src=\"{$path}\" {$options} />";
  }

  /*
   * Método destinada ao redirecionamento de páginas
   * Lembre-se que quando um endereço inicia-se com '/' diz respeito
   * a um caminho absoluto, caso contrário é um caminho relativo.
   */
  public static function redirectTo($address) {
    if (substr($address, 0, 1) == '/')
      header('location: ' . SITE_ROOT . '/pages' . $address);
    else
      header('location: ' . $address);
    exit();
  }

  /*
   * Função para converter boleano em formato amigável
   */
  public static function prettyBool($value){
    return $value ? 'Sim' : 'Não';
  }

  public static function formatDate($date){
    return date('d/m/Y h:i:s', strtotime($date));
  }

  public static function activeClass($route) {
    $route = SITE_ROOT . '/pages' . $route;
    if (preg_match('#^' . $route . '$#', $_SERVER['REQUEST_URI']))
      return 'active';

    return '';
  }
}
?>
