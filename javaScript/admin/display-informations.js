$.get("../includes/admin/get_users.php", function(data) {
        console.log(data);
        document.getElementById("numberOfUsers").innerHTML = data;
});

$.get("../includes/admin/get_uniquedomains.php", function(data) {
    console.log(data);
    document.getElementById("numberUniqueDomains").innerHTML = data;
});

$.get("../includes/admin/get_providers.php", function(data) {
    console.log(data);
    document.getElementById("numberofproviders").innerHTML = data;
});


$.get("../includes/admin/get_requestMethod.php", function(data) {
    var methods = JSON.parse(data);

    $.get("../includes/admin/get_numberOfrequestmethods.php", function(data) {
        
        var number0fmethods = JSON.parse(data);

        var ctx = document.getElementById('myChart').getContext('2d');

        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: methods,
                datasets: [{
                    label: 'Number of Request Method',
                    data: number0fmethods,
                    backgroundColor: '#0B032D'
                }]
            },
            options:{
                title:{
                    display:true,
                    padding:20,
                    text:'Requests Methods',
                    fontSize:25,
                    fontColor:'#0B032D'
                }
            }
        });
        
    });  
});

$.get("../includes/admin/get_responsesStatus.php", function(data) {
    var response_status = JSON.parse(data);

    $.get("../includes/admin/get_numberofresponsesStatus.php", function(data) {

        var numberofresponse_status = JSON.parse(data);

        var ctx = document.getElementById('myChartsecond').getContext('2d');

        var myChartsecond = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: response_status,
                datasets: [{
                    label: 'Number of Responses Status',
                    data:  numberofresponse_status,
                    backgroundColor: '#0B032D'
                }]
            },
            options:{
                title:{
                    display:true,
                    padding:20,
                    text:'Responses Status',
                    fontSize:25,
                    fontColor:'#0B032D'
                }
            }
        });

        
    });

});


$.get("../includes/admin/get_contentType.php", function(data) {
    data = JSON.parse(data);
    var content_type=[];
    var average_age=[];
    var colors=[];
    opacity=[1.00,0.50];
    counter=0;
    data.forEach(element => {
        if(element.count > 20){
            content_type.push(element.response_contentType);
            average_age.push((element.avg_age/1000).toFixed(2));
            colors.push('rgba(11,3,45,'+opacity[counter%2]+')');
            opacity[counter%2]-=0.045;
            counter++;
        }
    });

    var ctx = document.getElementById('myPieChart').getContext('2d');

        var myPieChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: content_type,
                datasets: [{
                    label: 'Number of Responses Status',
                    data: average_age,
                    backgroundColor: colors
                }]
            },
            options:{
                title:{
                    display:true,
                    position:'left',
                    padding:20,
                    text:'Average Age Per Content Type',
                    fontSize:25,
                    fontColor:'#0B032D'
                },
                legend:{
                    display:true,
                    position:'left',
                    padding:20

                }
            }
        });

});





