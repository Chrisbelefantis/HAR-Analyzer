var chooseButton=document.getElementById("chooseButton");
var downloadButton = document.getElementById("downloadButton");
var uploadButton = document.getElementById("uploadButton");
var hiddenChooseButton=document.getElementById("hiddenChooseButton");
var dropButton=document.getElementById("dropButton");
var confirnButton = document.getElementById("confirnButton");
var mainDiv=document.getElementById("main-div");
var toBeHidden=document.getElementsByClassName("to-be-hidden");
var cleanedHarFiles = [];
var uploadedFiles=0;
var filesFinished = 0;
var fileNames;


var loadingSpinner=
  `<div class="file-status">
    <span class="status-text">Uploading</span> 
    <div class="spinner-border" role="status">
      <span class="visually-hidden"></span>
    </div>
  </div>`;

var xsvg=`<svg  
  class=\"drop-svg\" 
  xmlns=\"http://www.w3.org/2000/svg\" 
  xmlns:xlink=\"http://www.w3.org/1999/xlink\" 
  x=\"0px\" y=\"0px\" width=\"30px\" height=\"30px\" 
  viewBox=\"0 0 122.879 122.879\"  
  xml:space=\"preserve\"><g><path fill-rule=\"evenodd\" 
  clip-rule=\"evenodd\" fill=\"#dc3545\" 
  d=\"M61.44,0c33.933,0,61.439,27.507,61.439,61.439 s-27.506,61.439-61.439,61.439C27.507,122.879,0,95.372,0,61.439S27.507,0,61.44,0L61.44,0z M73.451,39.151 c2.75-2.793,7.221-2.805,9.986-0.027c2.764,2.776,2.775,7.292,0.027,10.083L71.4,61.445l12.076,12.249 c2.729,2.77,2.689,7.257-0.08,10.022c-2.773,2.765-7.23,2.758-9.955-0.013L61.446,71.54L49.428,83.728 c-2.75,2.793-7.22,2.805-9.986,0.027c-2.763-2.776-2.776-7.293-0.027-10.084L51.48,61.434L39.403,49.185 c-2.728-2.769-2.689-7.256,0.082-10.022c2.772-2.765,7.229-2.758,9.953,0.013l11.997,12.165L73.451,39.151L73.451,39.151z\"/></g>
  </svg>`

var statusFinished = ` 
<div  style ='color:green;'>  
  <span class="status-text">Ready</span> 
  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check2-circle" viewBox="0 0 16 16">
    <path d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0z"/>
    <path d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l7-7z"/>
  </svg>
</div>`;

//Button for selecting files to upload
chooseButton.addEventListener('click',function(){
    
    hiddenChooseButton.click();
});

//Handles when user inputs files
hiddenChooseButton.addEventListener('change', (event) => {
  fileNames = Array.from(event.target.files);
  appendFiles(fileNames);
});


//Puts filelist to table shows buttons then calls clearFiles()
function appendFiles(files){

  const filesTable=document.getElementById("filesTable");
  uploadButton.disabled = true;
  downloadButton.disabled = true;

  for (const file of files) {

    uploadedFiles++;
    const number = uploadedFiles;
    const fileName = file.name ? file.name : 'NOT SUPPORTED';
    $(`
      <tr>
        <th class="serial-number" scope=\`row\`>` + number + `</th>
        <td>` + fileName + `</td>
        <td>
          Pending Confirmation
        </td>
        <td>
          `+xsvg+`
        </td>
      </tr>`
      ).appendTo("#filesTable");


  }

  chooseButton.classList.remove("main-button");
  filesTable.style.visibility = "initial"; 

  var buttons=document.getElementsByClassName("btn");
  buttons[2].classList.remove("hidden");


  setDropFileButtons()
  mainDiv.classList.remove('grey-border');
  for(const x of toBeHidden){
    x.style.display = "none";
  }

  

}


confirnButton.addEventListener("click",()=>{
  alert('confirn');
});

function readFiles(){

  listOfFiles=hiddenChooseButton.files;

  //For multiple files 
  for (var i = 0; i <listOfFiles.length; i++) {          
    (function(file,index) {
 
        var reader = new FileReader();  

        //Action to perform when upload is finished
        reader.onload = function(e) {  
          
          
          var filesStatus = document.querySelectorAll(".status-text");
          filesStatus[index].textContent = "Cleaning";


          clearFile(e.target.result,index);

          filesFinished++;
          if(filesFinished==uploadedFiles){
            uploadButton.disabled = false;
            downloadButton.disabled = false;

          }
        }

        reader.readAsText(file, "UTF-8");
        
    })(listOfFiles[i],filesFinished + i);



  }
}


