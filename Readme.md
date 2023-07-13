<!-- Index Page -->

Line 2:-> Including Database connection file.
Line 4:-> If User has logged in successfully then his user id 
            is fetched.
Line 38: -> Including Navigation page.
Line 61,77,93,109: -> If user is not logged in then redirecting 
            it to loging page before using nay services.
Line 182: -> Including Footer Page.

Line 189-202: -> If user clicks on RenewPass button then window 
will scroll to the top position. 
                Then the css class will be added to the Target 
                element. which will pop up the renew pass screen. 
                And when user clicks on Cross then the css class 
                will be removed from the target element 
                and window will scroll down to 450.

<!-- Apply Pass -->

Line 4:-> If user is not logged in then sending them to login page.
Line 8,9:-> If user is logged in, then its user id and email is 
            fetched and stored in the vairable.
Line 10:->Fetching users details from to autofill half information 
on the form.
Line 17-35:-> If user clicks on apply button, then all the 
information the user filled
             in the form is collected and stored in its respective 
             variables.
Line 43:-> Making a folder and the name of the folder is the email 
            of teh user.
Line 44-47:-> Setting location/path for the images to be stored in 
            the database.
Line 49-52:-> Using function, All the images the user submitted in 
            the form is 
been moved to thier respective folders.
Line 54:-> Including a php library for creating a qqrcode.
Line 59:-> Inserting data into the databse.
Line 60:-> Fetching pass id from the databse.
Line 64:-> If the passtype is not Full, Then the destination of 
            the user is stored in the route table.
Line 67:-> If the passtype is Full and not punching , the no 
            data is stored in the route table.
Line 68:-> Storing pass validity information in the plan table.
Line 76:-> After all the process user is redirected to the 
            payment page.
Line 94:-> Form action .... it means the data is sent to the 
            same page.
Line 100: in the Value... the fetched data is been printed 
            using the word echo.

