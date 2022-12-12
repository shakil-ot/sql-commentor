<?php


namespace Shakil\QueryTracker;

class Utils
{
    public static function formatComments(array $comments): string
    {
        if (empty($comments)) {
            return "";
        }

        $commentOfQuery = '';

        foreach ($comments as $key => $comment){
            $commentOfQuery.= $key . " = " . self::customUrlEncode($comment) . ", ";
        }

        return "/*" . trim($commentOfQuery,", ") . "*/";
    }

    private static function customUrlEncode(string $input): string
    {
        $encodedString = urlencode($input);

        // Since SQL uses '%' as a keyword, '%' is a by-product of url quoting
        // e.g. foo,bar --> foo%2Cbar
        // thus in our quoting, we need to escape it too to finally give
        //      foo,bar --> foo%%2Cbar

        return str_replace("%", "%%", $encodedString);
    }
}
