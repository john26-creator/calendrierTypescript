let input = document.querySelector("input");
async function getInfoFromURL () {
//synchone
let response = await fetch("https://api.openweathermap.org/data/2.5/forecast?q=Londres&appid=591149126204cbadb2da79e751c5cfe8");

if (response.ok) { // if HTTP-status is 200-299
  // get the response body (the method explained below)
  let json = await response.json();
  console.log(json);
} else {
  alert("HTTP-Error: " + response.status);
}
crossOriginIsolated.log("test");
}

// asynchrone

    let ville = input.value;
    fetch(`https://api.openweathermap.org/data/2.5/forecast?q=${ville}&appid=591149126204cbadb2da79e751c5cfe8`)
    .then(result => result.json())
    .then(data => {
        let span = document.querySelector("#value");
        span.innerHTML = data.list[0].weather[0].main;
        console.log(data)}
        );


let button = document.querySelector("button");

button.addEventListener("click", getInfoFromURL);


var ctx = document.getElementById('canvas').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
        datasets: [{
            label: '# of Votes',
            data: [12, 19, 3, 5, 2, 3],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

  