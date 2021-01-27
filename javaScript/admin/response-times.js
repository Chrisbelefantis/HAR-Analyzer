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
    });

}



var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'line',
    data: 
        {

            labels: [],
            datasets:[{
                data: [],
                borderWidth: 2,
                fill:false,
                pointStyle: 'circle',
                borderColor:'#ff0059',
                label:'Waiting time in Seconds',
                lineTension:0
            }]

        }
    ,
    options: {
        legend:{
            display: false
        },
        maintainAspectRatio: false,
        scales: {
          yAxes: [{
            stacked: true,
            gridLines: {
              display: true,
              color: "rgba(255,99,132,0.2)"
            }
          }],
          xAxes: [{
            gridLines: {
              display: false
            }
          }]
        }
    }
    
});

$.get('../includes/admin/waiting_times.php',{options:JSON.stringify({
        days:"all",
        methods:"all",
        contentTypes:"all",
        providers: "all"
    })},
    (data)=>{
        //console.log(data);
        let graphData = JSON.parse(data);
        myChart.data.datasets[0].data = graphData.waitingTimes;
        myChart.data.labels = graphData.hours;
        document.querySelector('.chart-samples').textContent = "Samples: "+graphData.count+"";
        myChart.update();
})



var daysButtons = document.querySelectorAll('.days button');
var allDaysButton = document.querySelector('.days .all-button');

var methodsButtons = document.querySelectorAll('.methods button');
var allMethodsButton = document.querySelector('.methods .all-button');

var contentTypeButtons = document.querySelectorAll('.content-types button');
var allContentTypesButton = document.querySelector('.content-types .all-button');


var providerTypeButtons = document.querySelectorAll('.providers button');
var allProviderTypesButton = document.querySelector('.providers .all-button');

addButtonGroupLogic(daysButtons,allDaysButton);
addButtonGroupLogic(methodsButtons,allMethodsButton);
addButtonGroupLogic(contentTypeButtons,allContentTypesButton);
addButtonGroupLogic(providerTypeButtons,allProviderTypesButton);



document.querySelectorAll('.btn').forEach((button)=>{
    button.addEventListener('click',()=>{
        let options = {
            days: "all",
            methods: "all",
            contentTypes: "all",
            providers: "all"
        };
    
        if(!allDaysButton.classList.contains('selected')){
            let selectedDays = [];
            for(let i=0; i<daysButtons.length-1; i++){
                if(daysButtons[i].classList.contains('selected')){
                    selectedDays.push(daysButtons[i].textContent);
                }
            }
            options.days = selectedDays;
        }
    
    
        if(!allMethodsButton.classList.contains('selected')){
            let selectedMethods = [];
            for(let i=0; i<methodsButtons.length-1; i++){
                if(methodsButtons[i].classList.contains('selected')){
                    selectedMethods.push(methodsButtons[i].textContent.trim());
                }
            }
            options.methods = selectedMethods;
        }
    
    
        if(!allContentTypesButton.classList.contains('selected')){
            let selectedContentTypes = [];
            for(let i=0; i<contentTypeButtons.length-1; i++){
                if(contentTypeButtons[i].classList.contains('selected')){
                    selectedContentTypes.push(contentTypeButtons[i].textContent.trim());
                }
            }
            options.contentTypes = selectedContentTypes;
        }
    
        if(!allProviderTypesButton.classList.contains('selected')){
            let selectedProviders = [];
            for(let i=0; i<providerTypeButtons.length-1; i++){
                if(providerTypeButtons[i].classList.contains('selected')){
                    selectedProviders.push(providerTypeButtons[i].textContent.trim());
                }
            }
            options.providers = selectedProviders;
        }
    
    
    
        //console.log(options);
    
        $.get('../includes/admin/waiting_times.php',{options:JSON.stringify(options)},(data)=>{
            console.log(data);
            let graphData = JSON.parse(data);
            myChart.data.datasets[0].data = graphData.waitingTimes;
            myChart.data.labels = graphData.hours;
            document.querySelector('.chart-samples').textContent = "Samples: "+graphData.count+"";
            myChart.update();
        })
    
    
    });
})

