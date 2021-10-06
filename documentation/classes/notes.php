Parts class
        -functions:

            add/get/update drive type
            add/get/update wheel size
            add/get/update brand
            add/get/update category
            add/get/update braking system

Image class

        -functions:
            check format
            resize
            save
            add to database
        return db position

Bike specks

        use parts class
                get parts

        add/get/update bike specks

product class
            use parts class
            get parts
            use image class
            get all products(filter, order by, search)
            add/get/update product



user class
            use image class
            add/get/update/view user
            add/get/update address
            add/remove and view liked products
            view all products
                    -contact store about bought products(email)

            add/remove review

Auth class

            login
            logout
            add user info to session

Order class

            add/get/update/view delivery methods
            add order, update session and cookie

Post class
            use image class
            add/update and view all posts
            add/remove/update comment if user is author
            show all comments
            show new posts(make a order in the call)













