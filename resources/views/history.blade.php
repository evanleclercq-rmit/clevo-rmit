<!--

Blade for the transaction history
www.clevo-rmit.space/public/history

Contains interface to view list of transactions with ability to sort and filter by date

-->

@extends('layouts.app')

@section('content')
<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" />
<link href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css" />
<script src="js/jquery-ui.min.js"></script>
<script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/jquery.dataTables.min.js"></script>
<script src="js/jquery.dataTables.yadcf.js"></script>

<script>

$(document).ready(function () {
    'use strict';
    oTable = $('#history').dataTable({
        "sScrollY": "300px",
        "iDisplayLength": 25,
        "bJQueryUI": false,
        "bStateSave": true,
        "sDom": 'rt'
    }).yadcf([{
        column_number: 0,
        filter_type: "range_date",
        filter_container_id: "external_filter_container",
        date_format: "dd/mm/yyyy",
        filter_reset_button_text: "Reset"
    }]);
});
</script>

<div id="body"> 
    <div class="container">
        <div class="col-md-12 content-left" >
            <div class="contact-form wow fadeInUp animated" id="holdings" data-wow-delay=".1s" >
                <h3><b>Transaction History</b></h3><br>
                <p>Select a date range: 
                <div id="external_filter_container"></div>
                <table id='history' class="table table-striped table-bordered" style="width:100%"  >
                <thead><tr><td><b>Date</td><td><b>Type</td><td><b>Company</td><td><b>Units Traded</td><td><b>Price Per Unit</td><td><b>Total Price</td></tr></thead>
        
                <?php 
                    foreach ($history as $transaction) {
                    echo 
                    "<tr><td>".$transaction['date']. "</td>
                    <td>".$transaction['type']. "</td> 
                    <td>".$transaction['symbol']. "</td> 
                    <td>".$transaction['number']."</td>
                    <td>$".$transaction['price']."</td>
                    <td>$".$transaction['total']."</td>
                    </tr>";
                    }
                ?>             
                </table>
            </div>
        </div>
    </div> <!--container-->
</div> <!--body-->
 @endsection