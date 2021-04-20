# Ηar Αnalyzer Application

We have developed a complete collection, management and crowdsourced information analysis of HTTP traffic data. Specifically, the application gives us access to our system administrator and users. The Administrator and the Users have different functions depending on the case and these are the following.

# Login Page

1. The login page with username and security code is shown below where depending on if the user or administrator logs in, the corresponding functions are displayed.

![image](https://user-images.githubusercontent.com/60574307/115163506-1e6cc600-a0b2-11eb-97d0-8808ea97b478.png)

2. Registration in the system. The user registers and accesses the system by selecting a username & password of his choice, and providing his email. The password is required
be at least 8 characters and contain at least one capital letter, a number and a symbol (eg # $ * & @).

![image](https://user-images.githubusercontent.com/60574307/115163730-693b0d80-a0b3-11eb-8ee5-b4842be627bb.png)

# User

Once logged in, the user can manage their profile, upload and visualize Har file data.

1. Profile management:
the user can change the username / password and see basically statistics for the data it has uploaded (date of last upload, number of records).

![image](https://user-images.githubusercontent.com/60574307/115398099-778e4400-a1ef-11eb-9272-c3b6a8c1ac32.png)

2. Upload data: 
  The user selects a HAR file from his computer. The file will processed locally to delete sensitive data and then the user has two options: 
  a) Upload it to the system or 
  b) Save the edited file locally.
  If the file is uploaded to the system, it will need to be further processed (on the server) of the data to be uploaded, in order to store the desired data with appropriate       format. Also, the IP of the user uploading the file should be "analyzed" so that to automatically discover the user connectivity provider and save the this information in the   database along with the records.

![image](https://user-images.githubusercontent.com/60574307/115398534-ec617e00-a1ef-11eb-87d9-2ebb05945f1a.png)


