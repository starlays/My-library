User features
=============
* will have an account (optional if more than one user) **(S: 5, X: h, M: h)**
* account activation (optional if more than one user and not running on localhost) **(S: 2, X: m, M: l)**
* will be able to add books to the database (if it has the proper rights) **(S: 5, X: h, M: h)**
* user will be able to add meta informations about a book (if it has the proper rights) **(S: 5, X: h, M: h)**
* will add an image cover for a particular book (if it has the proper rights) **(S: 4, X: m, M: m)**
* search for a certain book **(S: 5, X: h, M: h)**
* sort books by multiple criteria **(S: 3, X: h, M: m)**
* store an e-book for a certain book (if it has the proper rights) **(S: 2, X: l, M: l)**
* delete a book (if it has the proper rights) **(S: 5, X: h, M: h)**
* e-mail title/author and personal rating to friend/friends **(S: 4, X: l, M: l)**
* rate book (1 to 5 stars) **(S: 1, X: l, M: l)**

Books features
==============
* have a title **(S: 5, X: h, M: h)**
* have an author **(S: 5, X: h, M: h)**
* have description **(S: 5, X: h, M: h)**
* have cover image **(S: 4, X: l, M: l)**
* e-book variant attached **(S: 2, X: l, M: l)**
* the date when the book was added **(S: 5, X: h, M: h)**
* Download book if e-book variant attached **(S: 2, X: m, M: l)**

Admin panel
===========
* add a new user **(S: 3, X: h, M: m)**
* delete an user **(S: 3, X: m, M: m)**
* ban an user **(S: 2, X: m, M: l)**
* view informations for an certain user **(S: 3, X: l, M: l)**
* send system message to all users (optional if more then one account) **(S: 5, X: l, M: m)**
* set user rights for: **(S: 2, X: h, M: m)**
    * add book
    * edit meta information
    * add image cover
    * store e-book
    * delete a book
* set site for maintenance (optional if not on localhost) **(S: 2, X: l, M: l)**
* set user account activation (optional if not on localhost) **(S: 2, X: l, M: l)**

Priority rating
===============
* S - starlays, X - xao, M - average

* Priority rating:
    * 1 - lowest
    * 2 - low
    * 3 - medium
    * 4 - high
    * 5 - highest

* Calculation of the average is done using arithmetic average
