var chooseButton=document.getElementById("chooseButton");
var hiddenChooseButton=document.getElementById("hiddenChooseButton");
var dropButton=document.getElementById("dropButton");
var filesCount=1;
var cleanedFilesCount=0;


chooseButton.addEventListener('click',function(){
    hiddenChooseButton.click();
});

hiddenChooseButton.addEventListener('change', (event) => {
  const fileList = event.target.files;
  const filesTable=document.getElementById("filesTable");
  for (const file of event.target.files) {
    const number = filesCount;
    const fileName = file.name ? file.name : 'NOT SUPPORTED';

    $("<tr><th scope=\"row\">" + number + "</th><td>" + fileName + "</td</tr>").appendTo("#filesTable");
    filesCount++;
  }
  chooseButton.classList.remove("main-button");
  filesTable.style.visibility = "initial"; 
  var buttons=document.getElementsByClassName("btn");
  buttons[0].style.visibility="initial";
  buttons[1].style.visibility="initial";
  buttons[3].style.visibility="initial";
  
  clearFiles();
});

dropButton.addEventListener("click", function(){

  chooseButton.classList.add("main-button");

  document.getElementById("filesTable").style.visibility = "hidden"; 

  var buttons=document.getElementsByClassName("btn");
  buttons[0].style.visibility="hidden";
  buttons[1].style.visibility="hidden";
  buttons[3].style.visibility="hidden";

  hiddenChooseButton.value="";
  document.getElementById("tbody").innerHTML="";
  filesCount=1;
  cleanedFilesCount=0;
});


function clearFiles(){

  listOfFiles=hiddenChooseButton.files;

  for (cleanedFilesCount; cleanedFilesCount<filesCount-1; cleanedFilesCount++) {
    console.log("file number:"+cleanedFilesCount);
  }


}



