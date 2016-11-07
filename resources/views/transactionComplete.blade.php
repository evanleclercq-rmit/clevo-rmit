@extends('layouts.app')

@section('content')

    <?php require(app_path().'/financeWebService.php') ?>
    <script type="text/javascript">

    <?php
        $info;

        echo ("Company Name:" . $info->company);
        echo ("Units Bought:" . $info->numPurchased);
        echo ("Price:" . $info->price);


    ?>