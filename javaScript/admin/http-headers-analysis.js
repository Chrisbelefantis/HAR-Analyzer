var content_type=[];
var response_ttl=[];
var provider=[];
var has_min_fresh=[];
var has_max_stale=[];
var cacheability=[];
var preferences_button=document.getElementById("pref-button");
var ttl_alloc_chart;
var fresh_stale_chart;
var cacheability_chart;

function addButtonGroupLogic(optionButtons,allButton){
    
    for(let i=0;i<optionButtons.length-1;i++){
        (function(index){
                optionButtons[index].addEventListener('click',()=>{
                    
                    var allUnselected = false;

                    if(allButton.classList.contains('selected')){
                        allButton.classList.remove('selected')
                    }
                    else{

                        //Checking if all the other buttons except from the 
                        //one pressed are unselected
                        allUnselected = true;
                        for(let j=0;j<optionButtons.length-1;j++){
                            if(j!==index)
                            {
                                allUnselected = allUnselected && !optionButtons[j].classList.contains('selected');
                            }else{
                               
                            }  
                        }

                    }

                    

                    if(optionButtons[index].classList.contains('selected')){
                        //To prevent from having a button group without anything selected
                        if(!allUnselected){
                            optionButtons[index].classList.remove('selected');
                        }else{
                            document.querySelector('.alert').classList.add('show');
                            setTimeout(()=>{
                                document.querySelector('.alert').classList.remove('show');
                            },3000);
                        }
                    }
                    else{
                        optionButtons[index].classList.add('selected');
                    }

                  

                   
                    

                    var allSelected = true;
                    for(let j=0;j<optionButtons.length-1;j++){
                        allSelected = allSelected && optionButtons[j].classList.contains('selected');
                    }

                    if(allSelected){
                        for(let j=0;j<optionButtons.length-1;j++){
                        optionButtons[j].classList.remove('selected');
                        }
                        allButton.classList.add('selected');
                    }
                    find_selected_and_make_chart();
                })
            }
        )(i)
    }

    allButton.addEventListener('click',()=>{
        if(!allButton.classList.contains('selected')){
            allButton.classList.add('selected');
            for(let i=0; i<optionButtons.length-1; i++){
                optionButtons[i].classList.remove('selected');
            }

        }
        find_selected_and_make_chart();
    });

}

preferences_button.addEventListener("click",()=>{
    
    $('#preferencesModal').appendTo("body").modal('show');
})



