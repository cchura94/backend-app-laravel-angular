<h1 class="titulo">Lista Pedidos</h1>
<table border="1">
    <tr>
        <td>ID</td>
        <td>FECHA PEDIDO</td>
        <td>CLIENTE</td>
        <td>ESTADO</td>
    </tr>
    @foreach ($pedidos as $p)
    <tr>
        <td>{{ $p->id }}</td>
        <td>{{ $p->fecha_pedido }}</td>
        <td>{{ $p->cliente->nombre_completo }}</td>
        <td>{{ ($p->estado == 1)?'PENDIENTE':'COMPLETADO' }}</td>
    </tr>    
    @endforeach

</table>

<style>
    .titulo{
        color: blue;
    }
</style>

<img width="400px" src="https://quickchart.io/chart?c={type:'bar',data:{labels:[2012,2013,2014,2015,2016],datasets:[{label:'Users',data:[120,60,50,180,120]}]}}" alt="">



<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.8.0/chart.js"></script>

<canvas id="myChart" width="400" height="400"></canvas>
<script>
const ctx = document.getElementById('myChart').getContext('2d');
const myChart = new Chart(ctx, 
{
  type: 'bar',                                // Show a bar chart
  data: {
    labels: [2012, 2013, 2014, 2015, 2016],   // Set X-axis labels
    datasets: [{
      label: 'Users',                         // Create the 'Users' dataset
      data: [120, 60, 50, 180, 120]           // Add data to the chart
    }]
  }
});
</script>