@extends('layouts.app')

@section('content')

    <?php require(app_path().'/financeWebService.php') ?>
    <script type="text/javascript">
        function setvalues(transaction, company, numshares, price, startBal, totalCost, closeBal) {
            Document.getElementById('transactionType').innerHTML = "Transaction Type: " + transaction;
            Document.getElementById('company').innerHTML = "Company: " + company;
            Document.getElementById('numShares').innerHTML = "Number of shares: " + numshares;
            Document.getElementById('price').innerHTML = "Price: " + price;
            Document.getElementById('startBal').innerHTML = "Starting Balance: " + startBal;
            Document.getElementById('totalCost').innerHTML = "Transaction Cost:" + totalCost;
            Document.getElementById('closeBal').innerHTML = "Closing Balance: " + closeBal;
        }
    </script>

    <?php

        print_r ($info);
            // echo ('<script type = "text/javascript">setvalues(' . $info->transaction . ',' . $info->company . ',' . $info->numberShares. ',' . $info->price . ',' . $info->startBalance . ',' . $info->totalCost . ',' . $info->closeBalance . ');</script>');


    ?>

    <div id="body">
        <div class="container">
            <div class="col-md-12 content-left">
                <div class="contact-form wow fadeInUp animated">
                    <h3><b>Transaction Summary</b></h3><br>
                    Transaction Type:
                    <br />
                    Company:
                    <br />
                    Number of Shares purcahsed:
                    <br />
                    Price:
                    <br /><br />
                    Starting Balance:
                    <br />
                    Transaction Cost:
                    <br />
                    Closing Balance:
                    <br /> <br />

                    <form action = "{{ url ('/dashboard') }}" method = "POST" style = "display:inline-block">
                        <button type="submit" class="btn btn-primary">Return to Dashboard</button>
                        {{csrf_field()}}
                    </form>
                    <form action = "{{ url ('/transactions') }}" method = "post" style = "display:inline-block">
                        <button type="submit" class="btn btn-primary">Return to Transactions</button>
                        {{csrf_field()}}
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
