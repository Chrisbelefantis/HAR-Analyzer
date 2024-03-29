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

class heatmap{
    constructor(){    
        this.cfg = {
            "radius":2,
            "maxOpacity": .8,      
            "scaleRadius": true,        
            "useLocalExtrema": false,         
            latField: 'lat',    
            lngField: 'lng',
            valueField: 'count'
        };
        this.heatmapLayer = new HeatmapOverlay(this.cfg);
     
    }
    getLayer(){ 
        return this.heatmapLayer;
    }

    setData(data){
        this.heatmapLayer.setData(data);
    }


}


let backdrop = document.querySelector(".backdrop");
let spinner = document.querySelector(".spinner-border");


let mymap = new map(33.72,9.84,3);

let myHeatmap = new heatmap();

mymap.addLayer(myHeatmap.getLayer());


$.get("../includes/user/load_data.php" ,(data,status)=>{

    
    if(status==='success'){

        data = JSON.parse(data);

        // backdrop.classList.add('disabled');
        // spinner.classList.add('disabled');

        let max = Math.max.apply(Math, data.map(function(o) { return o.count; }))
 
        myHeatmap.setData({
            max: max,
            data: data
        });


        

    }else{
        alert(status);
    }

})





  
