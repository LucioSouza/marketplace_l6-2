<?php

/**
 * 
 * @param array $items
 * @param int $store_id
 * @return apenas os itens cujo o store_id seja igual ao id da loja do usuário logado
 * 
 * Não esquecer de fazer o autoload desse arquivo em composer.json no array "autoload":{...
 * Depois de feito isso rodar no terminal "composer dump" para recarregar com as novas configurações
 */
function filterItemsByStoreId(array $items, $store_id) {

    return array_filter($items, function ($line) use($store_id) {
        return $line['store_id'] == $store_id;
    });
}
