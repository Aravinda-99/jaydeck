<?php
/**
 * PHP version 5.6
 * 
 * Image upload helper using laraverl intervention image package
 * 
 * @category Class
 * 
 * @package ImageUpload
 * 
 * @author Sense IT <chamara.sense@gmail.com>
 * 
 * @license MIT https://opensource.org/licenses/MIT
 * 
 * @link https://sensefeelit.com/
 */
namespace App\Helper;

use Image;

/**
 * Image upload helper using laraverl intervention image package
 * 
 * @category Class
 * 
 * @package ImageUpload
 * 
 * @author Sense IT <chamara.sense@gmail.com>
 * 
 * @license MIT https://opensource.org/licenses/MIT
 * 
 * @link (ImageUpload, ImageUpload)
 */
class ImageUpload
{
    /**
     * Upload an iamge file
     * 
     * @param file   $image
     * @param string $path 
     * 
     * @return string
     */
    public static function upload($image,$path)
    {
        $imgName = uniqid().'.png';

        $imgObj = Image::make($image->getRealPath());

        //save original img
        $imgObj->save($path.'/'.$imgName);

        return $imgName;
    }

    /**
     * Upload image use the base64 string
     * 
     * @param base64 $image 
     * @param string $path  
     * 
     * @return string
     */
    public static function uploadBase64($image,$path)
    {
        $imgName = uniqid().'.png';

        $imgObj = Image::make($image);

        //save original img
        $imgObj->save($path.'/'.$imgName);

        return $imgName;
    }

}
