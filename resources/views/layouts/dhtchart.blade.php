    <!-- 引入 jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <!-- 引入 Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  $(document).ready(function(){
    var dhtid = @json($dht->id);
    var num_datarecord = {{count($dhtrecords)}};
    var dataArray = @json($dhtrecords);

    var dht_Temperature = [];
    var dht_Humidity_rate = [];
    var dht_recordtime = [];

    for(let i = 0; i<num_datarecord; i++){
      dht_Temperature.push(dataArray[i].temperature);
      dht_Humidity_rate.push(dataArray[i].humidity_rate);
      dht_recordtime.push(dataArray[i].record_time.slice(-14));
    }   
    const dhtTem_data = {
      labels: dht_recordtime,
      datasets:[{
        label: 'temperature',
        backgroundColor: 'rgb(0, 0, 225)',
        borderColor: 'rgb(0, 0, 225)',
        borderWidth: '1',
        pointHoverRadius: '1',
        pointRadius: '1',
        data: dht_Temperature,
      }]
    }
    const dhtTem_config = {
      type: 'line',
      data: dhtTem_data,
      options: { 
        responsive: true,
        plugins: {
          title: {
            display: false,
            text: 'temperature'
          },
          interaction: { 
            mode: 'index',
            intersect: false
          },
          scales: {
            x: {
              display: true,
              title: {
                display: true,
                text: 'time'
              }
            },
            y: {
              display: true,
              title: {
                display: true,
                text: 'temperature'
              }
            }
          }
        }
      }
    }

    const dht_TemperatureChart = new Chart(
      document.getElementById('dht_Temperature_container'),
      dhtTem_config
    );

    // dht Humidity_rate chart
    const dhtHumi_data = {
      labels: dht_recordtime,
      datasets:[{
        label: 'Humidity_rate',
        backgroundColor: 'rgb(0, 0, 225)',
        borderColor: 'rgb(0, 0, 225)',
        borderWidth: '1',
        pointHoverRadius: '1',
        pointRadius: '1',
        data: dht_Humidity_rate,
      }]
    }
    const dhtHumi_config = {
      type: 'line',
      data: dhtHumi_data,
      options: { 
        responsive: true,
        plugins: {
          title: {
            display: false,
            text: 'Humidity_rate'
          },
          interaction: { 
            mode: 'index',
            intersect: false
          },
          scales: {
            x: {
              display: true,
              title: {
                display: true,
                text: 'time'
              }
            },
            y: {
              display: true,
              title: {
                display: true,
                text: 'Humidity_rate'
              }
            }
          }
        }
      }
    }

    const dht_Humidity_rateChart = new Chart(
      document.getElementById('dht_Humidity_rate_container'),
      dhtHumi_config
    );

    // combined chart
    const dht_data = {
      labels: dht_recordtime,
      datasets: [{
          label: 'Temperature',
          backgroundColor: 'rgb(255, 99, 132)',
          borderColor: 'rgb(255, 99, 132)',
          data: dht_Temperature,
          yAxisID: 'temperature',
        },
        {
          label: 'Humidity Rate',
          backgroundColor: 'rgb(54, 162, 235)',
          borderColor: 'rgb(54, 162, 235)',
          data: dht_Humidity_rate,
          yAxisID: 'humidity',
        }
      ]
    };

    const dht_config = {
      type: 'line',
      data: dht_data,
      options: {
        responsive: true,
        plugins: {
          title: {
            display: false,
          },
          interaction: {
            mode: 'index',
            intersect: false,
          },
        },
        scales: {
          x: {
            display: true,
            title: {
              display: true,
              text: 'Time',
            },
          },
          temperature: {
            display: true,
            position: 'left',
            title: {
              display: true,
              text: 'Temperature',
            },
          },
          humidity: {
            display: true,
            position: 'right',
            title: {
              display: true,
              text: 'Humidity Rate',
            },
            grid: {
              drawOnChartArea: false,
            },
          },
        },
      },
    };

    const dht_chart = new Chart(
      document.getElementById('dht_container'),
      dht_config
    );
  });
  </script>