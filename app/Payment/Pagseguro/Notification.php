<?php

namespace App\Payment\Pagseguro;

/**
 * Description of Notification
 *
 * @author ULASOU5
 */
class Notification {

    public function getTransaction() {

        if (!\PagSeguro\Helpers\Xhr::hasPost()) {

            throw new \InvalidArgumentException($_POST);
        } else {

            $response = \PagSeguro\Services\Transactions\Notification::check(
                            \PagSeguro\Configuration\Configure::getAccountCredentials()
            );
        }

        return $response;
    }

}