$.get("../includes/admin/get_ttls.php", function(data) {
    data = JSON.parse(data);
   
    data.forEach(element => {
        
        content_type.push(element.response_contentType);
        response_ttl.push((element.response_TTL/86400).toFixed(2));
        provider.push(element.provider);
        has_min_fresh.push(element.has_min_fresh);
        has_max_stale.push(element.has_max_stale);
        cacheability.push(element.cacheability);
        
    });

    //data for axes of ttl allocattion graph
    var min_ttl=Number(response_ttl[response_ttl.length-1]);
    var max_ttl=Number(response_ttl[0]);
    var ttl_d=(max_ttl-min_ttl)/9;
    var x_axis=[];
    
    var y_axis=[0,0,0,0,0,0,0,0,0,0];

    for(var i=0; i<10; i++){

        left_boundary = parseInt(min_ttl+i*ttl_d);
        right_boundary = parseInt(min_ttl+ (i+1)*ttl_d-1);

        x_axis.push(String(left_boundary)+' - '+String(right_boundary)+' days');

    }

    for(var i=0; i<response_ttl.length; i++){
        y_axis[parseInt((response_ttl[i]-min_ttl)/ttl_d)]++;
    }
   

    var ctx = document.getElementById('myTTLChart').getContext('2d');

         ttl_alloc_chart = new Chart(ctx, {
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
                },
                scales: {
                    yAxes: {
                        id: 'Count',
                        type: 'logarithmic '
                    }
                }
            }
        }); 
    
    //data for has-min-fresh has-max-stale graph
    var per_has_min_fresh=0;
    has_min_fresh.forEach(element => {
        if(element){per_has_min_fresh++}
    });
    per_has_min_fresh=(per_has_min_fresh*100/has_min_fresh.length).toFixed(2);

    var per_has_max_stale=0;
    has_max_stale.forEach(element => {
        if(element){per_has_max_stale++}
    });
    per_has_max_stale=(per_has_max_stale*100/has_max_stale.length).toFixed(2);


    ctx = document.getElementById('fresh-stale-chart').getContext('2d');

    fresh_stale_chart = new Chart(ctx, {
       type: 'bar',
       data: {
           labels: ['Have min-fresh', 'Have max-stale'],
           datasets: [{
               label: 'Percentage',
               data: [per_has_min_fresh, per_has_max_stale],
               backgroundColor: '#0B032D'
           }]
       },
       options:{
           title:{
               display:true,
               padding:20,
               text:'Responses that have min-fresh and max-stale ',
               fontSize:25,
               fontColor:'#0B032D'
           },
           tooltips: {
            enabled: true
        },
        hover: {
            animationDuration: 1
        },
        animation: {
        duration: 1,
        onComplete: function () {
            var chartInstance = this.chart,
                ctx = chartInstance.ctx;
                ctx.textAlign = 'center';
                ctx.fillStyle = "#0B032D";
                ctx.textBaseline = 'bottom';
                // Loop through each data in the datasets
                this.data.datasets.forEach(function (dataset, i) {
                    var meta = chartInstance.controller.getDatasetMeta(i);
                    meta.data.forEach(function (bar, index) {
                        var data = dataset.data[index];
                        ctx.fillText(data+"%", bar._model.x, bar._model.y - 5);
                    });
                });
            }
        }
       }
   });

   //make cacheability chart
   var percentages=[0,0,0,0];

   cacheability.forEach(element => {
       if(element==="public"){
          percentages[0]++;
       }else if(element==="private"){
        percentages[1]++;
       }else if(element==="no-cache"){
        percentages[2]++;
       }else{
           percentages[3]++;
       }
   });

   for(var i=0; i<4; i++){
    percentages[i]=(percentages[i]/cacheability.length)*100;
   }


   ctx = document.getElementById('cacheability-chart').getContext('2d');

    cacheability_chart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: ['public','private','no-cache','no-store'],
        datasets: [{
            label: 'Number of Responses Status',
            data: percentages,
            backgroundColor: ["#0B032DFF","#0B032DAA","#0B032D77","#0B032D55"]
        }]
    },
    options:{
        title:{
            display:true,
            position:'top',
            padding:20,
            text:'Cachability Analysis',
            fontSize:25,
            fontColor:'#0B032D'
        },
        legend:{
            display:true,
            position:'right',
            padding:20

        }
    }
});
});


