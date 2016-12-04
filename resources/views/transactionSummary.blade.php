<!--

Blade for the transaction summary

Contains a summary of the transaction

-->
@extends('layouts.app')

@section('content')

    <?php require(app_path().'/financeWebService.php') ?>

    <?php

        $feeExplain = "";
        $sharesDesc = "";

        if ($info['transaction'] == "Sale") {
            $feeExplain = "    ($50 Transaction fee plus 0.25% of sale price)";
            $sharesDesc = "Number of Shares Sold: ";
            $costOrProfit = "Total profit: ";
        } else {
            $feeExplain = "    ($5o Transaction fee plus 1% of purchase price)";
            $sharesDesc = "Number of Shares Purchased: ";
            $costOrProfit = "Total cost: ";

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

                    <table id = "summaryTable" style="width:60%">

                        <tr>
                            <td><b>Company Name: </td>
                            <td><?php echo($info['companyName']); ?></td>
                        </tr>

                        <tr>
                            <td><b>Company Symbol: </td>
                            <td><?php echo ($info['companySymbol']); ?></td>
                        </tr>

                        <tr>
                            <td><b>Starting Balance: </td>
                            <td><?php echo ("$" . $info['startBalance']); ?></td>
                        </tr>

                        <tr> 
                            <td><b><?php echo ($sharesDesc) ?></td>
                            <td><?php echo ($info['numberShares']); ?></td>
                        </tr>

                        <tr>
                            <td><b>Unit Price: </td>
                            <td><?php echo ("$" . $info['price']); ?></td>
                        </tr>

                        <tr>
                            <td><b>Share Value: </td>
                            <td><?php echo ("$" . $info['shareValue']); ?></td>
                        </tr>

                        <tr>
                            <td><b>Transaction Fee: </td>
                            <td><?php echo ("$" . $info['fee']); ?></td>
                        </tr>

                        <tr>
                            <td><b><?php echo ($costOrProfit) ?></td>
                            <td><?php echo ("$" . $info['totalCost']); ?></td>
                        </tr>

                        <tr>
                            <td><b>Closing Balance: </td>
                            <td><?php echo ("$" . $info['closeBalance']); ?></td>
                        </tr>

                    </table>

                    <br><br>

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
