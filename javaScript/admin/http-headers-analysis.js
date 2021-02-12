var content_type=[];
var average_ttl=[];
var count=[];
var provider=[];

$.get("../includes/admin/get_ttls.php", function(data) {

    data = JSON.parse(data);


    data.forEach(element => {
        
        content_type.push(element.response_contentType);
        average_ttl.push((element.avg_ttl/60).toFixed(2));
        count.push(element.count);
        provider.push(element.provider);

        
    });

    
    chart_maker(["all"],["all"]);

});




function chart_maker(selected_content_types, selected_providers){
    var cad_content_type=[];
    var cad_average_ttl=[];
    var cad_count=[];
    var cad_provider=[];
    //cut and dry data of interest
    if(selected_content_types[0]=="all" && selected_providers[0]== "all"){
        cad_content_type=content_type;
        cad_average_ttl=average_ttl;
        cad_count=count;
        cad_provider=provider;
    }else{

        for(var i=0; i<content_type.length; i++){
            if(selected_content_types.contains(content_type[i]) &&selected_providers.contains(provider[i])){
                cad_content_type.push(content_type[i]);
                cad_average_ttl.push(average_ttl[i]);
                cad_count.push(count[i]);
                cad_provider.push(provider[i]);
            }
        }
    }


    var min_ttl=Number(cad_average_ttl[cad_average_ttl.length-1]);
    var max_ttl=Number(cad_average_ttl[0]);
    var ttl_d=(max_ttl-min_ttl)/9;
    var x_axis=[];
    var y_axis=[0,0,0,0,0,0,0,0,0,0];
    for(var i=0; i<10; i++){
        x_axis.push(min_ttl+i*ttl_d);

    }

    for(var i=0; i<cad_count.length; i++){
        y_axis[parseInt((cad_average_ttl[i]-min_ttl)/ttl_d)]+=cad_count[i];
    }
   

    var ctx = document.getElementById('myTTLChart').getContext('2d');

        var myPieChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: x_axis,
                datasets: [{
                    label: 'Count',
                    data: y_axis,
                    backgroundColor: '#0B032D'
                }]
            },
            options:{
                title:{
                    display:true,
                    padding:20,
                    text:' TTL Allocation',
                    fontSize:25,
                    fontColor:'#0B032D'
                }
            }
        }); 
}

