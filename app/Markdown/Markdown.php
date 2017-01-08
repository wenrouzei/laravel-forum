<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 2017/1/8
 * Time: 13:32
 */

namespace App\Markdown;


class Markdown
{
    protected $parser;

    public function __construct(Parser $parser)
    {
        $this->parser = $parser;

    }

    public function markdown($text)
    {
        $html = $this->parser->makeHtml($text);
        return $html;
    }
}