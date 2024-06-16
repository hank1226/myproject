<!-- jquery link and CSS ------------------------------------------------->
<script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
{{-- HighCharts --}}
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-more.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<script type='text/javascript'>
    var update = function() {
        $.ajax({
            type: 'GET',
            url: '{{url('/')}}/sensors',
            dataType: 'json',
            success: function(records) {
                console.log('Received records:', records);
                // dhtrecords
                for (let i = 0; i < records[0].length; i++) {
                    var dht = records[0][i];
                    var temperatureId = "dhtrecord" + dht["fk_id"] + "-temperature";
                    var humidityRateId = "dhtrecord" + dht["fk_id"] + "-humidity_rate";
                    var recordtime = "dhtrecord" + dht["fk_id"] + "-recordtime";

                    var temperatureElement = document.getElementById(temperatureId);
                    var humidityRateElement = document.getElementById(humidityRateId);
                    var recordtimeElement = document.getElementById(recordtime);

                    if (temperatureElement && humidityRateElement) {
                        temperatureElement.innerHTML = "Temperature: " + (dht["temperature"] || "N/A");
                        humidityRateElement.innerHTML = "Humidity Rate: " + (dht["humidity_rate"] || "N/A");
                        recordtimeElement.innerHTML = (dht["record_time"] || "N/A");
                    }
                }
                // pzemrecords
                for (let e = 0; e < records[1].length; e++) {
                    var pzem = records[1][e];

                    var VoltageId = "pzemrecord" + pzem["fk_id"] + "-Voltage";
                    var CurrentId = "pzemrecord" + pzem["fk_id"] + "-Current";
                    var PowerId = "pzemrecord" + pzem["fk_id"] + "-Power";
                    var EnergyId = "pzemrecord" + pzem["fk_id"] + "-Energy";
                    var PfId = "pzemrecord" + pzem["fk_id"] + "-PF";
                    var FrequencyId = "pzemrecord" + pzem["fk_id"] + "-Frequency";
                    var recordtime = "pzemrecord" + pzem["fk_id"] + "-recordtime";

                    var VoltageElement = document.getElementById(VoltageId);
                    var CurrentElement = document.getElementById(CurrentId);
                    var PowerElement = document.getElementById(PowerId);
                    var EnergyElement = document.getElementById(EnergyId);
                    var PfElement = document.getElementById(PfId);
                    var FrequencyElement = document.getElementById(FrequencyId);
                    var recordtimeElement = document.getElementById(recordtime);

                    // 確保元素存在再進行設置
                    if (VoltageElement) VoltageElement.innerHTML = "Voltage: " + (pzem["Voltage"] || "N/A");
                    if (CurrentElement) CurrentElement.innerHTML = "Current: " + (pzem["Current"] || "N/A");
                    if (PowerElement) PowerElement.innerHTML = "Power: " + (pzem["Power"] || "N/A");
                    if (EnergyElement) EnergyElement.innerHTML = "Energy: " + (pzem["Energy"] || "N/A");
                    if (PfElement) PfElement.innerHTML = "PF: " + (pzem["PF"] || "N/A");
                    if (FrequencyElement) FrequencyElement.innerHTML = "Frequency: " + (pzem["Frequency"] || "N/A");
                    if (recordtimeElement) recordtimeElement.innerHTML = (pzem["record_time"] || "N/A");
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error fetching data:', textStatus, errorThrown);
            }
        });
    };
    
    setInterval(update, 5000);
    update();
</script>
