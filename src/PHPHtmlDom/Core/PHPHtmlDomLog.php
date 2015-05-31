<?php
namespace PHPTools\PHPHtmlDom\Core;

/**
* Clase permite obtener un contenido que pude venir de una url o una archivo
*/
class PHPHtmlDomLog extends \PHPErrorLog\PHPErrorLog
{

    protected static $info_msg = array(); 

    protected static $error_msg = array(
        'E000' => '%s',
        'E001' => 'El contenido (%.15s...) no parece ser un texto con formato HTML',
        'E002' => 'El contenido (%.15s...) no pudo ser convertido en un DOMDocument',
        'E003' => 'No se pudo convertir el selector (%s) en un DOMXPath',
    ); 

    protected static $warn_msg = array(
        'W001' => 'No se pudo Acceder al Contenido (%s)',
    );

    final public function logError($msg_code,$data = array())
    {
        self::write(self::compileMessage(self::$error_msg[$msg_code],$data), PEL_ERROR);
    } 

    final public function logWarn($msg_code,$data = array())
    {
        self::write(self::compileMessage(self::$warn_msg[$msg_code],$data), PEL_WARNING);
    }

    final public function logInfo($msg_code,$data = array())
    {
        self::write(self::compileMessage(self::$info_msg[$msg_code],$data), PEL_INFO);
    }

    private function compileMessage($msg,$data)
    {
        return sprintf("PHPHtmlDom: %s",vsprintf($msg,$data));
    }
}

?>
