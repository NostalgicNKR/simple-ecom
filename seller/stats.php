<?php $titleOfPage = "Statistics"; ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<div class="container p-5">
	<div class="row">
	  <div class="col-sm-4">
		<div class="card bg-secondary text-center">
		  <div class="card-body text-white">
			<h1 class="card-title"><?= $ordersData[2] ?></h1>
			<p class="card-text">Delivered Orders</p>
		  </div>
		</div>
	  </div> 
	  <div class="col-sm-4">
		<div class="card bg-primary text-center">
		  <div class="card-body text-white">
			<h1 class="card-title">&#8377; <?= (isset($pendingEarnings)) ? formatCurrencyINR($pendingEarnings) : 0; ?></h1>
			<p class="card-text">Pending Earnings</p>
		  </div>
		</div>
	  </div>
	  <div class="col-sm-4">
		<div class="card bg-success text-center">
		  <div class="card-body text-white">
			<h1 class="card-title">&#8377; <?= (isset($totalEarnings)) ? formatCurrencyINR($totalEarnings) : 0 ?></h1>
			<p class="card-text">Confirmed Earnings</p>
		  </div>
		</div>
	  </div>
	</div>
	
<div class="d-flex justify-content-center">
	  <canvas id="ordersChart" style="width:100%;max-width:800px"></canvas>
	  <canvas id="earningsChart" style="width:100%;max-width:800px"></canvas>
</div>


	
</div>
<script>

var xValues = ["Confirmed", "Shipped", "Delivered", "Returned", "Cancelled by buyer", "Cancelled by seller"];
var yValues = [<?= $ordersData[0] .",". $ordersData[1] .",". $ordersData[2] .",". $ordersData[3] .",". $ordersData[4] .",". $ordersData[5] ?>];
var barColors = [
  "#36a2eb",
  "#ffcd56",
  "#4bc0c0",
  "#ff6384",
  "#9966ff",
   "#ff9f40",
];

new Chart("ordersChart", {
  type: "pie",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    title: {
      display: true,
      text: "Orders Data"
    },
	layout: {
             padding: {
                top: 50,
				left: 120,
            }
			
        }
  }
});

new Chart("earningsChart", {
  type: "pie",
  data: {
    labels: ["confirmed", "shipped", "delivered"],
    datasets: [{
      backgroundColor: barColors,
      data: [<?= $onlyConfirmedEarnings.",".$onlyShippedEarnings.",".$totalEarnings ?>],
    }]
  },
  options: {
    title: {
      display: true,
      text: "Earnings (INR)"
    },
	layout: {
             padding: {
                top: 50,
            }
			
        }
  }
});
</script>