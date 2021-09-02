function getColor (indicator, value) {
	var result = "";
	switch (indicator) {
		case "SEP" :  {
			if (value < 17) 
				result = 'rgb(0, 128, 0)';
			else if (value < 29) 
				result = 'rgb(240, 195, 0)';
			else
				result = 'rgb(223, 109, 20)';
		}
		break;
		case "SAP" : {
			if (value > 33) 
				result = 'rgb(0, 128, 0)';
			else if (value > 39) 
				result = 'rgb(240, 195, 0)';
			else
				result = 'rgb(223, 109, 20)';
		}
		break;
		case "SD" :  {
			if (value < 5) 
				result = 'rgb(0, 128, 0)';
			else if (value < 11) 
				result = 'rgb(240, 195, 0)';
			else
				result = 'rgb(223, 109, 20)';
		}
		break; 
	}
	return result;
}

function setPolarChart (datas) {

	var randomScalingFactor = function() {
		return Math.round(Math.random() * 100);
	};

		var chartColors = window.chartColors;
		var color = Chart.helpers.color;
		var config = {
			type: 'polarArea',
			data: {
				datasets: [{
					data: [
						1,
						1,
						1,
					],
					backgroundColor: [
						color(getColor ('SEP', datas["sep"])).alpha(0.5).rgbString(),
						color(getColor ('SAP', datas["sap"])).alpha(0.5).rgbString(),
						color(getColor ('SD', datas["sd"])).alpha(0.5).rgbString(),
					],
					label: 'My dataset' // for legend
				}],
				labels: [
					'Sydrome d\'épuisement professionnel ' + datas["sep"],
					'Accomplissement Personnel ' + datas["sap"],
					'Depersonnalisation ' + datas["sd"]
				]
			},
			options: {
				responsive: true,
				legend: {
					position: 'right',
				},
				title: {
					display: true,
					text: 'MBI'
				},
				scale: {
					ticks: {
						beginAtZero: true
					},
					reverse: false
				},
				animation: {
					animateRotate: false,
					animateScale: true
				}
			}
		};

		 $("#mainContainer").html('<canvas id="chart"></canvas><br/><br/>');

		 var ctx = document.getElementById('chart').getContext('2d');
		 window.myPolarArea = new Chart(ctx, config);
}

function setChart6 (global, stress, anxiete, energie, sommeil, digestion, title, indicator, dropDown = false, selectedValue=0) {
	var lineChartData = {
		labels: global[0].label,
		datasets: [{
			label: "Bien-être",
			borderColor: 'rgb(34, 177, 76)',
			backgroundColor: 'rgb(34, 177, 76)',
			fill: false,
			data: global[0].values,
		},{
			label: "Stress",
			borderColor: 'rgb(150, 16, 57)',
			backgroundColor: 'rgb(150, 16, 57)',
			fill: false,
			data: stress[0].values,
		},{
			label: "Anxiete",
			borderColor: 'rgb(228, 48, 90)',
			backgroundColor: 'rgb(228, 48, 90)',
			fill: false,
			data: anxiete[0].values,
		},{
			label: "Energie",
			borderColor: 'rgb(255, 188, 0)',
			backgroundColor: 'rgb(255, 188, 0)',
			fill: false,
			data: energie[0].values,
		},{
			label: "Sommeil",
			borderColor: 'rgb(41, 1, 106)',
			backgroundColor: 'rgb(41, 1, 106)',
			fill: false,
			data: sommeil[0].values,
		},{
			label: "Digestion",
			borderColor: 'rgb(0, 164, 236)',
			backgroundColor: 'rgb(0, 164, 236)',
			fill: false,
			data: digestion[0].values,
		}]
	};

	$("#mainContainer").empty();
	$("#mainContainer").append('<canvas id="chart"></canvas><br/><br/>');

	var ctx = document.getElementById('chart').getContext('2d');
	window.myLine = new Chart(ctx, {
		type: 'line',
		data: lineChartData,
		options: {
			responsive: true,
			title: {
				display: true,
				text: title
			},
			tooltips: {
				mode: 'index',
				intersect: false,
			},
			hover: {
				mode: 'nearest',
				intersect: true
			},
			scales: {
				x: {
					display: true,
					scaleLabel: {
						display: true,
						labelString: 'Month'
					}
				},
				y: {
					display: true,
					scaleLabel: {
						display: true,
						labelString: 'Value'
					}
				}
			}
		}
	});
}


