var scale=document.getElementById("scale_div");

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

$.get("../includes/admin/load_servers_locations.php" ,(data,status)=>{
    if(status==='success'){

        data = JSON.parse(data);
        var first=1;
        var max_count;
        data.forEach(element => {
            //save max
            if(first){
                max_count=element.count;
                first=0;
            }
            //add marker
            var marker = L.marker([element.lat, element.lng]).addTo(mymap).bindPopup("Latitude:"+element.lat+"<br>Longtitude:"+element.lng+"<br>Total Requests:"+element.count);
        });
    }else{
        alert(status);
    }
})



$.get("../includes/admin/load_clients_location.php",(data,status)=>{
    if(status==='success'){
        data = JSON.parse(data);

        var first=1;
        var max_count;
        data.forEach(element => {

        //save max
        if(first){
            max_count=element.count;
            first=0;
        }

        var r=Math.sqrt(Math.pow(Number(element.s_lat)-Number(element.c_lat),2)+Math.pow(Number(element.s_lng)-Number(element.c_lng),2))/2;
        var circle_center=[(Number(element.s_lat)+Number(element.c_lat))/2,(Number(element.s_lng)+Number(element.c_lng))/2];
        var normal_b=[Number(element.s_lat)-circle_center[0],Number(element.s_lng)-circle_center[1]];
        var theta=Math.PI/2 +Math.atan(normal_b[1]/normal_b[0]);
        var cart_c=[Math.abs(r*Math.cos(theta))+circle_center[0], r*Math.sin(theta)+circle_center[1]];
        if(cart_c[0]-element.s_lat>25 ||cart_c[0]-element.c_lat>25)
            {cart_c[0]-=30;}
        var weight=200 - ((200*element.count)/max_count);
        var color="hsl("+weight+",100%,50%)"

        //add curve
        if(element.s_lat!=element.c_lat && element.s_lng!=element.c_lng ){
            var path = L.curve(['M',[element.c_lat,element.c_lng],
                                'Q',cart_c,
                                    [element.s_lat,element.s_lng],
                                ], 
                            {animate: 1700, color: color }).addTo(mymap).bindPopup("Origin:<br>Latitude:"+element.c_lat+"<br>Longtitude:"+element.c_lng+"<br>Total Requests:"+element.count);;
        }
    });

    //normalize scale
    var inner_text="";
    for(var i=0; i<8; i++){
        inner_text+='<span style="width:12.1%">'+Math.round(i*(max_count/7))+'</span>'
    }
    scale.innerHTML=inner_text;
    }else{
        alert(status);
    }
})
