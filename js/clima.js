/*
document.getElementById('city').addEventListener('input', function () {
    var city = this.value;
    getWeather(city);
  });
*/

function consultarClima() {
    const cityInput = document.getElementById('city'); 
    const city = cityInput.value || 'Santiago de Cali'; 
    getWeather(city);
}

async function getWeather(city) {
    try {
        console.log('Nombre de ciudad:', city);

        const response = await axios.get('https://api.openweathermap.org/data/2.5/forecast', {
            params: {
                q: city,
                appid: '54a57bc234ad752a4f59e59cd372201d',
                units: 'metric',
                lang: 'es' // Cambia a minúsculas para asegurar consistencia
            },
        });

        const currentTemperature = response.data.list[0].main.temp;
        updateWeatherUI(response.data, currentTemperature);
    } catch (error) {
        handleError(error);
    }
}

function updateWeatherUI(data, currentTemperature) {
    const dailyForecast = {};
    data.list.forEach((item) => {
        const day = new Date(item.dt * 1000).toLocaleDateString('es-US', { weekday: 'long' });
        if (!dailyForecast[day]) {
            dailyForecast[day] = {
                minTemp: item.main.temp_min,
                maxTemp: item.main.temp_max,
                description: item.weather[0].description,
                humidity: item.main.humidity,
                windSpeed: item.wind.speed,
                icon: item.weather[0].icon,
            };
        } else {
            dailyForecast[day].minTemp = Math.min(dailyForecast[day].minTemp, item.main.temp_min);
            dailyForecast[day].maxTemp = Math.max(dailyForecast[day].maxTemp, item.main.temp_max);
        }
    });

    const today = new Date().toLocaleDateString('es-US', { weekday: 'long' });
    document.querySelector('.weather-temp').textContent = Math.round(currentTemperature) + 'ºC';
    document.querySelector('.date-dayname').textContent = today;
    
    const extractedDateTime = new Date().toLocaleString('es-US', { day: 'numeric', month: 'long', year: 'numeric' });
    document.querySelector('.date-day').textContent = extractedDateTime;

    const currentWeather = dailyForecast[today];
    document.querySelector('.weather-icon').innerHTML = getWeatherIcon(currentWeather.icon);
    document.querySelector('.location').textContent = data.city.name;
    document.querySelector('.weather-desc').textContent = capitalizeWords(currentWeather.description);
    document.querySelector('.humidity .value').textContent = `${currentWeather.humidity} %`;
    document.querySelector('.wind .value').textContent = `${currentWeather.windSpeed} m/s`;

    const dayElements = document.querySelectorAll('.day-name');
    const tempElements = document.querySelectorAll('.day-temp');
    const iconElements = document.querySelectorAll('.day-icon');

    dayElements.forEach((dayElement, index) => {
        const day = Object.keys(dailyForecast)[index];
        const weatherData = dailyForecast[day];
        dayElement.textContent = day;
        tempElements[index].textContent = `${Math.round(weatherData.minTemp)}º / ${Math.round(weatherData.maxTemp)}º`;
        iconElements[index].innerHTML = getWeatherIcon(weatherData.icon);
    });
}

function getWeatherIcon(iconCode) {
    return `<img src="https://openweathermap.org/img/wn/${iconCode}@2x.png" alt="Weather Icon">`;
}

function displayError(message) {
    const errorMessage = document.querySelector('.error-message');
    errorMessage.textContent = message;
    errorMessage.style.display = 'block';
}

function handleError(error) {
    const errorMessage = error.response ? error.response.data.message : 'No se ha podido conectar correctamente';
    displayError(`Error: ${errorMessage}`);
}

function capitalizeWords(string) {
    return string.split(' ')
        .map(word => word.charAt(0).toUpperCase() + word.slice(1))
        .join(' ');
}

document.addEventListener("DOMContentLoaded", function () {
    const defaultCity = document.getElementById('city').value || 'Cali';
    consultarClima(defaultCity);
    setInterval(() => consultarClima(defaultCity), 900000);
});



