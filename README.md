# Ηar Αnalyzer Application

We have developed an application for complete collection, management and crowdsourced information analysis of HTTP traffic data. Specifically, the application gives access to users and the administrator which have access to different operations.

## Login Page

**The login page** is shown below where depending on whether the user or the administrator logs in, the corresponding page is displayed.

![image](https://user-images.githubusercontent.com/60574307/115163506-1e6cc600-a0b2-11eb-97d0-8808ea97b478.png)


**Registration in the system:** The user registers and have acesss to the system by selecting a username & password of his choice, and providing his email. The password is required be at least 8 characters and contain at least one capital letter, a number and a symbol (eg # $ * & @).

![image](https://user-images.githubusercontent.com/60574307/115163730-693b0d80-a0b3-11eb-8ee5-b4842be627bb.png)


## User

Once logged in, the user can manage their profile, upload and visualize HAR file data.


**Profile management:**
the user can change the username / password and see basic statistics for the data he has uploaded (date of last upload, number of records).

![image](https://user-images.githubusercontent.com/60574307/115398099-778e4400-a1ef-11eb-9272-c3b6a8c1ac32.png)


**Upload data:**
  The user selects a HAR file from his computer. The file is processed locally (using JavaScript) in order to delete sensitive data and then the user has two options: 
  
    a) Upload it to the system

    b) Save the edited file locally.
  
  If the file is uploaded to the system, it will need to be further processed (on the server) of the data to be uploaded, in order to store the desired data with appropriate       format. Also, the IP of the user uploading the file should be "analyzed" so that to automatically discover the user connectivity provider and save the this information in the   database along with the records, this process is done using an API.

![image](https://user-images.githubusercontent.com/60574307/115398534-ec617e00-a1ef-11eb-87d9-2ebb05945f1a.png)


**Data visualization:** The user can see in a map the locations of the IPs in which he has sent HTTP requests. Specifically, a heatmap is displayed on the map to display the distribution of the number of records related to HTML, PHP, ASP web objects, JSP (or pure domains, without path).

![image](https://user-images.githubusercontent.com/60574307/115399911-56c6ee00-a1f1-11eb-8101-1a3c240e8d14.png)

## Administrator

**Display Basic Information:**
 The administrator sees relevant information on one page, in tables and / or graphs according to:

     a) The number of registered users.

     b) The number of entries in the database per type (method) of application.

     c) The number of entries in the database per response code (status).

     d) The number of unique domains that exist in the database.

     e) The number of unique connectivity providers in the database.

![image](https://user-images.githubusercontent.com/60574307/115401281-e6b96780-a1f2-11eb-80b1-8360608792b3.png)


**Response Time Analysis**:
  A configurable diagram with the average response time (Y axis) in each request per hour of the day [0-24] (X axis) is displayed. The diagram can filter using the following     arguments:
  
    a) Web object type (select one or more CONTENT-TYPE or all).
    
    b) Day of the week (Monday - Sunday or all).
    
    c) HTTP method type on request (select one or more, or all).
    
    d) Connectivity Provider (eg "Wind", "Cosmote" or all).
    
 ![image](https://user-images.githubusercontent.com/60574307/115402809-71e72d00-a1f4-11eb-93a5-0c08f252b904.png)


**HTTP header analysis**: The administrator has access to a page with the appropriate information, in tables and / or graphs according to the use of cache memories. More specifically:

      a. Histogram of TTL distribution of web objects in response, by CONTENT-TYPE (select one or more CONTENT-TYPE or all).
      
      b. Percentage of max-stale and min-fresh directives on the total number of applications per CONTENTTYPE (select one or more CONTENT-TYPE or all).
      
      c. Percentage of cacheability directives (public, private, no-cache, no-store) on the total of responses per CONTENT-TYPE (select one or more CONTENT-TYPE or all).
      
All the above graphs / tables are configured by the provider selection connectivity Connectivity provider (eg "Wind", "Cosmote" or all)

![image](https://user-images.githubusercontent.com/60574307/115404337-ea022280-a1f5-11eb-9e65-493e3af50a98.png)

**Data visualization**: The administrator can see on a map the IP locations to which it has sent HTTP requests. Specifically, one marker per IP appears with lines connecting each user's source city with each icon. The color of the lines is adjusted according to the number of applications they have made to that IP, normalized to the maximum number made to the most popular IP.

![image](https://user-images.githubusercontent.com/60574307/115405011-84fafc80-a1f6-11eb-805b-a431a9877334.png)



