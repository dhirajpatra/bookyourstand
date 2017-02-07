This application have following features:
Create the web application with the following requirements:

1. The home screen displays a map with different event places highlighted on it.
2. Selecting an event on the map displays the event details (name, location, event dates) right below the map and the “Book your place” button become active.
3. Clicking “Book your place” will take the user to the exposition hall map, it is a virtual map for the exposition hall with different stands which he can navigate through it and book his stand.
4. Booked stands is highlighted as booked, the logo of the booking company will be displayed on top of the stand, below it the marketing documents (could be downloaded) and the contact details.
5. Free stands is highlighted as free, and on top of it the price.
6. The user can select any empty stand to book, clicking on an empty stand shows a popup with details of the stand, a real image of it and a “Reserve” button.
7. Clicking on reserve takes the user to the registration page where he supposed to provide: contact details, upload marketing documents, company admin and company logo.
8. Clicking on “Confirm Reservation” reserves the stand for the user, takes him to the exposition hall screen viewing the booked stand with the user’s company details on it.
9. Finally the company admin receives a report by mail about the users of the stand after the event is over.

================================================================================================================

How to install:
This application has divided into 1. back end system which handling all REST API to process back end services along with database. 2. front end system which atcually need to run from server in browser.

Backend installation:-
Requirements:
Laraval 5.3, Mysql 5.6, Apache along with CROS [Header set Access-Control-Allow-Origin "*"
                                                Header set Access-Control-Allow-Methods "POST, GET, OPTIONS, DELETE, PUT"
                                                Header set Access-Control-Max-Age "1000"
                                                Header set Access-Control-Allow-Headers "x-requested-with, Content-Type, origin, authorization, accept, client-security-token"]
So that if you run witin same localhost front end here it is AngularJs can call our back end easily without any error.

Steps:
First run the sql script to mysql after creating database named cross [you can change database and other configuration from laravel].
Copy paste the whole back end folder/application into your document room.
Create virtual host of name of your application.
Give proper permission to that folder with recursive way.

Front end installation:
Requirement:
Almost nothing as it will run on AngularJs in your browser.
Keep this application folder also into your document root.
Give proper permission recursive way.

How to run:
Start the apache. Check your localhost is running.
Write the front end application url into browser.

First screen will show you the all events with markers. When you click on the marker it will display the event details. Also activate the Book Your Place button.

Click on Book Your Place button it will take you to another page for selecting the stand/seat.
You can see both aready booked and can book stand there. If you mistakenly click on booked stand it will warn you and do nothing.
On selecting the non book stand activate Resreve button.
Clicking on Reserve button it will take to another page where you can register with company details. [now uploads of logo and documents are not working, couldnt complete due to time constraint. Will update that too.]
Click on submit after fill all the fields. It will reserve your stand on that company. Then it will take to previous page with updated data. You can see your booked stand.

Another isolated API created to send a mail report to admin.

REST API :eg.
http://cross/api/v1/bookmystand
[]
http://cross/api/v1/bookmystand/geteventdetails
[{"id":"1"}]
http://cross/api/v1/bookmystand/getallstands
[{"event_id":"1"}]
http://cross/api/v1/bookmystand/reservestand
[{"company_name":"good company","admin":"good admin","admin_email":"goodadmin@good.com","phone":"461333","add1":"good add1","add2":"good add2","zip":"64613", "stand_id":"2"}]


