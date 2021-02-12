var content_type=[];
var average_ttl=[];
var count=[];
var provider=[];
var preferences_button=document.getElementById("pref-button");
var myPieChart;

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
        average_ttl.push((element.avg_ttl/60).toFixed(2));
        count.push(element.count);
        provider.push(element.provider);

        
    });

    
    var min_ttl=Number(average_ttl[average_ttl.length-1]);
    var max_ttl=Number(average_ttl[0]);
    var ttl_d=(max_ttl-min_ttl)/9;
    var x_axis=[];
    var y_axis=[0,0,0,0,0,0,0,0,0,0];
    for(var i=0; i<10; i++){
        x_axis.push(min_ttl+i*ttl_d);

    }

    for(var i=0; i<count.length; i++){
        y_axis[parseInt((average_ttl[i]-min_ttl)/ttl_d)]+=count[i];
    }
   

    var ctx = document.getElementById('myTTLChart').getContext('2d');

         myPieChart = new Chart(ctx, {
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


function chart_maker(selected_content_types, selected_providers){
    console.log(content_type)
    console.log(average_ttl)
    console.log(provider)
    console.log(count);
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

    }else if(selected_providers[0]=="all"){
        for(var i=0; i<content_type.length; i++){
           
           
            if(selected_content_types.includes(content_type[i])){
               
                cad_content_type.push(content_type[i]);
                cad_average_ttl.push(average_ttl[i]);
                cad_count.push(count[i]);
                cad_provider.push(provider[i]);
            }
        }

    }else if(selected_content_types[0]=="all"){
        for(var i=0; i<content_type.length; i++){
            if(selected_providers.includes(provider[i])){
                cad_content_type.push(content_type[i]);
                cad_average_ttl.push(average_ttl[i]);
                cad_count.push(count[i]);
                cad_provider.push(provider[i]);
            }
        }

    }else{

        for(var i=0; i<content_type.length; i++){
            if(selected_content_types.includes(content_type[i]) && selected_providers.includes(provider[i])){
                cad_content_type.push(content_type[i]);
                cad_average_ttl.push(average_ttl[i]);
                cad_count.push(count[i]);
                cad_provider.push(provider[i]);
            }
        }
    }

    console.log(cad_average_ttl);
    console.log(cad_count);
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
    myPieChart.data.datasets[0].data = y_axis;
    console.log(y_axis);
    myPieChart.data.labels = x_axis;
    myPieChart.update();
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

    chart_maker(selected_content_types, selected_providers);
}
