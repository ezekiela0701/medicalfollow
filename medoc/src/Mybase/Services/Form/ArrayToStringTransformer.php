<?php
namespace App\Mybase\Services\Form;

use Symfony\Component\Form\DataTransformerInterface;

class ArrayToStringTransformer implements DataTransformerInterface
{
    /**
     * Transforms a string to an array.
     *
     * @param  string $string
     *
     * @return array
     */
    public function transform($string)
    {
        return explode(",", $string);
    }

    /**
     * Transforms an array to a string. 
     * POSSIBLE LOSS OF DATA
     *
     * @return string
     */
    public function reverseTransform($array)
    {
        return implode(",", $array);
    }


}