function chart_updater(selected_content_types, selected_providers){

    var cad_content_type=[];
    var cad_response_ttl=[];
    var cad_provider=[];
    var cad_has_min_fresh=[];
    var cad_has_max_stale=[];
    var cad_cacheability=[];
    //cut and dry data of interest
    if(selected_content_types[0]=="all" && selected_providers[0]== "all"){

        cad_content_type=content_type;
        cad_response_ttl=response_ttl;
        cad_provider=provider;
        cad_has_min_fresh=has_min_fresh;
        cad_has_max_stale=has_max_stale;
        cad_cacheability=cacheability;


    }else if(selected_providers[0]=="all"){
        for(var i=0; i<content_type.length; i++){
           
           
            if(selected_content_types.includes(content_type[i])){
               
                cad_content_type.push(content_type[i]);
                cad_response_ttl.push(response_ttl[i]);
                cad_provider.push(provider[i]);
                cad_has_min_fresh.push(has_min_fresh[i]);
                cad_has_max_stale.push(has_max_stale[i]);
                cad_cacheability.push(cacheability[i]);
            }
        }

    }else if(selected_content_types[0]=="all"){
        for(var i=0; i<content_type.length; i++){
            if(selected_providers.includes(provider[i])){
                cad_content_type.push(content_type[i]);
                cad_response_ttl.push(response_ttl[i]);
                cad_provider.push(provider[i]);
                cad_has_min_fresh.push(has_min_fresh[i]);
                cad_has_max_stale.push(has_max_stale[i]);
                cad_cacheability.push(cacheability[i]);
            }
        }

    }else{

        for(var i=0; i<content_type.length; i++){
            if(selected_content_types.includes(content_type[i]) && selected_providers.includes(provider[i])){
                cad_content_type.push(content_type[i]);
                cad_response_ttl.push(response_ttl[i]);
                cad_provider.push(provider[i]);
                cad_has_min_fresh.push(has_min_fresh[i]);
                cad_has_max_stale.push(has_max_stale[i]);
                cad_cacheability.push(cacheability[i]);
            }
        }
    }

   //make axes data for ttl graph and update
    var min_ttl=Number(cad_response_ttl[cad_response_ttl.length-1]);
    var max_ttl=Number(cad_response_ttl[0]);
    var ttl_d=(max_ttl-min_ttl)/9;
    var x_axis=[];
    var y_axis=[0,0,0,0,0,0,0,0,0,0];
    for(var i=0; i<10; i++){

        left_boundary = parseInt(min_ttl+i*ttl_d);
        right_boundary = parseInt(min_ttl+ (i+1)*ttl_d-1);

        x_axis.push(String(left_boundary)+' - '+String(right_boundary)+' days');

    }

    for(var i=0; i<cad_response_ttl.length; i++){
        y_axis[parseInt((cad_response_ttl[i]-min_ttl)/ttl_d)]++;
    }
    
    var ctx = document.getElementById('myTTLChart').getContext('2d');
    ttl_alloc_chart.data.datasets[0].data = y_axis;
    ttl_alloc_chart.data.labels = x_axis;
    ttl_alloc_chart.update();
    
    //update min-fesh max-stale chart
    var per_has_min_fresh=0;
    cad_has_min_fresh.forEach(element => {
        if(element){per_has_min_fresh++}
    });
    per_has_min_fresh=(per_has_min_fresh*100/cad_has_min_fresh.length).toFixed(2);

    var per_has_max_stale=0;
    cad_has_max_stale.forEach(element => {
        if(element){per_has_max_stale++}
    });

    per_has_max_stale=(per_has_max_stale*100/cad_has_max_stale.length).toFixed(2);

    fresh_stale_chart.data.datasets[0].data = [per_has_min_fresh,per_has_max_stale];
    fresh_stale_chart.update();

    //update cacheability 
    var cad_percentages=[0,0,0,0];

    cad_cacheability.forEach(element => {
       if(element==="public"){
        cad_percentages[0]++;
       }else if(element==="private"){
        cad_percentages[1]++;
       }else if(element==="no-cache"){
        cad_percentages[2]++;
       }else{
        cad_percentages[3]++;
       }
   });

   for(var i=0; i<4; i++){
    cad_percentages[i]=(cad_percentages[i]/cad_cacheability.length)*100;
   }
   cacheability_chart.data.datasets[0].data =cad_percentages;
   cacheability_chart.update()
}



var contentTypeButtons = document.querySelectorAll('.content-types button');
var allContentTypesButton = document.querySelector('.content-types .all-button');


var providerTypeButtons = document.querySelectorAll('.providers button');
var allProviderTypesButton = document.querySelector('.providers .all-button');


addButtonGroupLogic(contentTypeButtons,allContentTypesButton);
addButtonGroupLogic(providerTypeButtons,allProviderTypesButton);



function find_selected_and_make_chart(){

    var selected_content_types=[];
    var selected_providers=[];
    for(var i=0; i<contentTypeButtons.length; i++){
        if (contentTypeButtons[i].classList.contains('selected')){
            selected_content_types.push(contentTypeButtons[i].textContent.toLowerCase().trim());
        }   
    }

    for(var i=0; i<providerTypeButtons.length; i++){
        if (providerTypeButtons[i].classList.contains('selected')){
            selected_providers.push(providerTypeButtons[i].textContent.toLowerCase().trim());
        }   
    }

    chart_updater(selected_content_types, selected_providers);
}
