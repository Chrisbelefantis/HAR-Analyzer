var chooseButton=document.getElementById("chooseButton");
var downloadButton = document.getElementById("downloadButton");
var uploadButton = document.getElementById("uploadButton");
var hiddenChooseButton=document.getElementById("hiddenChooseButton");
var dropButton=document.getElementById("dropButton");
var cleanedHarFiles = [];
var uploadedFiles=0;
var filesFinished = 0;

chooseButton.addEventListener('click',function(){
    
    hiddenChooseButton.click();
});

hiddenChooseButton.addEventListener('change', (event) => {
  const filesTable=document.getElementById("filesTable");
  uploadButton.disabled = true;
  downloadButton.disabled = true;

  for (const file of event.target.files) {

    const number = ++uploadedFiles;
    const fileName = file.name ? file.name : 'NOT SUPPORTED';
    $(`
      <tr>
        <th scope=\`row\`>` + number + `</th>
        <td>` + fileName + `</td>
        <td>
          <div class="file-status">
            <span class="status-text">Uploading</span> 
            <div class="spinner-border" role="status">
              <span class="visually-hidden"></span>
            </div>
          </div>
        </td>
      </tr>`
      ).appendTo("#filesTable");


  }
  chooseButton.classList.remove("main-button");
  filesTable.style.visibility = "initial"; 
  var buttons=document.getElementsByClassName("btn");
  buttons[0].style.visibility="initial";
  buttons[1].style.visibility="initial";
  buttons[3].style.visibility="initial";
  readFiles();
});

dropButton.addEventListener("click", function(){
  
  chooseButton.classList.add("main-button");

  document.getElementById("filesTable").style.visibility = "hidden"; 

  var buttons=document.getElementsByClassName("btn");
  buttons[0].style.visibility="hidden";
  buttons[1].style.visibility="hidden";
  buttons[3].style.visibility="hidden";

  cleanedHarFiles = [];
  hiddenChooseButton.value="";
  document.getElementById("tbody").innerHTML="";
  uploadedFiles=0;
  
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
  filesStatus[index].innerHTML = 
  ` 
  <div  style ='color:green;'>  
    <span class="status-text">Ready</span> 
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check2-circle" viewBox="0 0 16 16">
      <path d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0z"/>
      <path d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l7-7z"/>
    </svg>
  </div>`;

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



uploadButton.addEventListener("click",()=>{


  

  var uploadData = {
    "location": null,
    "data": [...cleanedHarFiles]
  };
  console.log(uploadData);

  alert("Files Uploaded")


})