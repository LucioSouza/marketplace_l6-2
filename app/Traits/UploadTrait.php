<?php

namespace App\Traits;


/**
 *
 * @author ULASOU5
 */
trait UploadTrait {

    /**
     * 
     * @param array or string $images
     * @param string $imageColumn; nome da coluna que receberá o nome da imagem. Esse é um campo opcional a ser utilizado para upload de
     * apenas uma imagem ou um array de imagens
     * Ou seja, se $imageColumn vier com null, está sendo feito upload de uma logo, caso contrário, upload de imagens de produtos
     * @return array
     */
    private function imageUpload($images, $imageColumn = null) {


        $uploadedImages = [];

        if (is_array($images)) {

            foreach ($images as $image) {
                
                $uploadedImages[] = [$imageColumn => $image->store('products', 'public')]; //Usado para uploads de fotos do produto

            }
        } else {

            $uploadedImages = $images->store('logo', 'public'); //Usado para upload da logo da loja
        }



        return $uploadedImages;
    }

}