function setCharts (global, stress, title, indicator, dropDown = false, selectedValue=0) {
	var lineChartData = {
		labels: global[0].label,
		datasets: [{
			label: "Bien-être",
			borderColor: 'rgb(255, 99, 132)',
			backgroundColor: 'rgb(255, 99, 132)',
			fill: false,
			data: global[0].values,
		},{
			label: "Stress",
			borderColor: 'rgb(0, 164, 236)',
			backgroundColor: 'rgb(0, 164, 236)',
			fill: false,
			data: stress[0].values,
		}]
	};



	$("#mainContainer").empty();
	if (dropDown) {
		$("#mainContainer").append(divisionDropDowList(indicator,selectedValue));
	}

	$("#mainContainer").append('<canvas id="chart"></canvas><br/><br/>');

	var ctx = document.getElementById('chart').getContext('2d');
	window.myLine = new Chart(ctx, {
		type: 'line',
		data: lineChartData,
		options: {
			responsive: true,
			title: {
				display: true,
				text: title
			},
			tooltips: {
				mode: 'index',
				intersect: false,
			},
			hover: {
				mode: 'nearest',
				intersect: true
			},
			scales: {
				x: {
					display: true,
					scaleLabel: {
						display: true,
						labelString: 'Month'
					}
				},
				y: {
					display: true,
					scaleLabel: {
						display: true,
						labelString: 'Value'
					}
				}
			}
		}
	});
}

function setBarChart (datas, indicator, dropDown = false, selectedValue=0) {
	var barChartData = {
			labels: ['Epuisement professionnel', 'Accomplissement Personnel', 'Depersonnalisation'],
			datasets: [{
				label: 'Favorables',
				backgroundColor: 'rgb(0, 128, 0)',
				stack: 'Epuisement professionnel',
				data: datas.data1
			}, {
				label: 'A surveiller',
				backgroundColor: 'rgb(240, 195, 0)',
				stack: 'Accomplissement Personnel',
				data: datas.data2
			}, {
				label: 'Trés importants',
				backgroundColor: 'rgb(204, 85, 0)',
				stack: 'Depersonnalisation',
				data: datas.data3
			}, {
				label: 'Non repondu',
				backgroundColor: 'rgb(100,149,237)',
				stack: 'non repondu',
				data: datas.data4
			}]

		};

		$("#mainContainer").empty();
		if (dropDown) {
			$("#mainContainer").append(divisionDropDowList(indicator, selectedValue));
		}

		$("#mainContainer").append('<canvas id="chart"></canvas><br/><br/>'); 

		var ctx = document.getElementById('chart').getContext('2d');

		window.myBar = new Chart(ctx, {
			type: 'bar',
			data: barChartData,
			options: {
				title: {
					display: true,
					text: 'Bilan MBI Entreprise'
				},
				tooltips: {
					mode: 'index',
					intersect: false
				},
				responsive: true,
				scales: {
					x: {
						stacked: true,
					},
					y: {
						stacked: true
					}
				}
			}
		});

	}

function verifyform() {
	if ($('#motdepasse').val() != $('#confirmation').val()) {
		$('#mainContainer').html("Le mot de passe et sa confirmation ne sont pas identiques");
		return false;
	} 
	if ($('#motdepasse').val().length <8 || $('#confirmation').val() <8) {
		$('#mainContainer').html("Le mot de passe est trop court");
		return false;
	}
	if (!$('#motdepasse').val().match(/(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/)) {
		$('#mainContainer').html("");
		return false;
	}
	else {
		return true;
	}
}
