@extends('layouts.app')

@section('content')
<div id="pzem">
    <div class="button">
        <button onclick = "goBack()" class = "btn btn-primary">Go Back</button>
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
            <canvas id="pzem_container" class="col-sm-12" height="300px"></canvas>
        </div>
    </div>
    <div class="row py-1">
        <div class="col">
            <canvas id="Voltage_container" class="col-sm-12" height="100px" style = "display: none;"></canvas>
        </div>
    </div>
    <div class="row py-1">
        <div class="col">
            <canvas id="Current_container" class="col-sm-12" height="100px" style = "display: none;"></canvas>
        </div>
    </div>
    <div class="row py-1">
        <div class="col">
            <canvas id="Power_container" class="col-sm-12" height="100px" style = "display: none;"></canvas>
        </div>
    </div>
    <div class="row py-1">
        <div class="col">
            <canvas id="Energy_container" class="col-sm-12" height="100px" style = "display: none;"></canvas>
        </div>
    </div>
    <div class="row py-1">
        <div class="col">
            <canvas id="pzem_PF_container" class="col-sm-12" height="100px" style = "display: none;"></canvas>
        </div>
    </div>
    <div class="row py-1">
        <div class="col">
            <canvas id="Frequency_container" class="col-sm-12" height="100px" style = "display: none;"></canvas>
        </div>
    </div>
</div>

@extends('layouts.pzemchart')
@endsection 

@section('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var showFewerRadio = document.getElementById("few");
        var showAllRadio = document.getElementById("all");

        showFewerRadio.addEventListener("change", function() {
            document.getElementById("pzem_container").style.display = "block";
            document.getElementById("Voltage_container").style.display = "none";
            document.getElementById("Current_container").style.display = "none";
            document.getElementById("Power_container").style.display = "none";
            document.getElementById("Energy_container").style.display = "none";
            document.getElementById("pzem_PF_container").style.display = "none";
            document.getElementById("Frequency_container").style.display = "none";
        });

        showAllRadio.addEventListener("change", function() {
            document.getElementById("pzem_container").style.display = "none";
            document.getElementById("Voltage_container").style.display = "block";
            document.getElementById("Current_container").style.display = "block";
            document.getElementById("Power_container").style.display = "block";
            document.getElementById("Energy_container").style.display = "block";
            document.getElementById("pzem_PF_container").style.display = "block";
            document.getElementById("Frequency_container").style.display = "block";

            // Adjust canvas height dynamically
            var chartCanvases = document.querySelectorAll('.chart-canvas');
            chartCanvases.forEach(function(canvas) {
                canvas.height = 300; // Set the desired height here
            });
        });
    });

    function goBack (){
        window.history.back();
    }
</script>

<style>
        .button{
        display: flex;
        margin-top: 100px;
        /* justify-content: center; */
        align-items: center;

    }

    .form-check {
        margin-left: 20px;
    }
</style>
@endsection