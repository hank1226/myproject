@extends('layouts.app')

@section('content')
<div id="dht">
    <div class="button">
        <button onclick="goBack()" class = "btn btn-primary">Go Back</button>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="showOption" id="few" value="fewer" checked>
            <label class="form-check-label" for="few">Show Fewer</label>
        </div>
        
        <div class="form-check">
            <input class="form-check-input" type="radio" id="all" name="showOption" value="all">
            <label class="form-check-label" for="all">Show All</label>
        </div>
    </div>

    <div class="row py-1">
        <div class="col">
            <canvas id="dht_container" class="col-sm-12 chart-canvas" height="300px"></canvas>
        </div>
    </div>
    <div class="row py-1">
        <div class="col">
            <canvas id="dht_Temperature_container" class="col-sm-12 chart-canvas" height = "100px" style="display:none;"></canvas>
        </div>
    </div>
    <div class="row py-1">
        <div class="col">
            <canvas id="dht_Humidity_rate_container" class="col-sm-12 chart-canvas" height = "100px" style="display:none;"></canvas>
        </div>
    </div>
</div>

@extends('layouts.dhtchart')
@endsection 

@section('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var showFewerRadio = document.getElementById("few");
        var showAllRadio = document.getElementById("all");

        showFewerRadio.addEventListener("change", function() {
            document.getElementById("dht_container").style.display = "block";
            document.getElementById("dht_Temperature_container").style.display = "none";
            document.getElementById("dht_Humidity_rate_container").style.display = "none";
        });

        showAllRadio.addEventListener("change", function() {
            document.getElementById("dht_container").style.display = "none";
            document.getElementById("dht_Temperature_container").style.display = "block";
            document.getElementById("dht_Humidity_rate_container").style.display = "block";
            var chartCanvases = document.querySelectorAll('.chart-canvas');
            chartCanvases.forEach(function(canvas) {
                canvas.height = 300; 
            });
        });
    });

    function goBack() {
            window.history.back();
        }
</script>

<style>
    .button{
        display: flex;
        margin-top: 100px;
        align-items: center;
    }

    .form-check {
        margin-left: 20px;
    }
</style>

@endsection
