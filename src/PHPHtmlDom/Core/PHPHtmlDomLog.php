<?php
namespace PHPTools\PHPHtmlDom\Core;

/**
* Esta clase peermite escribir los logs.
*/
class PHPHtmlDomLog extends \PHPTools\PHPErrorLog\PHPErrorLog
{
    /**
     * Arreglo con los mensajes de información.
     * @var array
     */
    protected static $info_msg = array(
        'I000' => '%s',
    );

    /**
     * Arreglo con los mensajes de error.
     * @var array
     */
    protected static $error_msg = array(
        'E000' => '%s',
        'E001' => 'El contenido (%.15s...) no parece ser un texto con formato HTML',
        'E002' => 'El contenido (%.15s...) no pudo ser convertido en un DOMDocument',
        'E003' => 'No se pudo convertir el selector (%s) en un DOMXPath',
    );

    /**
     * Arreglo con los mensajes de advertencia.
     * @var array
     */
    protected static $warn_msg = array(
        'W000' => '%s',
        'W001' => 'No se pudo Acceder al Contenido (%s)',
    );

    /**
     * Metodo que permite escribir un log de Error.
     * @param  string $msg_code Cadena de texto con el codigo del mensaje de error.
     * @param  array  $data     arreglo con los parametros necesarios para escribir el log.
     * @return void
     */
    final public function logError($msg_code,$data = array())
    {
        self::write(self::compileMessage(self::$error_msg[$msg_code],$data), PEL_ERROR);
    }

    /**
     * Metodo que permite escribir un log de Advertencia.
     * @param  string $msg_code Cadena de texto con el codigo del mensaje de advertencia.
     * @param  array  $data     arreglo con los parametros necesarios para escribir el log.
     * @return void
     */
    final public function logWarn($msg_code,$data = array())
    {
        self::write(self::compileMessage(self::$warn_msg[$msg_code],$data), PEL_WARNING);
    }

    /**
     * Metodo que permite escribir un log de Información.
     * @param  string $msg_code Cadena de texto con el codigo del mensaje de información.
     * @param  array  $data     arreglo con los parametros necesarios para escribir el log.
     * @return void
     */
    final public function logInfo($msg_code,$data = array())
    {
        self::write(self::compileMessage(self::$info_msg[$msg_code],$data), PEL_INFO);
    }

    /**
     * Metodo que permite compilar la cadena de texto del mensaje con sus parametros.
     * @param  string $msg  Cadena de texto con el mensaje.
     * @param  array $data  Arreglo con los parametros del mensaje.
     * @return string
     */
    private function compileMessage($msg,$data)
    {
        return sprintf("PHPHtmlDom: %s",vsprintf($msg,$data));
    }
}