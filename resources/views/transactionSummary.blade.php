@extends('layouts.app')

@section('content')

    <?php require(app_path().'/financeWebService.php') ?>
    <script type="text/javascript"></script>

    <?php
        if(isset($_POST)&&!empty($_POST)) {
            $info = $_POST['info'];
        }

        // echo ("Company Name:" . $info->company);
        // echo ("Units Bought:" . $info->numPurchased);
        // echo ("Price:" . $info->price);


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
                    <br />
                </div>
            </div>
        </div>
    </div>
@endsection
