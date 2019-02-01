// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#292b2c';

$(document).ready(function(){

	$.ajax({
		url: issuedPerMonthURL,
		type: 'GET',
		dataType: 'json',
		data: {param1: 'value1'},
		success:function(result){
			issuedPerMonthChart(result);
		}
	});

});

function issuedPerMonthChart(data)
{
	var ctx = document.getElementById("issuedPerMonthChart");
	var myLineChart = new Chart(ctx, {
		type: 'bar',
		data: {
			labels: data['labels'],
			datasets: [{
				label: "Issued Books",
				backgroundColor: "rgba(2,117,216,1)",
				borderColor: "rgba(2,117,216,1)",
				data: data['datas'],
			}],
		},
		options: {
			scales: {
				xAxes: [{
					time: {
						unit: 'month'
					},
					gridLines: {
						display: false
					},
					ticks: {
						maxTicksLimit: 6
					}
				}],
				yAxes: [{
					ticks: {
						min: 0,
						max: data['max'],
						maxTicksLimit: 5
					},
					gridLines: {
						display: true
					}
				}],
			},
			legend: {
				display: false
			}
		}
	});
}
