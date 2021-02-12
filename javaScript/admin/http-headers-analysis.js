$.get("../includes/admin/get_ttls.php", function(data) {

    data = JSON.parse(data);
    var content_type=[];
    var average_ttl=[];
    var count=[];
    var provider=[];

    data.forEach(element => {
        
        content_type.push(element.response_contentType);
        average_ttl.push((element.avg_ttl/60).toFixed(2));
        count.push(element.count);
        provider.push(element.provider);

    });

    var min_ttl=Number(average_ttl[average_ttl.length-1]);
    var max_ttl=Number(average_ttl[0]);
    var ttl_d=(max_ttl-min_ttl)/9;
    var x_axis=[];
    var y_axis=[0,0,0,0,0,0,0,0,0,0];
    console.log(min_ttl, max_ttl)
    for(var i=0; i<10; i++){
        x_axis.push(min_ttl+i*ttl_d);

    }

    for(var i=0; i<count.length; i++){
        y_axis[parseInt((average_ttl[i]-min_ttl)/ttl_d)]+=count[i];
    }
   

    console.log(x_axis, y_axis);
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

});