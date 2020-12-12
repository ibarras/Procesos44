<?php
namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class slugTitle extends AbstractExtension
{

    public function getFilters()
    {
        return [
            new TwigFilter('slugTitle', [$this, 'TitulonNormalize']),
        ];
    }


    public function TitulonNormalize($test=null)
    {
        // replace all non letters or digits by -
        $test = preg_replace('/\W+/', '-', $test);
        // trim and lowercase
        $test = strtolower(trim($test, '-'));
        $test = $test;
        return $test;
    }


}
