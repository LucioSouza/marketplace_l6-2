@extends('layouts.front')


@section('content')

<div class="container">


    <div class="row">

        <div class="col-md-6 mx-auto">

            <h2 class="mb-5">Dados de pagamento</h2>


            <div id="mensagemPagseguro">
                
            </div>


            <form action="" method="post">


                @csrf



                <div class="form-row">


                    <div class="col-md-12 form-group">
                        <label>Número do cartão&nbsp;<span class="brand"></span></label>
                        <input type="text" class="form-control" name="card_number">
                        <input type="hidden" class="form-control" name="card_brand">
                    </div>

                    <div class="col-md-12 form-group">
                        <label>Nome do titular do cartão</label>
                        <input type="text" class="form-control" name="card_name">
                    </div>


                </div>

                <div class="form-row mb-2">


                    <div class="col-md-4 form-group">

                        <label>Mês de expiração</label>
                        <input type="text" class="form-control" name="card_month">

                    </div>

                    <div class="col-md-4 form-group">

                        <label>Ano de expiração</label>
                        <input type="text" class="form-control" name="card_year">

                    </div>

                    <div class="col-md-4 form-group">

                        <label>Código de segurança</label>
                        <input type="text" class="form-control" name="card_ccv">

                    </div>


                </div>


                {{-- Aqui será rendedizado as opções de parcelamento através do javascript --}}
                <div class="form-row form-group installments">


                    <div class="col-md-12">


                    </div>

                </div>


                <div class="form-row form-group">

                    <div class="col-md-12">


                        <button type="button" id="process-checkout" class="btn btn-success btn-lg proccess-checkout">Concluir pagamento</button>

                    </div>

                </div>

            </form>



        </div>



    </div>



</div>



@endsection


@section('scripts')


<script type="text/javascript" src="https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js"></script>

{{-- Aqui foi usado o jquery builder (https://projects.jga.me/jquery-builder/) --}}
<script type="text/javascript" src="{{ asset('assets/js/jquery-ajax.min.js') }}"></script>


<script type="text/javascript">


const SESSION_ID = '{{ session()->get('pagseguroSessionCode') }}';

const CSRF_TOKEN = '{{ csrf_token() }}';

const URL_SUCESSO = '{{ route("checkout.success") }}';

const URL_PROCESS = '{{ route("checkout.process") }}';

const amountTransaction = '{{ $cartSumItens }}';

PagSeguroDirectPayment.setSessionId(SESSION_ID);

</script>

<!-- 
    Para que esses dois arquivos sejam encontrados através do asset(),
    É preciso ferenciá-los no arquivo webpack.mix.js da raiz do projeto
-->
<script type="text/javascript" src="{{ asset('js/pagseguro_functions.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/pagseguro_events.js') }}"></script>


@endsection
