@extends('layouts.app')

@section('content')

    <?php require(app_path().'/financeWebService.php') ?>

    <?php

        $feeExplain = "";
        $sharesDesc = "";

        if ($info['transaction'] == "Sale") {
            $feeExplain = "    ($50 Transaction fee plus 0.25% of sale price)";
            $sharesDesc = "Number of Shares Sold: ";
        } else {
            $feeExplain = "    ($5o Transaction fee plus 1% of purchase price)";
            $sharesDesc = "Number of Shares Purchased: ";
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

                    <table id = "summaryTable">

                        <tr>
                            <td>Company Symbol: </td>
                            <td><?php echo ($info['companySymbol']); ?></td>
                        </tr>

                        <tr>
                            <td>Company Name: </td>
                            <td><?php echo($info['companyName']); ?></td>
                        </tr>
                        <tr>
                            <td><?php echo ($sharesDesc) ?></td>
                            <td><?php echo ($info['numberShares']); ?></td>
                        </tr>

                        <tr>
                            <td>Unit Price: </td>
                            <td><?php echo ("$" . $info['price']); ?></td>
                        </tr>

                        <tr>
                            <td>Starting Balance: </td>
                            <td><?php echo ("$" . $info['startBalance']); ?></td>
                        </tr>

                        <tr>
                            <td>Transaction Cost: </td>
                            <td><?php echo ("$" . $info['totalCost']); ?></td>
                        </tr>

                        <tr>
                            <td>Transaction Fees: </td>
                            <td><?php echo ("$" . $info['fee']); ?></td>
                        </tr>

                        <tr>
                            <td>Closing Balance: </td>
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
