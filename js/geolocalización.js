function callback(data)
{

    var city = document.getElementById('city').value= data.city;
    city.innerHTML = data.city;
   
}
var script = document.createElement('script');
script.type = 'text/javascript';
script.src = 'https://geolocation-db.com/json/geoip.php?jsonp=callback';
var h = document.getElementsByTagName('script')[0];
h.parentNode.insertBefore(script, h);