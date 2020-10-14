
let cardNumber = document.querySelector('input[name=card_number]');
let spanBrand = document.querySelector('span.brand');



cardNumber.addEventListener('keyup', function () {

    if (cardNumber.value.length >= 6) {

        PagSeguroDirectPayment.getBrand({

            cardBin: cardNumber.value.substr(0, 6),

            success: function (response) {
                let imgFlag = `<img src="https://stc.pagseguro.uol.com.br/public/img/payment-methods-flags/68x30/${response.brand.name}.png">`;
                spanBrand.innerHTML = imgFlag;

                document.querySelector('input[name=card_brand]').value = response.brand.name;

                getInstallments(amountTransaction, response.brand.name);

            },
            error: function (error) {

                console.log(error);

            },
            complete: function (response) {

                console.log(response);

            },

        });

    }


});


document.getElementById("process-checkout").addEventListener("click", function (event) {


    event.preventDefault();

    event.target.disabled = true;
    event.target.textContent = 'Porcessando...';


    PagSeguroDirectPayment.createCardToken({
        cardNumber: document.querySelector('input[name=card_number]').value,
        brand: document.querySelector('input[name=card_brand]').value,
        cvv: document.querySelector('input[name=card_ccv]').value,
        expirationMonth: document.querySelector('input[name=card_month]').value,
        expirationYear: document.querySelector('input[name=card_year]').value,
        success: function (response) {
            console.log(response);
            processPayment(response.card.token);
        },
        error: function (response) {
            // Callback para chamadas que falharam.
            console.log(response.errors);

            event.target.disabled = false;
            event.target.textContent = 'Concluir pagamento';

            for (let errorCode in response.errors) {

                document.querySelector('#mensagemPagseguro').innerHTML = showErrorMessages(errorsMapPagseguroJS(errorCode));

            }

        },
        complete: function (response) {
            // Callback para todas chamadas.
        }
    });


});