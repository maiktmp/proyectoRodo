<?php
/**
 * Created by PhpStorm.
 * User: presa
 * Date: 24/01/2019
 * Time: 08:53 PM
 */

namespace App;


use Illuminate\View\Compilers\BladeCompiler;

class blade
{
    public static function registerDirectives(BladeCompiler $blade)
    {
        $keywords = ["namespace", "use"];
        foreach ($keywords as $keyword) {
            $blade->directive($keyword, function ($parameter) use($keyword) {
                $parameter = trim($parameter, "()");
                return "<?php {$keyword} {$parameter} ?>";
            });
        }
        $assetify = function ($file, $type) {
            $file = trim($file, "()");
            if (in_array(substr($file, 0, 1), ["'", '"'], true)) {
                $file = trim($file, "'\"");
            } else {
                return "{{ {$file} }}";
            }
            if (substr($file, 0, 1) !== "/") {
                $file = "/{$type}/{$file}";
            }
            if (substr($file, (strlen($type) + 1) * -1) !== ".{$type}") {
                $file .= ".{$type}";
            }
            return $file;
        };
        $blade->directive("css", function ($parameter) use($assetify) {
            $file = $assetify($parameter, "css");
            return "<link rel='stylesheet' type='text/css' href='{$file}'>";
        });
        $blade->directive("js", function ($parameter) use($assetify) {
            $file = $assetify($parameter, "js");
            return "<script type='text/javascript' src='{$file}'></script>";
        });
    }
}