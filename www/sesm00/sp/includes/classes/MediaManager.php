<?php


class MediaManager
{
    private static $stylesheets = [];
    private static $javascripts = [];
    private static $javascriptConstants = [];
    private static $stylesheetsPrited = false;
    private static $javascriptsPrinted = false;
    private static $javascriptsConstsPrinted = false;

    public const SCRIPT_URL = BASE_URL . "assets/js/";
    public const STYLE_URL = BASE_URL . "assets/css/";

    public static function addStylesheet($url, $version) {
        if (self::$stylesheetsPrited) {
            trigger_error("This has to be called before head tag is sent");
            return;
        }
        self::$stylesheets[] = array('url' => $url, 'version' => $version);
    }

    public static function addJavascript($url, $version) {
        if (self::$javascriptsPrinted) {
            trigger_error("This has to be called before footer tag is sent");
            return;
        }
        self::$javascripts[] = array('url' => $url, 'version' => $version);
    }

    public static function addJavascriptConstant($name, $value) {
        if (self::$javascriptsConstsPrinted) {
            trigger_error("This has to be called before footer tag is sent");
            return;
        }
        self::$javascriptConstants [] = array('name' => $name, 'value' => $value);
    }

    public static function printAllStyles() {
        $output = "";
        foreach (self::$stylesheets as $stylesheet) {
            $output .= "<link rel=\"stylesheet\" href=\"" . getProtocol() . $_SERVER['HTTP_HOST'] . $stylesheet['url'] . "?v=". $stylesheet['version'] . "\" type=\"text/css\">\n";
        }
        self::$stylesheetsPrited = true;
        return $output;
    }

    public static function printAllScripts() {
        $output = "";
        foreach (self::$javascripts as $javascript) {
            $output .= "<script src=" . getProtocol() . $_SERVER['HTTP_HOST'] . $javascript['url'] . "?v=". $javascript['version'] . "></script>\n";
        }
        self::$javascriptsPrinted = true;
        return $output;
    }

    public static function printAllJavascriptConstants()
    {
        $output = "";
        foreach (self::$javascriptConstants as $constant) {
            $output .= "var " . strtoupper($constant['name']) . " = " . $constant['value'] . ";\n";
        }
        self::$javascriptsPrinted = true;
        return $output;
    }

}