function clearFile(harFile,index){
  var jsonFile= JSON.parse(harFile);
  
  //Remove all exept entries
  jsonFile = jsonFile.log.entries;

  for(i=0;i<jsonFile.length;i++){

    requestHeaders = [...jsonFile[i].request.headers];
    responseHeaders = [...jsonFile[i].response.headers];

    requestHeadersCleaned = [];
    responseHeadersCleaned = [];

    var valuableHeaders = ['cache-Control','content-type','pragma','expires','age','host','last-modified'];

    //Cleaning request headers
    for(j=0 ; j<requestHeaders.length ; j++){
      if(valuableHeaders.includes(requestHeaders[j].name.toLowerCase())){
        requestHeadersCleaned.push(requestHeaders[j]);
      }
    }



    //Cleaning response headers
    for(j=0 ; j<responseHeaders.length ; j++){
      
      if(valuableHeaders.includes(responseHeaders[j].name.toLowerCase())){
        responseHeadersCleaned.push(responseHeaders[j]);
      }
    }

    var url = jsonFile[i].request.url;
    var cleanedUrl = url.split('/')[2];

    jsonFile[i] = {
      'request': {
        'method': jsonFile[i].request.method,
        'url': cleanedUrl,
        'headers': [requestHeadersCleaned]
      },
      'response': {
        'status': jsonFile[i].response.status,
        'statusText': jsonFile[i].response.statusText,
        'headers': [responseHeadersCleaned]
      },
      'startedDateTime': jsonFile[i].startedDateTime,
      'serverIPAddress': jsonFile[i].serverIPAddress,
      'timings' : {'wait':jsonFile[i].timings.wait}

    }



  }
  var filesStatus = document.querySelectorAll(".file-status");
  filesStatus[index].innerHTML = statusFinished;
  cleanedHarFiles.push(...jsonFile);
}

downloadButton.addEventListener("click",()=>{
  
  const a = document.createElement("a");
  a.href = URL.createObjectURL(new Blob([JSON.stringify(cleanedHarFiles, null, 2)], {
    type: "application/json"
  }));
  a.setAttribute("download", "cleanedData.json");
  document.body.appendChild(a);
  a.click();
  document.body.removeChild(a);
})



//Drop button function
dropButton.addEventListener("click", function(){
  
  chooseButton.classList.add("main-button");

  document.getElementById("filesTable").style.visibility = "hidden"; 

  var buttons=document.getElementsByClassName("btn");
  buttons[0].classList.add("hidden");
  buttons[1].classList.add("hidden");
  buttons[2].classList.add("hidden");
  buttons[4].classList.add("hidden");

  document.getElementById("tbody").innerHTML="";
  mainDiv.classList.add('grey-border');
  for(const x of toBeHidden){
    x.style.display = "";
  }


  cleanedHarFiles = [];
  uploadedFiles=0;
  hiddenChooseButton.value="";
    
});



//Adds event listeners to svgs
function setDropFileButtons(){
  var dropFileButtons= document.getElementsByClassName("drop-svg")
  let counter = 0;
  for(var button of dropFileButtons){
    button.addEventListener('click', dropFileSVG.bind(this,counter))
    counter++;
  }
}

//Function that deletes element when drop file (svg) clicked
function dropFileSVG(index){
  
  $(this).closest('tr').remove();
  uploadedFiles--;
  filesFinished--;
  if(uploadedFiles==0){
    dropButton.click();
    return;
  }
  const serialNumbers=document.getElementsByClassName("serial-number");
  for(var i=0; i<serialNumbers.length;i++){
    serialNumbers[i].innerHTML=i+1;
  }
  
  fileNames.splice(index,1)
  console.log(fileNames);

}



uploadButton.addEventListener("click",()=>{

  
  var userData = findUserData();

  var tempData = {
    location: '42,12',
    provider: 'Cosmote'
  };

  postData(tempData);


});


function findUserData(){


}

function postData(userData){

  var userData = {
    "location": userData.location,
    "provider": userData.provider,
    "data": [...cleanedHarFiles]
  };

  console.log(userData);
  
}




//--------------------Functions For Drag n Drop----------------------//
;['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
  mainDiv.addEventListener(eventName, preventDefaults, false)
})

function preventDefaults (e) {
  e.preventDefault()
  e.stopPropagation()
}

;['dragenter', 'dragover'].forEach(eventName => {
  mainDiv.addEventListener(eventName, highlight, false)
})

;['dragleave', 'drop'].forEach(eventName => {
  mainDiv.addEventListener(eventName, unhighlight, false)
})

function highlight(e) {
  mainDiv.classList.add('highlight')
}

function unhighlight(e) {
  mainDiv.classList.remove('highlight')
}

mainDiv.addEventListener('drop', handleDrop, false)

function handleDrop(e) {
  appendFiles(e.dataTransfer.files)
}
//----------------------------------------------------------//