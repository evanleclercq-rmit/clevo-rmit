@extends('layouts.app')

@section('content')

    <?php require(app_path().'/financeWebService.php') ?>

    <?php

        $feeExplain = "";

        if ($info['transaction'] == "Sale") {
            $feeExplain = "    ($50 Transaction fee plus 0.25% of sale price)";
        } else {
            $feeExplain = "    ($5o Transaction fee plus 1% of purchase price)";
        }

        function determineTransaction ($info) {
            if ($info['transaction'] == "Sale") {
                return "Number of Shares Sold: " . $info['numberShares'];
            } else {
                return "Number of Shares Purchased: " . $info['numberShares'];
            }
        }

    ?>

    <div id="body">
        <div class="container">
            <div class="col-md-12 content-left">
                <div class="contact-form wow fadeInUp animated">
                    <h3><b>Transaction Summary</b></h3><br>
                    <?php echo ("Transaction Type: " . $info['transaction']); ?>
                    <br />
                    <?php echo ("Company: " . $info['companySymbol'] . " - " . $info['companyName']); ?>
                    <br />
                    <?php echo (determineTransaction($info)); ?>
                    <br />
                    <?php echo ("Unit Price: $" . $info['price']); ?><i> to add 1% during purchase or deduct 0.25% during sell </i>
                    <br /><br />
                    <?php echo ("Starting Balance: $" . $info['startBalance']); ?>
                    <br />
                    <?php echo ("Transaction Cost: $" . $info['totalCost']); ?>
					<br />
                    <?php echo ("Transaction Fees: $" . $info['fee'] . $feeExplain); ?>
                    <br />
                    <?php echo ("Closing Balance: $" . $info['closeBalance']); ?>
                    <br /> <br />

                    <form action = "{{ url('/dashboard') }}" method = "POST" style = "display:inline-block">
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
