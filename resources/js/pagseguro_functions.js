function processPayment(token) {

    let data = {

        card_token: token,
        hash: PagSeguroDirectPayment.getSenderHash(),
        installment: document.querySelector('select.select-installments').value,
        card_name: document.querySelector('input[name=card_name]').value,
        _token: CSRF_TOKEN

    };
    $.ajax({

        type: 'POST',
        url: URL_PROCESS,
        data: data,
        dataType: 'json',
        success: function (response) {
            window.location.href = `${URL_SUCESSO}?order=${response.data.order}`; // `` é o template literal do blade
        },
        error: function (response) {
            let message = (JSON.parse(response.responseText));
            document.querySelector('#mensagemPagseguro').innerHTML = showErrorMessages(message.data.error.message);
        }

    });


}



function getInstallments(amount, brand) {

    PagSeguroDirectPayment.getInstallments({
        amount: amount,
        maxInstallmentNoInterest: 0,
        brand: brand,
        success: function (response) {

            let selectInstallments = drawSelectInstallments(response.installments[brand]);
            document.querySelector('div.installments').innerHTML = selectInstallments;

        },
        error: function (response) {

            console.log(response);
        },
        complete: function (response) {

            console.log(response);
        }
    });



}


function drawSelectInstallments(installments) {
    let select = '<label>Opções de Parcelamento:</label>';

    select += '<select class="custom-select select-installments">';

    for (let l of installments) {
        select += `<option value="${l.quantity}|${l.installmentAmount}">${l.quantity}x de ${l.installmentAmount} - Total fica ${l.totalAmount}</option>`;
    }


    select += '</select>';

    return select;
}


function showErrorMessages(message) {

    //Aqui estou usando o `` que é o template literals

    return `

        <div class="alert alert-danger">${message}</div>
    `;
}


function errorsMapPagseguroJS(code) {

    //Fiz apenas paraum, mas é interessante fazer para os erros mais conhecidos
    switch (code) {

        case '10000':

            return 'Bandeira do cartão inválida';

            break;

        default:

            return 'Erro desconhecido';

            break;
    }


}
