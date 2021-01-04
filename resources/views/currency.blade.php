@extends('layouts.second')

@section('content')
    <div class="container mt-5" style="font-family: Montserrat">
        <div class="currency">
            <h2 class="text-center"><i class="fas fa-exchange-alt mr-2"></i>Exchange rates</h2>
            <div class="row justify-content-center mt-5">

                <select id="from_currency" class="custom-select col-1"></select>
                <input type="text" class="form-control col-3" id="from_amount" placeholder="0">
            </div>

            <div class="row justify-content-center my-4">
                <div class="middle">
                    <button id="exchange" class="btn btn-block btn-success"><i class="fas fa-exchange-alt"></i></button>
                    <div class="rate" id="rate"></div>
                </div>
            </div>

            <div class="currency">
                <div class="row justify-content-center">
                    <select id="to_currency" class="custom-select col-1"> </select>
                    <input type="text" class="form-control col-3" id="to_amount" placeholder="0"/>
                </div>
            </div>
        </div>

        <script>
            var rates = @json($rates);
            var from_currencyEl = $('#from_currency');
            var from_amountEl = $('#from_amount');
            var to_currencyEl = $('#to_currency');
            var to_amountEl = $('#to_amount');
            var rateEl = $('#rate');
            var exchange = $('#exchange');


            from_currencyEl.on('change', calculate);
            from_amountEl.on('input', calculate);
            to_currencyEl.on('change', calculate);
            to_amountEl.on('input', calculate);


            exchange.on('click', function () {
                let tmp = from_currencyEl.val();
                from_currencyEl.val(to_currencyEl.val());
                to_currencyEl.val(tmp);
                calculate();
            });


            function initCurrencies() {
                $.each(rates, function (code, rates) {
                    from_currencyEl.append('<option value="' + code + '">' + code + '</option>');
                    to_currencyEl.append('<option value="' + code + '">' + code + '</option>');
                });
            }

            initCurrencies();

            function calculate() {
                let from_currency = from_currencyEl.val();
                let to_currency = to_currencyEl.val();
                let rate = rates[from_currency][to_currency];
                rateEl.html(`1 ${from_currency} = ${rate} ${to_currency}`);
                let current_val = from_amountEl.val();
                if(!current_val) current_val = 0;
                to_amountEl.val((parseFloat(current_val) * rate).toFixed(2));
            }

            calculate();
        </script>
@endsection
