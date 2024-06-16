    <!-- 引入 jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <!-- 引入 Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  $(document).ready(function(){
    var pzemid = @json($pzem->id);
    var num_datarecord = {{count($pzemrecords)}};
    var dataArray = @json($pzemrecords);

    var recordtime = [];
    var Voltage = [];
    var Current = [];
    var Power = [];
    var Energy = [];
    var pzem_PF = [];
    var Frequency = [];


    for(let i = 0; i<num_datarecord; i++){
        Voltage.push(dataArray[i].Voltage);
        Current.push(dataArray[i].Current);
        Power.push(dataArray[i].Power);
        Energy.push(dataArray[i].Energy);
        pzem_PF.push(dataArray[i].PF);
        Frequency.push(dataArray[i].Frequency);
        recordtime.push(dataArray[i].record_time.slice(-14));
    }   

    // Voltage chart
    const Voltage_data = {
      labels: recordtime,
      datasets:[{
        label: 'Voltage',
        backgroundColor: 'rgb(0, 0, 225)',
        borderColor: 'rgb(0, 0, 225)',
        borderWidth: '1',
        pointHoverRadius: '1',
        pointRadius: '1',
        data: Voltage,
      }]
    }
    const Voltage_config = {
      type: 'line',
      data: Voltage_data,
      options: { 
        responsive: true,
        plugins: {
          title: {
            display: false,
            text: 'Voltage'
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
                text: 'Voltage'
              }
            }
          }
        }
      }
    }

    const VoltageChart = new Chart(
      document.getElementById('Voltage_container'),
      Voltage_config
    );

    // Current chart
    const Current_data = {
        labels: recordtime,
        datasets:[{
            label: 'Current',
            backgroundColor: 'rgb(0, 0, 225)',
            borderColor: 'rgb(0, 0, 225)',
            borderWidth: '1',
            pointHoverRadius: '1',
            pointRadius: '1',
            data: Current,
        }]
    }
    const Current_config = {
      type: 'line',
      data: Current_data,
      options: { 
        responsive: true,
        plugins: {
          title: {
            display: false,
            text: 'Current'
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
                text: 'Current'
              }
            }
          }
        }
      }
    }

    const CurrentChart = new Chart(
      document.getElementById('Current_container'),
      Current_config
    );

    // Power chart
    const Power_data = {
      labels: recordtime,
      datasets:[{
        label: 'Power',
        backgroundColor: 'rgb(0, 0, 225)',
        borderColor: 'rgb(0, 0, 225)',
        borderWidth: '1',
        pointHoverRadius: '1',
        pointRadius: '1',
        data: Power,
        }]
    }
    const Power_config = {
      type: 'line',
      data: Power_data,
      options: { 
        responsive: true,
        plugins: {
          title: {
            display: false,
            text: 'Power'
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
                text: 'Power'
              }
            }
          }
        }
      }
    }

    const PowerChart = new Chart(
      document.getElementById('Power_container'),
      Power_config
    );

    // Energy chart
    const Energy_data = {
      labels: recordtime,
      datasets:[{
        label: 'Energy',
        backgroundColor: 'rgb(0, 0, 225)',
        borderColor: 'rgb(0, 0, 225)',
        borderWidth: '1',
        pointHoverRadius: '1',
        pointRadius: '1',
        data: Energy,
      }]
    }
    const Energy_config = {
      type: 'line',
      data: Energy_data,
      options: { 
        responsive: true,
        plugins: {
          title: {
            display: false,
            text: 'Energy'
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
                text: 'Energy'
              }
            }
          }
        }
      }
    }

    const EnergyChart = new Chart(
      document.getElementById('Energy_container'),
      Energy_config
    );

    // pzem_PF chart
    const pzem_PF_data = {
      labels: recordtime,
      datasets:[{
        label: 'PF',
        backgroundColor: 'rgb(0, 0, 225)',
        borderColor: 'rgb(0, 0, 225)',
        borderWidth: '1',
        pointHoverRadius: '1',
        pointRadius: '1',
        data: pzem_PF,
      }]
    }
    const pzem_PF_config = {
      type: 'line',
      data: pzem_PF_data,
      options: { 
        responsive: true,
        plugins: {
          title: {
            display: false,
            text: 'PF'
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
                text: 'PF'
              }
            }
          }
        }
      }
    }

    const pzem_PFChart = new Chart(
      document.getElementById('pzem_PF_container'),
      pzem_PF_config
    );

    // Frequency chart
    const Frequency_data = {
      labels: recordtime,
      datasets:[{
        label: 'Frequency',
        backgroundColor: 'rgb(0, 0, 225)',
        borderColor: 'rgb(0, 0, 225)',
        borderWidth: '1',
        pointHoverRadius: '1',
        pointRadius: '1',
        data: Frequency,
      }]
    }
    const Frequency_config = {
      type: 'line',
      data: Frequency_data,
      options: { 
        responsive: true,
        plugins: {
          title: {
            display: false,
            text: 'Frequency'
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
                text: 'Frequency'
              }
            }
          }
        }
      }
    }

    const FrequencyChart = new Chart(
      document.getElementById('Frequency_container'),
      Frequency_config
    );
      // combined chart
    const combined_data = {
      labels: recordtime,
      datasets: [
        {
          label: 'Voltage',
          backgroundColor: 'rgba(255, 99, 132, 0.2)',
          borderColor: 'rgba(255, 99, 132, 1)',
          borderWidth: 1,
          pointHoverRadius: 1,
          pointRadius: 1,
          data: Voltage,
        },
        {
          label: 'Current',
          backgroundColor: 'rgba(54, 162, 235, 0.2)',
          borderColor: 'rgba(54, 162, 235, 1)',
          borderWidth: 1,
          pointHoverRadius: 1,
          pointRadius: 1,
          data: Current,
        },
        {
          label: 'Power',
          backgroundColor: 'rgba(255, 206, 86, 0.2)',
          borderColor: 'rgba(255, 206, 86, 1)',
          borderWidth: 1,
          pointHoverRadius: 1,
          pointRadius: 1,
          data: Power,
        },
        {
          label: 'Energy',
          backgroundColor: 'rgba(75, 192, 192, 0.2)',
          borderColor: 'rgba(75, 192, 192, 1)',
          borderWidth: 1,
          pointHoverRadius: 1,
          pointRadius: 1,
          data: Energy,
        },
        {
          label: 'PF',
          backgroundColor: 'rgba(153, 102, 255, 0.2)',
          borderColor: 'rgba(153, 102, 255, 1)',
          borderWidth: 1,
          pointHoverRadius: 1,
          pointRadius: 1,
          data: pzem_PF,
        },
        {
          label: 'Frequency',
          backgroundColor: 'rgba(255, 159, 64, 0.2)',
          borderColor: 'rgba(255, 159, 64, 1)',
          borderWidth: 1,
          pointHoverRadius: 1,
          pointRadius: 1,
          data: Frequency,
        }
      ]
    };

    const combined_config = {
      type: 'line',
      data: combined_data,
      options: {
        responsive: true,
        plugins: {
          title: {
            display: true,
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
                text: 'Time'
              }
            },
            y: {
              display: true,
              title: {
                display: true,
                text: 'Value'
              }
            }
          }
        }
      }
    };

    const combinedChart = new Chart(
      document.getElementById('pzem_container'),
      combined_config
    );


  });
  </script>