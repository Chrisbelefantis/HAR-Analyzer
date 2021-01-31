var preferences_button=document.getElementById("pref-button");

preferences_button.addEventListener("click",()=>{
    $("#preferencesModal").modal()
})


class map{
    constructor(lat,lng,zoom){
        this.mymap = L.map('mapid').setView([lat,lng], zoom);
        var attributes= {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        };
        var tileUrl = 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';
        const tiles = L.tileLayer(tileUrl,attributes);
        tiles.addTo(this.mymap);
    }
    addLayer(layer){
        this.mymap.addLayer(layer);
    }

}


let mymap = new map(33.72,9.84,3);




$.get("../includes/admin/load_vis_data.php" ,(data,status)=>{
    if(status==='success'){

        data = JSON.parse(data);

        data.forEach(element => {
             var marker = L.marker([element.lat, element.lng]).addTo(mymap).bindPopup("Latitude:"+element.lat+"<br>Longtitude:"+element.lng+"<br>Total Requests:"+element.count);
        });

    }else{
        alert(status);
    }
})






  
