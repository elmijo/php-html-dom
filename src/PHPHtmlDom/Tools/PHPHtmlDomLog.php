<?php
namespace PHPHtmlDom\Tools;

/**
* Clase permite obtener un contenido que pude venir de una url o una archivo
*/
class PHPHtmlDomLog extends \PHPErrorLog\PHPErrorLog
{

    protected static $info_msg = array(); 

    protected static $error_msg = array(
        'E001' => 'El contenido (%.15s...) no parece ser un texto con formato HTML',
    ); 

    protected static $warn_msg = array(
        'W001' => 'No se pudo Acceder al Contenido (%s)',
    );

    final public function logError(int $msg_code,$data = array())
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
